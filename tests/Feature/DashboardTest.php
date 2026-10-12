<?php

namespace Tests\Feature;

use App\Models\PageView;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private const BROWSER = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/130.0';

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        config(['services.github.token' => null, 'services.wakatime.key' => null]);
    }

    private function fakeContributions(): void
    {
        // 14 hari mulai Minggu 28 Sep 2025, isinya 0..13 kontribusi
        $days = collect(range(0, 13))->map(fn ($i) => [
            'date' => Carbon::parse('2025-09-28')->addDays($i)->toDateString(),
            'count' => $i,
            'level' => min(4, intdiv($i, 3)),
        ])->all();

        Http::fake(['github-contributions-api.jogruber.de/*' => Http::response(['contributions' => $days])]);
    }

    public function test_github_summary_from_public_api(): void
    {
        $this->fakeContributions();

        $this->getJson('/dashboard/data/github')
            ->assertOk()
            ->assertJsonPath('total', 91)          // 0+1+...+13
            ->assertJsonPath('best', 13)
            ->assertJsonPath('this_week', 70)      // 7+8+...+13 (minggu kedua)
            ->assertJsonPath('average', 6.5)
            ->assertJsonCount(2, 'weeks')
            ->assertJsonCount(7, 'weeks.0');
    }

    public function test_github_uses_last_good_data_when_api_fails(): void
    {
        $this->fakeContributions();
        $this->getJson('/dashboard/data/github')->assertOk();

        // Cache-nya basi, terus API-nya lagi down
        Cache::forget('dashboard:github');
        Http::fake(['github-contributions-api.jogruber.de/*' => Http::response('down', 500)]);

        $this->getJson('/dashboard/data/github')->assertOk()->assertJsonPath('total', 91);
    }

    public function test_github_returns_503_when_never_loaded_and_api_fails(): void
    {
        Http::fake(['github-contributions-api.jogruber.de/*' => Http::response('down', 500)]);

        $this->getJson('/dashboard/data/github')->assertServiceUnavailable();
    }

    public function test_first_time_failure_is_retried_after_one_minute(): void
    {
        Http::fake(['github-contributions-api.jogruber.de/*' => Http::sequence()
            ->push('down', 500)
            ->push(['contributions' => [['date' => '2025-10-05', 'count' => 3, 'level' => 1]]])]);

        $this->getJson('/dashboard/data/github')->assertServiceUnavailable();
        $this->getJson('/dashboard/data/github')->assertServiceUnavailable(); // masih ditahan
        Http::assertSentCount(1);

        $this->travel(61)->seconds();

        $this->getJson('/dashboard/data/github')->assertOk()->assertJsonPath('total', 3);
        Http::assertSentCount(2);
    }

    public function test_waits_for_another_request_instead_of_calling_the_api_again(): void
    {
        config(['portfolio.cache.lock_wait' => 0]);
        Http::fake();

        // Pura-puranya request lain lagi ngambil data GitHub (lock-nya kepegang)
        Cache::forever('dashboard:github:last', ['total' => 77, 'this_week' => 0, 'best' => 5, 'average' => 0.2, 'weeks' => []]);
        Cache::lock('dashboard:github:fetching', 30)->get();

        $this->getJson('/dashboard/data/github')->assertOk()->assertJsonPath('total', 77);
        Http::assertNothingSent();
    }

    public function test_wakatime_section_hidden_without_key(): void
    {
        $this->get('/dashboard')->assertOk()->assertDontSee('data-dashboard="wakatime"', false);
        $this->getJson('/dashboard/data/wakatime')->assertServiceUnavailable();
    }

    public function test_wakatime_summary_with_key(): void
    {
        config(['services.wakatime.key' => 'waka_test']);

        Http::fake([
            'wakatime.com/api/v1/users/current/stats/*' => Http::response(['data' => [
                'start' => '2026-10-05T00:00:00Z',
                'end' => '2026-10-11T23:59:59Z',
                'human_readable_daily_average' => '3 hrs 16 mins',
                'human_readable_total' => '22 hrs 57 mins',
                'best_day' => ['date' => '2026-10-08', 'text' => '7 hrs 40 mins'],
                'languages' => [
                    ['name' => 'PHP', 'percent' => 61.24, 'text' => '14 hrs', 'total_seconds' => 50400],
                    ['name' => 'Other', 'percent' => 0, 'text' => '0 secs', 'total_seconds' => 0],
                ],
            ]]),
            'wakatime.com/api/v1/users/current/all_time_since_today' => Http::response(['data' => ['text' => '875 hrs 47 mins']]),
        ]);

        $this->get('/dashboard')->assertSee('data-dashboard="wakatime"', false);

        $this->getJson('/dashboard/data/wakatime')
            ->assertOk()
            ->assertJsonPath('start_date', '2026-10-05')
            ->assertJsonPath('daily_average', '3 hrs 16 mins')
            ->assertJsonPath('best_day.text', '7 hrs 40 mins')
            ->assertJsonPath('all_time', '875 hrs 47 mins')
            ->assertJsonCount(1, 'languages');

        Http::assertSent(fn ($request) => $request->hasHeader('Authorization', 'Basic '.base64_encode('waka_test')));
    }

    public function test_page_views_are_recorded_for_real_browsers_only(): void
    {
        $this->withHeader('User-Agent', self::BROWSER)->get('/projects')->assertOk();
        $this->withHeader('User-Agent', 'Googlebot/2.1')->get('/projects')->assertOk();
        $this->get('/projects')->assertOk(); // tanpa user agent

        $this->assertSame(1, PageView::count());
        $this->assertSame('/projects', PageView::first()->path);
    }

    public function test_admin_visits_are_not_counted(): void
    {
        $admin = User::factory()->create();
        $admin->is_admin = true;
        $admin->save();

        $this->actingAs($admin)->withHeader('User-Agent', self::BROWSER)->get('/about')->assertOk();

        $this->assertSame(0, PageView::count());
    }

    public function test_analytics_summary_counts_views_visits_and_referrers(): void
    {
        $this->withHeaders(['User-Agent' => self::BROWSER, 'Referer' => 'https://www.linkedin.com/feed/'])->get('/');
        $this->withHeader('User-Agent', self::BROWSER)->get('/projects');

        $this->getJson('/dashboard/data/analytics')
            ->assertOk()
            ->assertJsonPath('totals.page_views', 2)
            ->assertJsonPath('totals.visitors', 1)
            ->assertJsonPath('totals.visits', 1)       // halaman kedua masih kunjungan yang sama
            ->assertJsonPath('top_referrers.0.label', 'linkedin.com')
            ->assertJsonCount(6, 'monthly');

        $this->assertNotContains('127.0.0.1', PageView::pluck('visitor_hash')->all());
    }
}
