<?php

namespace App\Services\Dashboard;

use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Cache yang tahan banting: kalau API luar lagi error, tampilin data
 * terakhir yang berhasil, bukan kosong. Gak butuh cron sama sekali,
 * data diambil ulang pas ada yang buka dashboard dan cache-nya udah basi.
 *
 * Pas cache basi, cuma 1 request yang boleh nembak API luar. Request lain
 * nunggu hasilnya, biar gak rame-rame nembak barengan dan kena batas
 * thread hosting (CloudLinux LVE dipakai bareng web lain di akun yang sama).
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
            return Cache::lock("{$key}:fetching", 30)->block(config('portfolio.cache.lock_wait'), function () use ($key, $ttl, $fetch) {
                // Bisa jadi request lain udah ngisi cache selama kita nunggu giliran
                $cached = Cache::get($key);

                return is_array($cached) ? $cached['data'] : $this->fetchAndStore($key, $ttl, $fetch);
            });
        } catch (LockTimeoutException) {
            // Kelamaan nunggu giliran: kasih data terakhir yang ada aja
            return Cache::get("{$key}:last");
        }
    }

    private function fetchAndStore(string $key, int $ttl, callable $fetch): ?array
    {
        try {
            $data = $fetch();
        } catch (Throwable $e) {
            Log::warning("Dashboard: gagal ambil {$key}", ['error' => $e->getMessage()]);

            $last = Cache::get("{$key}:last");

            // Tahan sebentar biar gak nembak API yang lagi error terus-terusan.
            // Kalau belum ada data lama sama sekali, cukup 1 menit biar cepet dicoba lagi.
            Cache::put($key, ['data' => $last], $last === null ? 60 : 300);

            return $last;
        }

        Cache::put($key, ['data' => $data], $ttl);
        Cache::forever("{$key}:last", $data);

        return $data;
    }
}
