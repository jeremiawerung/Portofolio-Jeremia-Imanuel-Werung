<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PortfolioPagesTest extends TestCase
{
    use RefreshDatabase;

    public static function pages(): array
    {
        return [
            'home' => ['/', 'Hi, I'],
            'about' => ['/about', 'Career'],
            'achievements' => ['/achievements', 'SQL for Data Science'],
            'projects' => ['/projects', 'RFID School Attendance System'],
            'case studies' => ['/case-studies', 'Task Module'],
            'insights' => ['/insights', 'Building a QA Strategy from Scratch'],
            'dashboard' => ['/dashboard', 'GitHub Contributions'],
            'chat room' => ['/chat-room', 'Chat Room'],
            'contact' => ['/contact', 'jeremia07102004@gmail.com'],
            'smart talk' => ['/smart-talk', 'Smart Talk'],
        ];
    }

    #[DataProvider('pages')]
    public function test_every_page_renders_with_the_sidebar(string $url, string $text): void
    {
        $this->get($url)
            ->assertOk()
            ->assertSee($text)
            ->assertSee('aria-current="page"', false);
    }

    public function test_belajar_tracker_is_not_reachable_outside_local(): void
    {
        $this->get('/belajar')->assertNotFound();
    }

    public function test_unknown_page_shows_custom_404_without_debug_details(): void
    {
        $this->get('/halaman-ngawur')
            ->assertNotFound()
            ->assertSee('Page not found')
            ->assertDontSee('Stack trace');
    }
}
