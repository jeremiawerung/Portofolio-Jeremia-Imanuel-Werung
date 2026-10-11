<?php

namespace App\Http\Controllers;

use App\Services\Dashboard\GitHubContributions;
use App\Services\Dashboard\SiteAnalytics;
use App\Services\Dashboard\WakaTimeStats;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(WakaTimeStats $wakatime): View
    {
        return view('pages.dashboard', [
            'wakatimeEnabled' => $wakatime->enabled(),
        ]);
    }

    // Data diambil lewat JS biar halaman langsung kebuka walau API luar lagi lemot
    public function github(GitHubContributions $github): JsonResponse
    {
        return $this->respond($github->get());
    }

    public function wakatime(WakaTimeStats $wakatime): JsonResponse
    {
        return $this->respond($wakatime->get());
    }

    public function analytics(SiteAnalytics $analytics): JsonResponse
    {
        return $this->respond($analytics->summary());
    }

    private function respond(?array $data): JsonResponse
    {
        if ($data === null) {
            return response()->json(['message' => 'Data is unavailable right now.'], 503);
        }

        return response()->json($data);
    }
}
