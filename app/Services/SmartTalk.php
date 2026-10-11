<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * Chatbot "Smart Talk". Ngobrol lewat endpoint chat/completions yang
 * formatnya OpenAI-compatible, jadi provider-nya bisa diganti cukup dari .env.
 */
class SmartTalk
{
    public function enabled(): bool
    {
        return filled(config('services.smart_talk.key'));
    }

    /**
     * @param  array<int, array{role: string, content: string}>  $messages
     */
    public function reply(array $messages): string
    {
        $model = config('services.smart_talk.model');

        $payload = [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $this->systemPrompt()],
                ...$messages,
            ],
            'temperature' => 0.4,
            'max_completion_tokens' => 1024,
        ];

        // Model gpt-oss itu model "mikir", dibikin mikir sebentar aja biar cepet
        if (str_starts_with($model, 'openai/gpt-oss')) {
            $payload['reasoning_effort'] = 'low';
        }

        $response = Http::withToken(config('services.smart_talk.key'))
            ->baseUrl(rtrim(config('services.smart_talk.base_url'), '/'))
            ->acceptJson()
            ->timeout(40)
            ->post('/chat/completions', $payload)
            ->throw();

        $content = trim((string) $response->json('choices.0.message.content'));

        if ($content === '') {
            throw new RuntimeException('Jawaban AI kosong');
        }

        return $content;
    }

    private function systemPrompt(): string
    {
        $profile = file_get_contents(resource_path('ai/smart-talk.md'));

        return str_replace('{{today}}', now()->translatedFormat('j F Y'), $profile);
    }
}
