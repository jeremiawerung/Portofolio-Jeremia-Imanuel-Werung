<?php

namespace App\Services\Dashboard;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class WakaTimeStats
{
    use RemembersLastGood;

    private const CACHE_KEY = 'dashboard:wakatime';

    public function __construct(private WakaTimeOAuth $oauth) {}

    /** Bagian WakaTime cuma tampil kalau OAuth udah disambungin admin */
    public function enabled(): bool
    {
        return $this->oauth->connected();
    }

    /** Dipanggil abis nyambungin ulang, biar data baru langsung diambil */
    public function refreshSoon(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function get(): ?array
    {
        if (! $this->enabled()) {
            return null;
        }

        return $this->rememberLastGood(
            self::CACHE_KEY,
            config('portfolio.cache.wakatime'),
            fn () => $this->fetch(),
        );
    }

    private function fetch(): array
    {
        $week = $this->call('users/current/stats/last_7_days');
        $allTime = $this->call('users/current/all_time_since_today');

        if (! is_array($week)) {
            throw new RuntimeException('Format WakaTime gak sesuai');
        }

        $bestDay = $week['best_day'] ?? null;

        return [
            'start_date' => $this->date($week['start'] ?? null),
            'end_date' => $this->date($week['end'] ?? null),
            'daily_average' => $week['human_readable_daily_average'] ?? '-',
            'total_week' => $week['human_readable_total'] ?? '-',
            'best_day' => $bestDay ? [
                'date' => $this->date($bestDay['date'] ?? null),
                'text' => $bestDay['text'] ?? '',
            ] : null,
            'all_time' => $allTime['text'] ?? '-',
            'languages' => $this->top($week['languages'] ?? [], 6),
            'editors' => $this->top($week['editors'] ?? [], 3),
            'updated_at' => now()->toIso8601String(),
        ];
    }

    /**
     * Panggil API WakaTime pakai Bearer token. Kalau dibales 401 (token
     * kedaluwarsa atau dicabut), token di-refresh terus dicoba sekali lagi.
     * Kalau tetep gagal, exception-nya ditangkep RemembersLastGood, jadi kartu
     * nampilin data terakhir yang bagus.
     */
    private function call(string $path): mixed
    {
        $response = $this->send($path, $this->oauth->accessToken());

        if ($response->status() === 401) {
            $response = $this->send($path, $this->oauth->refresh());
        }

        // Cukup status code, isi response gak usah ikut ke log
        if ($response->failed()) {
            throw new RuntimeException("WakaTime {$path} gagal (status {$response->status()})");
        }

        return $response->json('data');
    }

    private function send(string $path, string $token): Response
    {
        try {
            return Http::baseUrl('https://wakatime.com/api/v1/')
                ->withToken($token)
                ->acceptJson()
                ->timeout(15)
                ->get($path);
        } catch (ConnectionException) {
            throw new RuntimeException("Gak bisa nyambung ke WakaTime {$path}");
        }
    }

    private function top(array $items, int $limit): array
    {
        return collect($items)
            ->filter(fn ($item) => ($item['total_seconds'] ?? 0) > 0)
            ->take($limit)
            ->map(fn ($item) => [
                'name' => (string) ($item['name'] ?? '?'),
                'percent' => round((float) ($item['percent'] ?? 0), 1),
                'text' => (string) ($item['text'] ?? ''),
            ])
            ->values()
            ->all();
    }

    private function date(?string $value): ?string
    {
        return $value ? Carbon::parse($value)->toDateString() : null;
    }
}
