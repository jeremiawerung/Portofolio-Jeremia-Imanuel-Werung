<?php

namespace App\Http\Middleware;

use App\Services\Dashboard\SiteAnalytics;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackPageView
{
    public function __construct(private SiteAnalytics $analytics)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Kunjungan admin (Jeremia sendiri) gak dihitung biar angkanya jujur
        if ($request->isMethod('GET') && $response->isOk() && ! Auth::check() && $this->analytics->shouldTrack($request)) {
            try {
                $this->analytics->record($request);
            } catch (Throwable $e) {
                // Analytics error jangan sampai bikin halaman ikut error
                Log::warning('Analytics gagal nyatet', ['error' => $e->getMessage()]);
            }
        }

        return $response;
    }
}
