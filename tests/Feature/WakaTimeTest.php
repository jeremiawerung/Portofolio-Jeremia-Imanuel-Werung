<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Dashboard\WakaTimeOAuth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WakaTimeTest extends TestCase
{
    use RefreshDatabase;

    private const STATS = 'wakatime.com/api/v1/users/current/stats/*';

    private const ALL_TIME = 'wakatime.com/api/v1/users/current/all_time_since_today';

    private const TOKEN = 'wakatime.com/oauth/token';

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Storage::fake('local');

        config([
            'services.wakatime.client_id' => 'client_test',
            'services.wakatime.client_secret' => 'secret_test',
            'services.wakatime.redirect' => null,
        ]);
    }

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->is_admin = true;
        $user->save();

        return $user;
    }

    /** Pura-puranya admin udah pernah nyambungin WakaTime */
    private function storeToken(string $access = 'akses_lama', ?string $expiresAt = null): void
    {
        Storage::disk('local')->put(WakaTimeOAuth::TOKEN_FILE, Crypt::encryptString(json_encode([
            'access_token' => $access,
            'refresh_token' => 'refresh_lama',
            'expires_at' => $expiresAt ?? now()->addYear()->toIso8601String(),
            'scope' => WakaTimeOAuth::SCOPES,
        ])));
    }

    private function storedToken(): array
    {
        return json_decode(Crypt::decryptString(Storage::disk('local')->get(WakaTimeOAuth::TOKEN_FILE)), true);
    }

    private function statsResponse(): array
    {
        return ['data' => [
            'start' => '2026-10-05T00:00:00Z',
            'end' => '2026-10-11T23:59:59Z',
            'human_readable_daily_average' => '3 hrs 16 mins',
            'human_readable_total' => '22 hrs 57 mins',
            'best_day' => ['date' => '2026-10-08', 'text' => '7 hrs 40 mins'],
            'languages' => [
                ['name' => 'PHP', 'percent' => 61.24, 'text' => '14 hrs', 'total_seconds' => 50400],
                ['name' => 'Other', 'percent' => 0, 'text' => '0 secs', 'total_seconds' => 0],
            ],
        ]];
    }

    private function fakeStats(): void
    {
        Http::fake([
            self::STATS => Http::response($this->statsResponse()),
            self::ALL_TIME => Http::response(['data' => ['text' => '875 hrs 47 mins']]),
        ]);
    }

    // ===== Sebelum nyambung =====

    public function test_section_hidden_for_visitors_until_connected(): void
    {
        $this->get('/dashboard')->assertOk()
            ->assertDontSee('data-dashboard="wakatime"', false)
            ->assertDontSee('Connect WakaTime');

        $this->getJson('/dashboard/data/wakatime')->assertServiceUnavailable();
    }

    public function test_admin_sees_connect_button_when_not_connected(): void
    {
        $this->actingAs($this->admin())->get('/dashboard')
            ->assertOk()
            ->assertSee('Connect WakaTime')
            ->assertSee(route('admin.wakatime.connect'), false);
    }

    public function test_admin_sees_setup_hint_without_client_id(): void
    {
        config(['services.wakatime.client_id' => null]);

        $this->actingAs($this->admin())->get('/dashboard')
            ->assertOk()
            ->assertSee('WakaTime is not set up')
            ->assertDontSee(route('admin.wakatime.connect'), false);
    }

    // ===== Alur OAuth =====

    public function test_connect_redirects_to_wakatime_with_state(): void
    {
        $response = $this->actingAs($this->admin())->post('/admin/wakatime/connect');

        $state = session('wakatime_oauth_state');
        $this->assertIsString($state);
        $this->assertSame(40, strlen($state));

        $location = $response->assertRedirect()->headers->get('Location');
        $this->assertStringStartsWith(WakaTimeOAuth::AUTHORIZE_URL.'?', $location);

        parse_str(parse_url($location, PHP_URL_QUERY), $query);
        $this->assertSame('client_test', $query['client_id']);
        $this->assertSame('code', $query['response_type']);
        $this->assertSame(route('admin.wakatime.callback'), $query['redirect_uri']);
        $this->assertSame(WakaTimeOAuth::SCOPES, $query['scope']);
        $this->assertSame($state, $query['state']);
    }

    public function test_connect_and_callback_are_admin_only(): void
    {
        $this->post('/admin/wakatime/connect')->assertRedirect('/admin/login');
        $this->get('/admin/wakatime/callback?state=x&code=y')->assertRedirect('/admin/login');

        $biasa = User::factory()->create();
        $this->actingAs($biasa)->post('/admin/wakatime/connect')->assertForbidden();
        $this->actingAs($biasa)->get('/admin/wakatime/callback?state=x&code=y')->assertForbidden();
    }

    public function test_connect_needs_csrf_token_as_post(): void
    {
        $this->actingAs($this->admin())->get('/admin/wakatime/connect')->assertMethodNotAllowed();
    }

    public function test_connect_is_404_when_client_not_configured(): void
    {
        config(['services.wakatime.client_secret' => null]);

        $this->actingAs($this->admin())->post('/admin/wakatime/connect')->assertNotFound();
    }

    public function test_callback_with_valid_state_stores_encrypted_token(): void
    {
        Http::fake([self::TOKEN => Http::response([
            'access_token' => 'akses_baru',
            'refresh_token' => 'refresh_baru',
            'expires_in' => 3600,
            'scope' => 'read_stats,read_stats.best_day',
            'token_type' => 'bearer',
        ])]);
        Cache::put('dashboard:wakatime', ['data' => ['lama' => true]], 3600);

        $this->actingAs($this->admin())
            ->withSession(['wakatime_oauth_state' => 'state-yang-bener'])
            ->get('/admin/wakatime/callback?state=state-yang-bener&code=kode123')
            ->assertRedirect('/dashboard')
            ->assertSessionHas('wakatime_status.type', 'success')
            ->assertSessionMissing('wakatime_oauth_state');

        Http::assertSent(fn (Request $request) => $request->url() === 'https://wakatime.com/oauth/token'
            && $request['grant_type'] === 'authorization_code'
            && $request['code'] === 'kode123'
            && $request['client_id'] === 'client_test'
            && $request['client_secret'] === 'secret_test'
            && $request['redirect_uri'] === route('admin.wakatime.callback'));

        // Disimpen terenkripsi, bukan teks biasa
        $raw = Storage::disk('local')->get(WakaTimeOAuth::TOKEN_FILE);
        $this->assertStringNotContainsString('akses_baru', $raw);
        $this->assertStringNotContainsString('refresh_baru', $raw);

        $token = $this->storedToken();
        $this->assertSame('akses_baru', $token['access_token']);
        $this->assertSame('refresh_baru', $token['refresh_token']);
        $this->assertNotNull($token['expires_at']);

        // Cache lama dibuang biar data baru langsung diambil
        $this->assertNull(Cache::get('dashboard:wakatime'));
    }

    public function test_callback_with_wrong_state_is_rejected(): void
    {
        Http::fake();

        $this->actingAs($this->admin())
            ->withSession(['wakatime_oauth_state' => 'state-yang-bener'])
            ->get('/admin/wakatime/callback?state=state-palsu&code=kode123')
            ->assertRedirect('/dashboard')
            ->assertSessionHas('wakatime_status.type', 'error')
            ->assertSessionMissing('wakatime_oauth_state');

        Http::assertNothingSent();
        Storage::disk('local')->assertMissing(WakaTimeOAuth::TOKEN_FILE);
    }

    public function test_callback_without_state_in_session_is_rejected(): void
    {
        Http::fake();

        $this->actingAs($this->admin())
            ->get('/admin/wakatime/callback?state=apa-aja&code=kode123')
            ->assertSessionHas('wakatime_status.type', 'error');

        Http::assertNothingSent();
    }

    public function test_callback_when_user_cancels(): void
    {
        Http::fake();

        $this->actingAs($this->admin())
            ->withSession(['wakatime_oauth_state' => 'state-yang-bener'])
            ->get('/admin/wakatime/callback?state=state-yang-bener&error=access_denied')
            ->assertSessionHas('wakatime_status.message', 'The WakaTime connection was cancelled.');

        Http::assertNothingSent();
    }

    public function test_callback_when_wakatime_rejects_code(): void
    {
        Http::fake([self::TOKEN => Http::response(['error' => 'invalid_grant'], 400)]);

        $this->actingAs($this->admin())
            ->withSession(['wakatime_oauth_state' => 'state-yang-bener'])
            ->get('/admin/wakatime/callback?state=state-yang-bener&code=kode-basi')
            ->assertRedirect('/dashboard')
            ->assertSessionHas('wakatime_status.type', 'error');

        Storage::disk('local')->assertMissing(WakaTimeOAuth::TOKEN_FILE);
    }

    // ===== Baca stats =====

    public function test_stats_use_bearer_token(): void
    {
        $this->storeToken('akses_lama');
        $this->fakeStats();

        $this->get('/dashboard')->assertSee('data-dashboard="wakatime"', false);

        $this->getJson('/dashboard/data/wakatime')
            ->assertOk()
            ->assertJsonPath('start_date', '2026-10-05')
            ->assertJsonPath('daily_average', '3 hrs 16 mins')
            ->assertJsonPath('best_day.text', '7 hrs 40 mins')
            ->assertJsonPath('all_time', '875 hrs 47 mins')
            ->assertJsonCount(1, 'languages');

        Http::assertSent(fn (Request $request) => $request->hasHeader('Authorization', 'Bearer akses_lama'));
        Http::assertNotSent(fn (Request $request) => str_starts_with($request->header('Authorization')[0] ?? '', 'Basic'));
    }

    public function test_expired_token_is_refreshed_before_reading_stats(): void
    {
        $this->storeToken('akses_lama', now()->subMinute()->toIso8601String());

        Http::fake([
            self::TOKEN => Http::response([
                'access_token' => 'akses_baru',
                'refresh_token' => 'refresh_baru',
                'expires_at' => now()->addYear()->toIso8601String(),
            ]),
            self::STATS => Http::response($this->statsResponse()),
            self::ALL_TIME => Http::response(['data' => ['text' => '875 hrs 47 mins']]),
        ]);

        $this->getJson('/dashboard/data/wakatime')->assertOk()->assertJsonPath('all_time', '875 hrs 47 mins');

        Http::assertSent(fn (Request $request) => $request->url() === 'https://wakatime.com/oauth/token'
            && $request['grant_type'] === 'refresh_token'
            && $request['refresh_token'] === 'refresh_lama');
        Http::assertSent(fn (Request $request) => $request->hasHeader('Authorization', 'Bearer akses_baru'));
        Http::assertNotSent(fn (Request $request) => $request->hasHeader('Authorization', 'Bearer akses_lama'));

        $this->assertSame('akses_baru', $this->storedToken()['access_token']);
        $this->assertSame('refresh_baru', $this->storedToken()['refresh_token']);
    }

    public function test_token_is_refreshed_once_when_wakatime_says_401(): void
    {
        $this->storeToken('akses_dicabut');

        Http::fake([
            self::TOKEN => Http::response(['access_token' => 'akses_baru', 'expires_in' => 3600]),
            self::STATS => Http::sequence()->push(['error' => 'Unauthorized'], 401)->push($this->statsResponse()),
            self::ALL_TIME => Http::response(['data' => ['text' => '875 hrs 47 mins']]),
        ]);

        $this->getJson('/dashboard/data/wakatime')->assertOk()->assertJsonPath('daily_average', '3 hrs 16 mins');

        // Refresh token lama tetep disimpen kalau WakaTime gak ngasih yang baru
        $this->assertSame('akses_baru', $this->storedToken()['access_token']);
        $this->assertSame('refresh_lama', $this->storedToken()['refresh_token']);
    }

    /** Data terakhir yang bagus, kayak abis pernah berhasil diambil */
    private function seedLastGood(): void
    {
        Cache::forever('dashboard:wakatime:last', ['daily_average' => '3 hrs 16 mins', 'all_time' => '875 hrs 47 mins', 'languages' => []]);
    }

    public function test_uses_last_good_data_when_wakatime_fails(): void
    {
        $this->storeToken();
        $this->seedLastGood();

        // Cache-nya basi, terus WakaTime lagi down
        Http::fake([
            self::STATS => Http::response('down', 500),
            self::ALL_TIME => Http::response('down', 500),
        ]);

        $this->getJson('/dashboard/data/wakatime')->assertOk()->assertJsonPath('all_time', '875 hrs 47 mins');
        Http::assertSentCount(1);
    }

    public function test_uses_last_good_data_when_refresh_fails(): void
    {
        $this->storeToken();
        $this->seedLastGood();

        // Token dicabut di WakaTime: stats 401, refresh juga ditolak
        Http::fake([
            self::TOKEN => Http::response(['error' => 'invalid_grant'], 400),
            self::STATS => Http::response(['error' => 'Unauthorized'], 401),
            self::ALL_TIME => Http::response(['error' => 'Unauthorized'], 401),
        ]);

        $this->getJson('/dashboard/data/wakatime')->assertOk()->assertJsonPath('daily_average', '3 hrs 16 mins');
        $this->get('/dashboard')->assertOk();

        // Token lama gak dihapus, jadi masih bisa dicoba lagi nanti
        $this->assertSame('akses_lama', $this->storedToken()['access_token']);
    }

    public function test_returns_503_not_500_when_never_loaded_and_wakatime_fails(): void
    {
        $this->storeToken();
        Http::fake([self::STATS => Http::response('down', 500)]);

        $this->getJson('/dashboard/data/wakatime')->assertServiceUnavailable();
    }

    public function test_unreadable_token_file_counts_as_not_connected(): void
    {
        // Misalnya APP_KEY ganti, file token lama gak bisa dibuka lagi
        Storage::disk('local')->put(WakaTimeOAuth::TOKEN_FILE, 'bukan-data-terenkripsi');

        $this->get('/dashboard')->assertOk()->assertDontSee('data-dashboard="wakatime"', false);
        $this->getJson('/dashboard/data/wakatime')->assertServiceUnavailable();
    }

    public function test_token_never_reaches_the_browser(): void
    {
        $this->storeToken('akses_rahasia');
        $this->fakeStats();

        $this->actingAs($this->admin());

        $this->get('/dashboard')->assertOk()
            ->assertDontSee('akses_rahasia')
            ->assertDontSee('refresh_lama')
            ->assertDontSee('secret_test');

        $this->getJson('/dashboard/data/wakatime')->assertOk()
            ->assertDontSee('akses_rahasia')
            ->assertDontSee('refresh_lama');
    }
}
