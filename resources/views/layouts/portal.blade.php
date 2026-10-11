<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pageTitle = trim($__env->yieldContent('title'));
        $fullTitle = $pageTitle ? "{$pageTitle} — Jeremia Werung" : 'Jeremia Imanuel Werung — QA Engineer & Web Developer';
        $description = trim($__env->yieldContent('description')) ?: 'Portfolio of Jeremia Imanuel Werung, QA Engineer and Web Developer from Yogyakarta, Indonesia — projects, QA case studies, and a live developer dashboard.';
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="Jeremia Imanuel Werung">
    <meta name="theme-color" content="#0a0f1d">
    @hasSection('noindex')
        <meta name="robots" content="noindex, nofollow">
    @endif

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset('images/profile.jpeg') }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased" data-page="@yield('page')">

    {{-- Bar atas (cuma di HP/tablet) --}}
    <header class="lg:hidden fixed top-0 inset-x-0 z-50 h-14 flex items-center justify-between px-4 bg-[#0a0f1d]/95 backdrop-blur border-b border-slate-800/80">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('images/profile.jpeg') }}" alt="" class="w-8 h-8 rounded-full object-cover" width="32" height="32">
            <span class="font-semibold text-slate-100">Jeremia Werung</span>
        </a>
        <button type="button" id="sidebar-open" class="p-2 text-slate-300 hover:text-white" aria-label="Open menu" aria-controls="sidebar" aria-expanded="false">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </header>

    <div id="sidebar-overlay" class="fixed inset-0 z-[60] bg-black/60 backdrop-blur-sm hidden lg:hidden"></div>

    @include('layouts.sidebar')

    <main class="lg:pl-[17rem]">
        <div class="max-w-5xl mx-auto px-4 sm:px-8 pt-20 pb-16 lg:pt-12">
            @yield('content')
        </div>
    </main>

    <script src="https://unpkg.com/lucide@1.55.0/dist/umd/lucide.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
