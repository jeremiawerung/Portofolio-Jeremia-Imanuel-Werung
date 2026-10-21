<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\WakaTimeOAuth;
use App\Services\Dashboard\WakaTimeStats;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

/**
 * Nyambungin dashboard ke WakaTime lewat OAuth. Cukup sekali dari akun admin,
 * abis itu token di-refresh sendiri sama WakaTimeOAuth.
 */
class WakaTimeController extends Controller
{
    private const STATE_KEY = 'wakatime_oauth_state';

    public function connect(Request $request, WakaTimeOAuth $oauth): RedirectResponse
    {
        abort_unless($oauth->configured(), 404);

        // state acak disimpen di session, dicocokin lagi pas callback (anti-CSRF)
        $state = Str::random(40);
        $request->session()->put(self::STATE_KEY, $state);

        return redirect()->away($oauth->authorizeUrl($state));
    }

    public function callback(Request $request, WakaTimeOAuth $oauth, WakaTimeStats $stats): RedirectResponse
    {
        abort_unless($oauth->configured(), 404);

        // pull: state cuma boleh dipakai sekali
        $expected = $request->session()->pull(self::STATE_KEY);

        $validator = Validator::make($request->query(), [
            'state' => ['required', 'string', 'max:100'],
            'code' => ['nullable', 'string', 'max:1000'],
            'error' => ['nullable', 'string', 'max:200'],
        ]);

        if ($validator->fails() || ! is_string($expected) || ! hash_equals($expected, $request->query('state'))) {
            return $this->back('error', 'The WakaTime connection could not be verified. Please try again.');
        }

        $data = $validator->validated();

        if (filled($data['error'] ?? null) || blank($data['code'] ?? null)) {
            return $this->back('error', 'The WakaTime connection was cancelled.');
        }

        try {
            $oauth->connect($data['code']);
        } catch (Throwable $e) {
            // Pesannya udah aman (cuma status code), gak ada token di sini
            Log::warning('Dashboard: gagal nyambungin WakaTime', ['error' => $e->getMessage()]);

            return $this->back('error', 'WakaTime did not accept the connection. Please try again.');
        }

        $stats->refreshSoon();

        return $this->back('success', 'WakaTime is connected. The stats below will load from now on.');
    }

    private function back(string $type, string $message): RedirectResponse
    {
        return redirect()->route('dashboard')->with('wakatime_status', compact('type', 'message'));
    }
}
