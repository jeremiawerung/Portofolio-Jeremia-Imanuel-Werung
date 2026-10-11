<?php

namespace App\Http\Controllers;

use App\Services\SmartTalk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class SmartTalkController extends Controller
{
    public function index(SmartTalk $smartTalk): View
    {
        return view('pages.smart-talk', [
            'enabled' => $smartTalk->enabled(),
        ]);
    }

    public function ask(Request $request, SmartTalk $smartTalk): JsonResponse
    {
        if (! $smartTalk->enabled()) {
            return $this->unavailable();
        }

        $max = config('portfolio.smart_talk.max_history');

        $validated = $request->validate([
            'messages' => ['required', 'array', 'min:1', "max:{$max}"],
            'messages.*.role' => ['required', 'string', 'in:user,assistant'],
            'messages.*.content' => ['required', 'string', 'max:1000'],
        ]);

        $messages = array_map(fn ($m) => [
            'role' => $m['role'],
            'content' => trim(strip_tags($m['content'])),
        ], $validated['messages']);

        if (end($messages)['role'] !== 'user') {
            throw ValidationException::withMessages(['messages' => 'The last message must come from you.']);
        }

        // Batas harian buat semua pengunjung, biar kuota gratis gak habis
        $counterKey = 'smart-talk:count:'.now()->toDateString();
        Cache::add($counterKey, 0, now()->endOfDay());

        if (Cache::increment($counterKey) > config('portfolio.smart_talk.global_per_day')) {
            return response()->json([
                'message' => "Smart Talk has reached today's limit. Please come back tomorrow or use the Contact page.",
            ], 429);
        }

        try {
            return response()->json(['reply' => $smartTalk->reply($messages)]);
        } catch (Throwable $e) {
            // Detail error cuma masuk log, pengunjung dapet pesan umum
            Log::warning('Smart Talk gagal', ['error' => $e->getMessage()]);

            return $this->unavailable();
        }
    }

    private function unavailable(): JsonResponse
    {
        return response()->json([
            'message' => 'Smart Talk is taking a short break. Please try again in a moment.',
        ], 503);
    }
}
