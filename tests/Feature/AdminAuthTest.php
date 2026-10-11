<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    private function user(bool $admin): User
    {
        $user = User::factory()->create(['email' => $admin ? 'admin@example.com' : 'biasa@example.com', 'password' => 'password-yang-panjang']);
        $user->is_admin = $admin;
        $user->save();

        return $user;
    }

    public function test_admin_can_login_and_logout(): void
    {
        $this->user(true);

        $this->post('/admin/login', ['email' => 'admin@example.com', 'password' => 'password-yang-panjang'])
            ->assertRedirect('/chat-room');
        $this->assertAuthenticated();

        $this->post('/admin/logout')->assertRedirect('/chat-room');
        $this->assertGuest();
    }

    public function test_wrong_password_is_rejected(): void
    {
        $this->user(true);

        $this->post('/admin/login', ['email' => 'admin@example.com', 'password' => 'salah'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_non_admin_account_cannot_login(): void
    {
        $this->user(false);

        $this->post('/admin/login', ['email' => 'biasa@example.com', 'password' => 'password-yang-panjang'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_is_throttled(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/login', ['email' => 'admin@example.com', 'password' => 'salah']);
        }

        $this->post('/admin/login', ['email' => 'admin@example.com', 'password' => 'salah'])->assertTooManyRequests();
    }

    public function test_login_page_is_not_indexed(): void
    {
        $this->get('/admin/login')->assertOk()->assertSee('noindex, nofollow', false);
    }
}
