<?php

namespace App\Services\Dashboard;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

/**
 * Sambungan OAuth ke WakaTime buat baca stats.
 *
 * Mulai 1 Nov 2026 API key WakaTime cuma bisa dipakai plugin buat ngirim data,
 * jadi baca stats wajib pakai token OAuth. Admin nyambungin sekali lewat
 * /admin/wakatime/connect, terus token disimpen terenkripsi (pakai APP_KEY) di
 * storage/app/private. Sengaja gak pakai tabel biar gak butuh migration di server.
 *
 * Token gak pernah dikirim ke view atau ditulis ke log.
 */
class WakaTimeOAuth
{
    public const AUTHORIZE_URL = 'https://wakatime.com/oauth/authorize';

    public const TOKEN_URL = 'https://wakatime.com/oauth/token';

    // read_stats buat stats + all_time_since_today, best_day dipisah sama WakaTime
    public const SCOPES = 'read_stats,read_stats.best_day';

    // File di disk "local" (root-nya storage/app/private)
    public const TOKEN_FILE = 'wakatime/token.enc';

    // Token di-refresh kalau sisa umurnya kurang dari ini (detik)
    private const REFRESH_MARGIN = 300;

    /** Client ID + secret udah diisi di .env */
    public function configured(): bool
    {
        return filled(config('services.wakatime.client_id'))
            && filled(config('services.wakatime.client_secret'));
    }

    /** Udah pernah disambungin dan tokennya kebaca */
    public function connected(): bool
    {
        return $this->configured() && $this->load() !== null;
    }

    public function redirectUri(): string
    {
        return config('services.wakatime.redirect') ?: route('admin.wakatime.callback');
    }

    public function authorizeUrl(string $state): string
    {
        return self::AUTHORIZE_URL.'?'.http_build_query([
            'client_id' => config('services.wakatime.client_id'),
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri(),
            'scope' => self::SCOPES,
            'state' => $state,
        ]);
    }

    /** Tuker code dari callback jadi token, terus simpen */
    public function connect(string $code): void
    {
        $token = $this->requestToken([
            'grant_type' => 'authorization_code',
            'code' => $code,
        ]);

        if (blank($token['refresh_token'] ?? null)) {
            throw new RuntimeException('WakaTime gak ngasih refresh token');
        }

        $this->save($token);
    }

    /** Access token yang masih berlaku, di-refresh dulu kalau udah mau habis */
    public function accessToken(): string
    {
        $token = $this->load() ?? throw new RuntimeException('WakaTime belum disambungin');

        $expiresAt = $token['expires_at'] ? Carbon::parse($token['expires_at']) : null;

        if ($expiresAt && $expiresAt->lte(now()->addSeconds(self::REFRESH_MARGIN))) {
            return $this->refresh();
        }

        return $token['access_token'];
    }

    /** Minta access token baru pakai refresh token. Balikin access token yang baru. */
    public function refresh(): string
    {
        $old = $this->load() ?? throw new RuntimeException('WakaTime belum disambungin');

        $token = $this->requestToken([
            'grant_type' => 'refresh_token',
            'refresh_token' => $old['refresh_token'],
        ]);

        // Kalau WakaTime gak ngasih refresh token baru, yang lama tetep dipakai
        $token['refresh_token'] = filled($token['refresh_token'] ?? null) ? $token['refresh_token'] : $old['refresh_token'];

        $this->save($token);

        return $token['access_token'];
    }

    public function forget(): void
    {
        Storage::disk('local')->delete(self::TOKEN_FILE);
    }

    private function requestToken(array $grant): array
    {
        try {
            $response = Http::asForm()
                ->acceptJson()
                ->timeout(15)
                ->post(self::TOKEN_URL, [
                    'client_id' => config('services.wakatime.client_id'),
                    'client_secret' => config('services.wakatime.client_secret'),
                    'redirect_uri' => $this->redirectUri(),
                    ...$grant,
                ]);
        } catch (ConnectionException) {
            throw new RuntimeException('Gak bisa nyambung ke WakaTime buat minta token');
        }

        // Pesan error sengaja cuma status code, biar isi response gak ikut ke log
        if ($response->failed()) {
            throw new RuntimeException("WakaTime nolak permintaan token (status {$response->status()})");
        }

        return $this->parseToken($response);
    }

    private function parseToken(Response $response): array
    {
        $data = $response->json();

        if (! is_array($data) || blank($data['access_token'] ?? null)) {
            throw new RuntimeException('Format token WakaTime gak sesuai');
        }

        // Dokumentasi WakaTime gak nyebut nama field kedaluwarsanya, jadi dua-duanya dicek
        $expiresAt = match (true) {
            filled($data['expires_at'] ?? null) => Carbon::parse($data['expires_at'])->toIso8601String(),
            is_numeric($data['expires_in'] ?? null) => now()->addSeconds((int) $data['expires_in'])->toIso8601String(),
            default => null,
        };

        return [
            'access_token' => (string) $data['access_token'],
            'refresh_token' => (string) ($data['refresh_token'] ?? ''),
            'expires_at' => $expiresAt,
            'scope' => (string) ($data['scope'] ?? ''),
        ];
    }

    private function save(array $token): void
    {
        Storage::disk('local')->put(self::TOKEN_FILE, Crypt::encryptString(json_encode([
            ...$token,
            'saved_at' => now()->toIso8601String(),
        ])));
    }

    private function load(): ?array
    {
        $disk = Storage::disk('local');

        if (! $disk->exists(self::TOKEN_FILE)) {
            return null;
        }

        try {
            $token = json_decode(Crypt::decryptString($disk->get(self::TOKEN_FILE)), true);
        } catch (DecryptException) {
            // Biasanya karena APP_KEY ganti. Solusinya sambungin ulang dari halaman admin.
            Log::warning('Dashboard: token WakaTime gak bisa dibuka, perlu disambungin ulang');

            return null;
        }

        if (! is_array($token) || blank($token['access_token'] ?? null) || blank($token['refresh_token'] ?? null)) {
            return null;
        }

        return $token + ['expires_at' => null];
    }
}
