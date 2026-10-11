<?php

namespace App\Services\Dashboard;

use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiteAnalytics
{
    private const MONTHS = 6;

    // Penanda bot/crawler/tool. Kunjungan dari sini gak dihitung.
    private const BOT_PATTERN = '/bot|crawl|spider|slurp|curl|wget|python|httpclient|headless|lighthouse|preview|monitor|facebookexternalhit|whatsapp|telegram/i';

    public function shouldTrack(Request $request): bool
    {
        $agent = (string) $request->userAgent();

        if ($agent === '' || preg_match(self::BOT_PATTERN, $agent)) {
            return false;
        }

        // Browser yang lagi prefetch halaman, belum tentu dibuka beneran
        $purpose = $request->header('Sec-Purpose') ?? $request->header('Purpose');

        return ! ($purpose && str_contains($purpose, 'prefetch'));
    }

    public function record(Request $request): void
    {
        $hash = hash('sha256', implode('|', [
            now()->toDateString(),
            $request->ip(),
            $request->userAgent(),
            config('app.key'),
        ]));

        // Dianggap kunjungan baru kalau 30 menit terakhir orang ini gak buka halaman apa-apa
        $returning = PageView::where('visitor_hash', $hash)
            ->where('created_at', '>=', now()->subMinutes(30))
            ->exists();

        PageView::create([
            'path' => mb_substr('/'.ltrim($request->path(), '/'), 0, 255),
            'referrer_host' => $this->referrerHost($request),
            'visitor_hash' => $hash,
            'new_visit' => ! $returning,
        ]);

        // Bersih-bersih data lama sesekali, gantinya cron
        if (random_int(1, 500) === 1) {
            PageView::where('created_at', '<', now()->subMonths(13))->delete();
        }
    }

    public function summary(): array
    {
        return Cache::remember('dashboard:analytics', config('portfolio.cache.analytics'), function () {
            $since30 = now()->subDays(30);

            $totals = PageView::query()
                ->selectRaw('COUNT(*) AS views, COUNT(DISTINCT visitor_hash) AS visitors, COALESCE(SUM(new_visit), 0) AS visits, MIN(created_at) AS first_seen')
                ->first();

            $today = PageView::query()
                ->where('created_at', '>=', now()->startOfDay())
                ->selectRaw('COUNT(*) AS views, COUNT(DISTINCT visitor_hash) AS visitors')
                ->first();

            return [
                'totals' => [
                    'page_views' => (int) $totals->views,
                    'visitors' => (int) $totals->visitors,
                    'visits' => (int) $totals->visits,
                    'today_views' => (int) $today->views,
                    'today_visitors' => (int) $today->visitors,
                ],
                'tracking_since' => $totals->first_seen ? Carbon::parse($totals->first_seen)->toDateString() : null,
                'monthly' => $this->monthly(),
                'top_pages' => $this->top('path', $since30),
                'top_referrers' => $this->top('referrer_host', $since30),
                'updated_at' => now()->toIso8601String(),
            ];
        });
    }

    /**
     * Rekap per bulan. Dikelompokin per hari dulu pakai DATE() (jalan di
     * SQLite maupun MySQL), baru dijumlahin per bulan di PHP.
     */
    private function monthly(): array
    {
        $start = now()->startOfMonth()->subMonths(self::MONTHS - 1);

        $days = PageView::query()
            ->where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) AS day, COUNT(*) AS views, COUNT(DISTINCT visitor_hash) AS visitors')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        $months = [];
        for ($i = 0; $i < self::MONTHS; $i++) {
            $month = $start->copy()->addMonths($i);
            $months[$month->format('Y-m')] = [
                'label' => $month->format('M'),
                'month' => $month->format('Y-m'),
                'page_views' => 0,
                'visitors' => 0,
            ];
        }

        foreach ($days as $day) {
            $key = substr((string) $day->day, 0, 7);

            if (isset($months[$key])) {
                $months[$key]['page_views'] += (int) $day->views;
                $months[$key]['visitors'] += (int) $day->visitors;
            }
        }

        return array_values($months);
    }

    private function top(string $column, Carbon $since): array
    {
        return PageView::query()
            ->where('created_at', '>=', $since)
            ->whereNotNull($column)
            ->select($column.' AS label', DB::raw('COUNT(*) AS total'))
            ->groupBy($column)
            ->orderByDesc('total')
            ->limit(6)
            ->get()
            ->map(fn ($row) => ['label' => (string) $row->label, 'total' => (int) $row->total])
            ->all();
    }

    private function referrerHost(Request $request): ?string
    {
        $host = parse_url((string) $request->headers->get('referer'), PHP_URL_HOST);

        if (! $host || strcasecmp($host, $request->getHost()) === 0) {
            return null;
        }

        return mb_substr(preg_replace('/^www\./i', '', strtolower($host)), 0, 100);
    }
}
