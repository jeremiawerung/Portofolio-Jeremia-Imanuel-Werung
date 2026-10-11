<?php

namespace Tests\Feature;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatRoomTest extends TestCase
{
    use RefreshDatabase;

    private function send(array $data)
    {
        return $this->postJson('/chat-room/messages', $data + ['website' => '']);
    }

    private function admin(): User
    {
        $user = User::factory()->create(['name' => 'Jeremia Werung']);
        $user->is_admin = true;
        $user->save();

        return $user;
    }

    public function test_visitor_can_send_a_message(): void
    {
        $this->send(['name' => 'Siti', 'message' => 'Halo kak!'])
            ->assertCreated()
            ->assertJsonPath('message.name', 'Siti')
            ->assertJsonPath('message.is_author', false)
            ->assertJsonMissingPath('message.ip_hash');

        $this->assertDatabaseHas('chat_messages', ['name' => 'Siti', 'message' => 'Halo kak!']);
    }

    public function test_html_is_stripped_from_messages(): void
    {
        $this->send(['name' => '<b>Budi</b>', 'message' => '<script>alert(1)</script>hai'])
            ->assertCreated()
            ->assertJsonPath('message.name', 'Budi')
            ->assertJsonPath('message.message', 'alert(1)hai');
    }

    public function test_message_that_is_only_html_is_rejected(): void
    {
        $this->send(['name' => 'Budi', 'message' => '<b></b>'])->assertUnprocessable();
    }

    public function test_links_from_visitors_are_rejected(): void
    {
        $this->send(['name' => 'Spam', 'message' => 'promo www.spam.example'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('message');

        $this->assertDatabaseCount('chat_messages', 0);
    }

    public function test_honeypot_pretends_success_but_saves_nothing(): void
    {
        $this->postJson('/chat-room/messages', ['name' => 'Bot', 'message' => 'buy', 'website' => 'http://x'])
            ->assertCreated()
            ->assertJsonPath('message', null);

        $this->assertDatabaseCount('chat_messages', 0);
    }

    public function test_same_message_twice_is_rejected(): void
    {
        $this->send(['name' => 'Siti', 'message' => 'Halo'])->assertCreated();
        $this->send(['name' => 'Siti', 'message' => 'Halo'])->assertUnprocessable();
    }

    public function test_validation_limits(): void
    {
        $this->send(['name' => '', 'message' => ''])->assertJsonValidationErrors(['name', 'message']);
        $this->send(['name' => str_repeat('a', 41), 'message' => 'x'])->assertJsonValidationErrors('name');
        $this->send(['name' => 'a', 'message' => str_repeat('x', 501)])->assertJsonValidationErrors('message');
    }

    public function test_visitors_are_rate_limited(): void
    {
        $limit = config('portfolio.chat.per_minute');

        for ($i = 1; $i <= $limit; $i++) {
            $this->send(['name' => 'Siti', 'message' => "Pesan {$i}"])->assertCreated();
        }

        $this->send(['name' => 'Siti', 'message' => 'Satu lagi'])->assertTooManyRequests();
    }

    public function test_polling_returns_only_newer_messages(): void
    {
        $this->send(['name' => 'A', 'message' => 'satu']);
        $this->send(['name' => 'B', 'message' => 'dua']);
        $firstId = ChatMessage::min('id');

        $this->getJson('/chat-room/messages')->assertOk()->assertJsonCount(2, 'messages');
        $this->getJson("/chat-room/messages?after={$firstId}")
            ->assertOk()
            ->assertJsonCount(1, 'messages')
            ->assertJsonPath('messages.0.message', 'dua');
    }

    public function test_guest_and_non_admin_cannot_delete(): void
    {
        $this->send(['name' => 'Siti', 'message' => 'Halo']);
        $id = ChatMessage::first()->id;

        $this->deleteJson("/chat-room/messages/{$id}")->assertUnauthorized();

        $this->actingAs(User::factory()->create())
            ->deleteJson("/chat-room/messages/{$id}")
            ->assertForbidden();

        $this->assertDatabaseCount('chat_messages', 1);
    }

    public function test_admin_replies_as_author_without_limits_and_can_delete(): void
    {
        $this->send(['name' => 'Siti', 'message' => 'Halo']);
        $admin = $this->admin();

        for ($i = 0; $i < config('portfolio.chat.per_minute') + 2; $i++) {
            $this->actingAs($admin)
                ->postJson('/chat-room/messages', ['message' => "Balasan {$i} https://github.com/jeremiawerung"])
                ->assertCreated()
                ->assertJsonPath('message.is_author', true)
                ->assertJsonPath('message.name', 'Jeremia Werung');
        }

        $id = ChatMessage::where('is_author', false)->first()->id;
        $this->actingAs($admin)->deleteJson("/chat-room/messages/{$id}")->assertOk();
        $this->assertDatabaseMissing('chat_messages', ['id' => $id]);
    }

    public function test_is_admin_cannot_be_mass_assigned(): void
    {
        $user = User::create(['name' => 'X', 'email' => 'x@example.com', 'password' => 'secret-password', 'is_admin' => true]);

        $this->assertFalse((bool) $user->fresh()->is_admin);
    }
}
