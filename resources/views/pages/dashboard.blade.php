@extends('layouts.portal')

@section('title', 'Dashboard')
@section('page', 'dashboard')
@section('description', "Jeremia Werung's live dashboard: site traffic, GitHub contributions, and coding activity, updated automatically.")

@php
    $tile = fn (string $label, string $key, string $suffix = '') => compact('label', 'key', 'suffix');
@endphp

@section('content')
    <x-page-header title="Dashboard" lead="Numbers pulled automatically from GitHub, WakaTime, and this site's own traffic. Nothing here is typed in by hand." />

    {{-- ===== SITE ANALYTICS ===== --}}
    <section data-dashboard="analytics" data-endpoint="{{ route('dashboard.analytics') }}">
        <x-section-heading title="Site Analytics" lead="Visits to this site. No cookies, and IP addresses are never stored.">
            <x-slot:aside>
                <span class="text-xs text-muted" data-field="tracking_since"></span>
            </x-slot:aside>
        </x-section-heading>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ([
                $tile('Page views', 'page_views'),
                $tile('Visitors', 'visitors'),
                $tile('Visits', 'visits'),
                $tile('Views today', 'today_views'),
            ] as $t)
                <div class="stat-tile">
                    <p class="stat-label">{{ $t['label'] }}</p>
                    <p class="stat-value" data-stat="{{ $t['key'] }}"><span class="skeleton w-16"></span></p>
                </div>
            @endforeach
        </div>

        <div class="glass-card p-5 mt-4">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <p class="text-sm font-medium text-ink-2">Monthly traffic (last 6 months)</p>
                <div class="flex items-center gap-4 text-xs text-ink-2">
                    <span class="flex items-center gap-1.5"><span class="legend-swatch" style="background: var(--series-1)"></span> Page views</span>
                    <span class="flex items-center gap-1.5"><span class="legend-swatch" style="background: var(--series-2)"></span> Visitors</span>
                </div>
            </div>
            <div data-chart="monthly">
                <div class="skeleton w-full" style="height: 220px"></div>
            </div>
            <details class="mt-4">
                <summary class="cursor-pointer text-xs text-muted hover:text-ink-2">View as table</summary>
                <table class="test-table mt-3" data-table="monthly">
                    <thead><tr><th>Month</th><th>Page views</th><th>Visitors</th></tr></thead>
                    <tbody></tbody>
                </table>
            </details>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div class="glass-card p-5">
                <p class="text-sm font-medium text-ink-2 mb-4">Top pages (last 30 days)</p>
                <ul class="space-y-3" data-list="top_pages"><li><span class="skeleton w-full"></span></li></ul>
            </div>
            <div class="glass-card p-5">
                <p class="text-sm font-medium text-ink-2 mb-4">Where visitors come from (last 30 days)</p>
                <ul class="space-y-3" data-list="top_referrers"><li><span class="skeleton w-full"></span></li></ul>
            </div>
        </div>
    </section>

    <hr class="page-divider">

    {{-- ===== GITHUB ===== --}}
    <section data-dashboard="github" data-endpoint="{{ route('dashboard.github') }}">
        <div class="mb-5">
            <h2 class="flex items-center gap-2 text-lg font-semibold text-ink">
                <x-icon-github class="w-5 h-5 text-accent" />
                GitHub Contributions
            </h2>
            <div class="mt-1 flex flex-wrap items-center justify-between gap-2">
                <p class="text-sm text-ink-2">My GitHub activity over the past year.</p>
                <a href="https://github.com/{{ config('portfolio.github.username') }}" target="_blank" rel="noopener" class="text-sm text-ink-2 hover:text-accent">&#64;{{ config('portfolio.github.username') }}</a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ([
                $tile('Total', 'total'),
                $tile('This week', 'this_week'),
                $tile('Best day', 'best'),
                $tile('Average', 'average', '/ day'),
            ] as $t)
                <div class="stat-tile">
                    <p class="stat-label">{{ $t['label'] }}</p>
                    <p class="stat-value" data-stat="{{ $t['key'] }}" data-suffix="{{ $t['suffix'] }}"><span class="skeleton w-14"></span></p>
                </div>
            @endforeach
        </div>

        <div class="glass-card p-5 mt-4">
            <div class="heatmap-scroll" data-chart="heatmap">
                <div class="skeleton w-full" style="height: 110px"></div>
            </div>
            <div class="mt-3 flex items-center justify-end gap-1.5 text-xs text-muted">
                Less
                @for ($level = 0; $level <= 4; $level++)
                    <span class="heat-cell" data-level="{{ $level }}"></span>
                @endfor
                More
            </div>
        </div>
    </section>

    @if ($wakatimeEnabled)
        <hr class="page-divider">

        {{-- ===== WAKATIME ===== --}}
        <section data-dashboard="wakatime" data-endpoint="{{ route('dashboard.wakatime') }}">
            <x-section-heading title="WakaTime Stats" lead="My coding activity over the past 7 days, tracked by the WakaTime editor plugin.">
                <x-slot:aside>
                    <span class="text-xs text-muted" data-field="updated_at"></span>
                </x-slot:aside>
            </x-section-heading>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach ([
                    $tile('Start date', 'start_date'),
                    $tile('End date', 'end_date'),
                    $tile('Average daily coding time', 'daily_average'),
                    $tile('Total this week', 'total_week'),
                    $tile('Best day', 'best_day'),
                    $tile('All-time coding since joined', 'all_time'),
                ] as $t)
                    <div class="stat-tile">
                        <p class="stat-label">{{ $t['label'] }}</p>
                        <p class="mt-1 text-base font-semibold text-ink" data-stat="{{ $t['key'] }}"><span class="skeleton w-32"></span></p>
                    </div>
                @endforeach
            </div>

            <div class="glass-card p-5 mt-4">
                <p class="text-sm font-medium text-ink-2 mb-4">Languages this week</p>
                <ul class="space-y-3" data-list="languages"><li><span class="skeleton w-full"></span></li></ul>
            </div>
        </section>
    @elseif (app()->environment('local'))
        <hr class="page-divider">
        {{-- Pengingat ini cuma muncul di laptop, gak bakal kelihatan di server --}}
        <div class="rounded-xl border border-dashed border-warn bg-warn-soft p-5 text-sm text-warn">
            <strong>Catatan lokal:</strong> bagian WakaTime disembunyiin karena <code>WAKATIME_API_KEY</code> di .env masih kosong.
        </div>
    @endif
@endsection
