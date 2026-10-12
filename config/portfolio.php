<?php

/*
|--------------------------------------------------------------------------
| Setelan portofolio
|--------------------------------------------------------------------------
| Yang rahasia (token, API key) tetep di config/services.php dan .env.
| File ini cuma buat angka batas dan identitas yang boleh dilihat publik.
*/

return [

    'owner' => [
        'name' => 'Jeremia Imanuel Werung',
        'short_name' => 'Jeremia Werung',
        'handle' => 'jeremiawerung',
        'email' => 'jeremia07102004@gmail.com',
    ],

    'github' => [
        'username' => env('GITHUB_USERNAME', 'jeremiawerung'),
    ],

    // Lama data dashboard disimpen di cache sebelum diambil ulang (detik)
    'cache' => [
        'github' => 3600,
        'wakatime' => 3600,
        'analytics' => 60,
        'lock_wait' => 10,        // detik nunggu request lain yang lagi ngambil data API
    ],

    'chat' => [
        'history' => 50,          // jumlah pesan yang ditampilin pertama kali
        'per_minute' => 5,        // batas kirim per IP per menit
        'per_day' => 30,          // batas kirim per IP per hari
    ],

    'smart_talk' => [
        'per_minute' => 6,        // batas tanya per IP per menit
        'per_day' => 40,          // batas tanya per IP per hari
        'global_per_day' => (int) env('SMART_TALK_DAILY_LIMIT', 300), // biar kuota gratis Groq gak jebol
        'max_history' => 12,      // pesan terakhir yang ikut dikirim ke AI
    ],

];
