<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        // My Fantasy Mode (mode rahasia Gengar). Kode + gambarnya di public/fantasy,
        // sengaja gak masuk repo (gambar Pokémon), di-upload manual ke server.
        $fantasy = is_file(public_path('fantasy/js/index.js'));
    @endphp

    {{-- Pasang mode terang/gelap sebelum halaman digambar, biar gak kedip --}}
    <script>
        (function () {
            var saved = null;
            try { saved = localStorage.getItem('theme'); } catch (e) {}
            @if ($fantasy)
            if (saved === 'gengar') {
                document.documentElement.dataset.theme = 'gengar';
                // font mode Gengar langsung dimuat dari sini, gak nunggu JS-nya
                var font = document.createElement('link');
                font.id = 'fx-fonts';
                font.rel = 'stylesheet';
                font.href = 'https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Silkscreen&display=swap';
                document.head.appendChild(font);
                return;
            }
            @endif
            var dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.dataset.theme = dark ? 'dark' : 'light';
        })();
    </script>

    @php
        $pageTitle = trim($__env->yieldContent('title'));
        $fullTitle = $pageTitle ? "{$pageTitle} | Jeremia Imanuel Werung" : 'Jeremia Imanuel Werung | QA Engineer & Web Developer';
        // teks dari section description udah di-escape Blade, jadi dibalikin dulu biar di meta tag gak ke-escape dua kali (tanda petik jadi &#039;)
        $description = html_entity_decode(trim($__env->yieldContent('description')), ENT_QUOTES | ENT_HTML5, 'UTF-8') ?: 'Portfolio of Jeremia Imanuel Werung, a QA engineer and web developer in Yogyakarta, Indonesia. Projects, QA case studies, and a live developer dashboard.';
    @endphp

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="Jeremia Imanuel Werung">
    <meta name="theme-color" content="#f2eee6" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#151311" media="(prefers-color-scheme: dark)">
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
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600;6..72,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if ($fantasy)
        <link rel="stylesheet" href="{{ asset('fantasy/fantasy.css') }}?v={{ filemtime(public_path('fantasy/fantasy.css')) }}">
        <script>window.FANTASY_CONFIG = @json(['foundUrl' => route('fantasy.found'), 'countUrl' => route('fantasy.count')]);</script>
        <script type="module" src="{{ asset('fantasy/js/index.js') }}?v={{ filemtime(public_path('fantasy/js/index.js')) }}"></script>
    @endif
</head>
<body class="antialiased" data-page="@yield('page')">

    {{-- Bar atas (cuma di HP/tablet) --}}
    <header class="lg:hidden fixed top-0 inset-x-0 z-50 h-14 flex items-center justify-between px-4 bg-page/95 backdrop-blur border-b border-line">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('images/profile.jpeg') }}" alt="" class="w-8 h-8 rounded-full object-cover" width="32" height="32">
            <span class="font-serif text-lg font-semibold text-ink">Jeremia Imanuel Werung</span>
        </a>
        <button type="button" id="sidebar-open" class="p-2 text-ink-2 hover:text-ink" aria-label="Open menu" aria-controls="sidebar" aria-expanded="false">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </header>

    <div id="sidebar-overlay" class="fixed inset-0 z-[60] bg-black/50 hidden lg:hidden"></div>

    @include('layouts.sidebar')

    <main class="lg:pl-[17rem]">
        <div class="max-w-5xl mx-auto px-4 sm:px-8 pt-20 pb-16 lg:pt-14">
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
