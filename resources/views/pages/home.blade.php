@extends('layouts.portal')

@section('page', 'home')

@section('content')
    {{-- Perkenalan --}}
    <section class="reveal visible">
        <p class="text-sm text-muted">QA Engineer &amp; Web Developer, Yogyakarta</p>
        <h1 class="page-title mt-2 sm:text-5xl">Hi, I'm Jeremia Imanuel Werung.</h1>

        <p class="page-lead mt-5">
            I test software and build it. I write test cases, automate end-to-end flows with Playwright,
            and build Laravel apps that people actually use, like a salon reservation system and an offline-first
            RFID attendance system for schools.
        </p>
        <p class="page-lead mt-3">
            Fresh Information Systems graduate from Universitas Teknologi Yogyakarta, open to QA and web development roles.
        </p>

        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('projects') }}" class="btn-primary">View projects</a>
            <a href="{{ route('contact') }}" class="btn-outline">Get in touch</a>
        </div>
    </section>

    <hr class="page-divider">

    {{-- Skill --}}
    <section>
        <x-section-heading title="Skills" lead="What I use day to day." />
        @include('pages.partials.skills')
    </section>

    <hr class="page-divider">

    {{-- Project unggulan --}}
    <section>
        <x-section-heading title="Selected work" lead="Three projects I'd show first.">
            <x-slot:aside>
                <a href="{{ route('projects') }}" class="text-sm font-medium text-accent hover:underline underline-offset-4">All projects</a>
            </x-slot:aside>
        </x-section-heading>

        @php
            $featured = [
                ['img' => 'imagePresensiRFID.jpg', 'title' => 'RFID School Attendance System', 'tag' => 'Laravel, Filament, IoT', 'text' => 'Offline-first attendance with a custom WiFi card reader that signs every request. Covered by 244 PHPUnit tests.'],
                ['img' => 'image.png', 'title' => 'Aurora Beauty Salon System', 'tag' => 'Live in production', 'text' => 'Reservations with a two-stage payment. I wrote the test cases, ran black-box tests, and automated the booking flow.'],
                ['img' => 'imageGraciaPhoto.jpg', 'title' => 'Gracia Photo Company Profile', 'tag' => 'Business website', 'text' => 'A 5-page site with an installation simulator for schools, WCAG AA contrast, and hardened security headers.'],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($featured as $item)
                <a href="{{ route('projects') }}" class="group block reveal">
                    <div class="aspect-[16/10] overflow-hidden rounded-lg border border-line bg-surface-2">
                        <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['title'] }}" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                    </div>
                    <p class="mt-3 text-xs text-muted">{{ $item['tag'] }}</p>
                    <h3 class="mt-1 text-lg font-semibold text-ink group-hover:text-accent transition-colors">{{ $item['title'] }}</h3>
                    <p class="mt-1 text-sm text-ink-2 leading-relaxed">{{ $item['text'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <hr class="page-divider">

    {{-- Ajakan ke dashboard --}}
    <section class="reveal flex flex-col sm:flex-row sm:items-center gap-5">
        <div class="flex-1">
            <h2 class="text-xl font-semibold text-ink">Curious how active I am?</h2>
            <p class="mt-1 text-sm text-ink-2 leading-relaxed">
                The dashboard pulls my GitHub contributions, coding time, and this site's traffic automatically.
            </p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-outline shrink-0">Open dashboard</a>
    </section>
@endsection
