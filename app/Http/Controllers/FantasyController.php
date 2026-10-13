<?php

namespace App\Http\Controllers;

use App\Models\FantasyFind;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

// Penghitung "berapa pengunjung yang nemu mode rahasia Gengar".
// Tampilan + gambarnya ada di public/fantasy (gak masuk repo), di sini cuma datanya.
class FantasyController extends Controller
{
    private const CACHE_KEY = 'fantasy.count';

    public function found(Request $request): JsonResponse
    {
        // Sama kayak analytics: IP gak disimpen, cuma hash-nya (dicampur kunci aplikasi)
        $hash = hash('sha256', implode('|', [
            $request->ip(),
            $request->userAgent(),
            config('app.key'),
        ]));

        // Orang yang sama dihitung sekali aja
        $added = FantasyFind::query()->insertOrIgnore([
            'visitor_hash' => $hash,
            'created_at' => now(),
        ]);

        if ($added) {
            Cache::forget(self::CACHE_KEY);
        }

        return response()->json(['ok' => true]);
    }

    public function count(): JsonResponse
    {
        $count = Cache::remember(self::CACHE_KEY, now()->addMinutes(5), fn () => FantasyFind::query()->count());

        return response()->json(['count' => $count]);
    }
}
