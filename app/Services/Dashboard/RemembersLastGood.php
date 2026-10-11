<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Cache yang tahan banting: kalau API luar lagi error, tampilin data
 * terakhir yang berhasil, bukan kosong. Gak butuh cron sama sekali,
 * data diambil ulang pas ada yang buka dashboard dan cache-nya udah basi.
 */
trait RemembersLastGood
{
    protected function rememberLastGood(string $key, int $ttl, callable $fetch): ?array
    {
        $cached = Cache::get($key);

        if (is_array($cached)) {
            return $cached['data'];
        }

        try {
            $data = $fetch();
        } catch (Throwable $e) {
            Log::warning("Dashboard: gagal ambil {$key}", ['error' => $e->getMessage()]);

            $data = Cache::get("{$key}:last");

            // Tahan 5 menit biar gak nembak API yang lagi error terus-terusan
            Cache::put($key, ['data' => $data], 300);

            return $data;
        }

        Cache::put($key, ['data' => $data], $ttl);
        Cache::forever("{$key}:last", $data);

        return $data;
    }
}
