<?php

namespace Tests\Feature;

use App\Models\FantasyFind;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class FantasyModeTest extends TestCase
{
    use RefreshDatabase;

    private const BROWSER = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/130.0';

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
    }

    public function test_count_starts_at_zero(): void
    {
        $this->getJson(route('fantasy.count'))
            ->assertOk()
            ->assertExactJson(['count' => 0]);
    }

    public function test_same_visitor_is_counted_once(): void
    {
        $this->withHeader('User-Agent', self::BROWSER)->postJson(route('fantasy.found'))->assertOk();
        $this->withHeader('User-Agent', self::BROWSER)->postJson(route('fantasy.found'))->assertOk();

        $this->assertSame(1, FantasyFind::count());
        $this->getJson(route('fantasy.count'))->assertExactJson(['count' => 1]);
    }

    public function test_different_visitors_are_counted_separately(): void
    {
        $this->withHeader('User-Agent', self::BROWSER)->postJson(route('fantasy.found'));
        $this->withHeader('User-Agent', 'Mozilla/5.0 (iPhone) Safari/604.1')->postJson(route('fantasy.found'));

        $this->getJson(route('fantasy.count'))->assertExactJson(['count' => 2]);
    }

    public function test_cached_count_refreshes_after_new_find(): void
    {
        $this->getJson(route('fantasy.count'))->assertExactJson(['count' => 0]);

        $this->withHeader('User-Agent', self::BROWSER)->postJson(route('fantasy.found'));

        $this->getJson(route('fantasy.count'))->assertExactJson(['count' => 1]);
    }

    public function test_raw_ip_is_never_stored(): void
    {
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.7'])
            ->withHeader('User-Agent', self::BROWSER)
            ->postJson(route('fantasy.found'));

        $row = FantasyFind::first();
        $this->assertSame(64, strlen($row->visitor_hash));
        $this->assertStringNotContainsString('203.0.113.7', json_encode($row->getAttributes()));
    }

    public function test_found_only_accepts_post(): void
    {
        $this->get('/fantasy-mode/found')->assertStatus(405);
    }

    public function test_found_is_rate_limited(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->postJson(route('fantasy.found'))->assertOk();
        }

        $this->postJson(route('fantasy.found'))->assertStatus(429);
    }
}
