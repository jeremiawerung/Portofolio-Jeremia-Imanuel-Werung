<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Opsional. Kalau kosong, grafik kontribusi diambil dari API publik tanpa token.
    'github' => [
        'token' => env('GITHUB_TOKEN'),
    ],

    // Kalau kosong, bagian WakaTime di dashboard otomatis disembunyiin.
    'wakatime' => [
        'key' => env('WAKATIME_API_KEY'),
    ],

    // Smart Talk. Bisa provider apa aja yang formatnya OpenAI-compatible
    // (Groq, OpenRouter, NVIDIA NIM, Gemini). Kalau key kosong, Smart Talk offline.
    'smart_talk' => [
        'key' => env('SMART_TALK_API_KEY'),
        'base_url' => env('SMART_TALK_BASE_URL', 'https://api.groq.com/openai/v1'),
        'model' => env('SMART_TALK_MODEL', 'openai/gpt-oss-120b'),
    ],

];
