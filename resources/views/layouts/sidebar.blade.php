@php
    $menu = [
        ['route' => 'home', 'label' => 'Home', 'icon' => 'house'],
        ['route' => 'about', 'label' => 'About', 'icon' => 'user-round'],
        ['route' => 'achievements', 'label' => 'Achievements', 'icon' => 'award'],
        ['route' => 'projects', 'label' => 'Projects', 'icon' => 'folder-kanban'],
        ['route' => 'case-studies', 'label' => 'Case Studies', 'icon' => 'microscope'],
        ['route' => 'insights', 'label' => 'Insights', 'icon' => 'lightbulb'],
        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard'],
        ['route' => 'chat', 'label' => 'Chat Room', 'icon' => 'messages-square'],
        ['route' => 'contact', 'label' => 'Contact', 'icon' => 'mail'],
    ];
@endphp

<aside id="sidebar" class="sidebar" aria-label="Main navigation">
    {{-- Tombol tutup (cuma di HP) --}}
    <button type="button" id="sidebar-close" class="lg:hidden absolute top-3 right-3 p-2 text-ink-2 hover:text-ink" aria-label="Close menu">
        <i data-lucide="x" class="w-5 h-5"></i>
    </button>

    {{-- Profil --}}
    <div class="px-6 pt-8 pb-6 text-center border-b border-line">
        <a href="{{ route('home') }}" class="inline-block">
            <img src="{{ asset('images/profile.jpeg') }}" alt="Jeremia Imanuel Werung" class="w-24 h-24 mx-auto rounded-full object-cover border border-line" width="96" height="96" decoding="async">
        </a>
        <p class="mt-4 font-serif text-xl font-semibold text-ink">Jeremia Werung</p>
        <p class="text-sm text-muted">QA Engineer &amp; Web Developer</p>

        <div class="mt-4 flex items-center justify-center gap-1">
            <a href="https://github.com/{{ config('portfolio.owner.handle') }}" target="_blank" rel="noopener" class="p-2 rounded-md text-muted hover:text-ink hover:bg-surface-2 transition-colors" aria-label="GitHub">
                <x-icon-github class="w-4 h-4" />
            </a>
            <a href="https://instagram.com/jeremia.werung" target="_blank" rel="noopener" class="p-2 rounded-md text-muted hover:text-ink hover:bg-surface-2 transition-colors" aria-label="Instagram">
                <x-icon-instagram class="w-4 h-4" />
            </a>
            <a href="mailto:{{ config('portfolio.owner.email') }}" class="p-2 rounded-md text-muted hover:text-ink hover:bg-surface-2 transition-colors" aria-label="Email">
                <i data-lucide="mail" class="w-4 h-4"></i>
            </a>
            <a href="https://wa.me/62895805193249" target="_blank" rel="noopener" class="p-2 rounded-md text-muted hover:text-ink hover:bg-surface-2 transition-colors" aria-label="WhatsApp">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
            </a>
        </div>

        {{-- Ganti mode terang/gelap --}}
        <div class="mt-4 theme-switch" role="group" aria-label="Color theme" data-theme-switch>
            <button type="button" data-theme-value="light" aria-pressed="false">
                <i data-lucide="sun" class="w-3.5 h-3.5"></i> Light
            </button>
            <button type="button" data-theme-value="dark" aria-pressed="false">
                <i data-lucide="moon" class="w-3.5 h-3.5"></i> Dark
            </button>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-4 py-5 space-y-0.5">
        @foreach ($menu as $item)
            @php $active = request()->routeIs($item['route']); @endphp
            <a href="{{ route($item['route']) }}" @class(['side-link', 'is-active' => $active]) @if ($active) aria-current="page" @endif>
                <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4"></i>
                {{ $item['label'] }}
                <i data-lucide="arrow-right" class="side-arrow w-4 h-4"></i>
            </a>
        @endforeach

        <div class="pt-4">
            <a href="{{ route('smart-talk') }}" @class(['smart-talk-btn', 'is-active' => request()->routeIs('smart-talk')]) @if (request()->routeIs('smart-talk')) aria-current="page" @endif>
                <i data-lucide="bot" class="w-4 h-4"></i>
                Smart Talk
            </a>
        </div>
    </nav>

    {{-- Footer --}}
    <div class="px-6 py-5 border-t border-line text-center text-xs text-muted leading-relaxed">
        @auth
            <form method="POST" action="{{ route('logout') }}" class="mb-3">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-ink-2 hover:text-ink">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    Log out admin
                </button>
            </form>
        @endauth
        <p>&copy; {{ date('Y') }} Jeremia Imanuel Werung</p>
    </div>
</aside>
