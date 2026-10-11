@extends('layouts.portal')

@section('page', 'home')

@section('content')
    {{-- Perkenalan --}}
    <section class="reveal visible">
        <h1 class="page-title sm:text-4xl">
            Hi, I'm <span class="gradient-text">Jeremia Werung</span>
        </h1>

        <ul class="mt-3 flex flex-wrap gap-x-6 gap-y-1 text-sm text-slate-400">
            <li class="flex items-center gap-1.5"><i data-lucide="map-pin" class="w-4 h-4 text-slate-500"></i> Based in Yogyakarta, Indonesia</li>
            <li class="flex items-center gap-1.5"><i data-lucide="briefcase" class="w-4 h-4 text-slate-500"></i> Open to QA &amp; web development roles</li>
        </ul>

        <p class="mt-5 text-lg text-slate-300">
            I'm a
            <span id="typing-text" class="font-semibold text-indigo-400 border-r-2 border-indigo-400 pr-1" style="animation: blink-caret 0.75s step-end infinite;"></span>
        </p>

        <p class="page-lead mt-4">
            Information Systems graduate from Universitas Teknologi Yogyakarta, focused on software quality assurance and web development.
            I design test cases, automate end-to-end flows with Playwright, and build Laravel applications that run in production —
            from a salon reservation system to an offline-first RFID school attendance system. I care about the small details that make software reliable.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('projects') }}" class="btn-primary">
                <i data-lucide="folder-kanban" class="w-4 h-4"></i>
                View Projects
            </a>
            <a href="{{ route('smart-talk') }}" class="btn-outline">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
                Ask Smart Talk about me
            </a>
        </div>
    </section>

    <hr class="page-divider">

    {{-- Skill --}}
    <section>
        <x-section-heading icon="code-xml" title="Skills" lead="Tools, technologies, and methods I use day to day." />
        @include('pages.partials.skills')
    </section>

    <hr class="page-divider">

    {{-- Project unggulan --}}
    <section>
        <x-section-heading icon="rocket" title="Featured Work" lead="A few projects I'm proud of.">
            <x-slot:aside>
                <a href="{{ route('projects') }}" class="inline-flex items-center gap-1 text-sm font-medium text-indigo-400 hover:text-indigo-300">
                    All projects <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </x-slot:aside>
        </x-section-heading>

        @php
            $featured = [
                ['img' => 'imagePresensiRFID.jpg', 'title' => 'RFID School Attendance System', 'tag' => 'Laravel · Filament · IoT', 'text' => 'Offline-first attendance with a custom HMAC-signed WiFi card reader, covered by 244 PHPUnit tests.'],
                ['img' => 'image.png', 'title' => 'Aurora Beauty Salon System', 'tag' => 'Live in production', 'text' => 'Reservation and two-stage payment system — test cases, black-box testing, and Playwright automation.'],
                ['img' => 'imageGraciaPhoto.jpg', 'title' => 'Gracia Photo Company Profile', 'tag' => 'Business website', 'text' => 'A 5-page profile with an interactive installation simulator, WCAG AA contrast, and hardened headers.'],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach ($featured as $item)
                <a href="{{ route('projects') }}" class="glass-card overflow-hidden group block reveal">
                    <div class="h-36 overflow-hidden bg-slate-800">
                        <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-5">
                        <p class="text-xs uppercase tracking-wider text-slate-500">{{ $item['tag'] }}</p>
                        <h3 class="mt-1 font-semibold text-slate-100 group-hover:text-indigo-300 transition-colors">{{ $item['title'] }}</h3>
                        <p class="mt-2 text-sm text-slate-400 leading-relaxed">{{ $item['text'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <hr class="page-divider">

    {{-- Ajakan ke dashboard --}}
    <section class="glass-card p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center gap-5 reveal">
        <div class="w-12 h-12 shrink-0 rounded-xl bg-indigo-500/10 flex items-center justify-center">
            <i data-lucide="activity" class="w-6 h-6 text-indigo-400"></i>
        </div>
        <div class="flex-1">
            <h2 class="font-semibold text-slate-100">Not just finished work — the process, too</h2>
            <p class="mt-1 text-sm text-slate-400 leading-relaxed">
                My dashboard shows live data pulled automatically: GitHub contributions, coding activity, and this site's traffic.
            </p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-outline shrink-0">
            Open Dashboard <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </section>
@endsection
