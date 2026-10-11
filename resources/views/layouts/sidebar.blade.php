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
    <button type="button" id="sidebar-close" class="lg:hidden absolute top-3 right-3 p-2 text-slate-400 hover:text-slate-100" aria-label="Close menu">
        <i data-lucide="x" class="w-5 h-5"></i>
    </button>

    {{-- Profil --}}
    <div class="px-6 pt-8 pb-6 text-center border-b border-slate-800/80">
        <a href="{{ route('home') }}" class="inline-block">
            <span class="block w-24 h-24 mx-auto rounded-full p-[3px] bg-gradient-to-br from-indigo-500 to-cyan-500">
                <img src="{{ asset('images/profile.jpeg') }}" alt="Jeremia Imanuel Werung" class="w-full h-full rounded-full object-cover border-4 border-[#0a0f1d]" width="96" height="96" decoding="async">
            </span>
        </a>
        <p class="mt-4 flex items-center justify-center gap-1.5 text-lg font-bold text-slate-100">
            Jeremia Werung
            <i data-lucide="badge-check" class="w-5 h-5 text-cyan-400" aria-label="Verified"></i>
        </p>
        <p class="text-sm text-slate-500">&#64;{{ config('portfolio.owner.handle') }}</p>
        <p class="mt-3 inline-flex items-center gap-1.5 rounded-full border border-emerald-500/25 bg-emerald-500/10 px-2.5 py-1 text-xs font-medium text-emerald-300">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            QA Engineer &amp; Web Developer
        </p>

        <div class="mt-4 flex items-center justify-center gap-2">
            <a href="https://github.com/{{ config('portfolio.owner.handle') }}" target="_blank" rel="noopener" class="p-2 rounded-lg text-slate-400 hover:text-slate-100 hover:bg-slate-800/70 transition-colors" aria-label="GitHub">
                <x-icon-github class="w-4 h-4" />
            </a>
            <a href="https://instagram.com/jeremia.werung" target="_blank" rel="noopener" class="p-2 rounded-lg text-slate-400 hover:text-slate-100 hover:bg-slate-800/70 transition-colors" aria-label="Instagram">
                <x-icon-instagram class="w-4 h-4" />
            </a>
            <a href="mailto:{{ config('portfolio.owner.email') }}" class="p-2 rounded-lg text-slate-400 hover:text-slate-100 hover:bg-slate-800/70 transition-colors" aria-label="Email">
                <i data-lucide="mail" class="w-4 h-4"></i>
            </a>
            <a href="https://wa.me/62895805193249" target="_blank" rel="noopener" class="p-2 rounded-lg text-slate-400 hover:text-slate-100 hover:bg-slate-800/70 transition-colors" aria-label="WhatsApp">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
            </a>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-4 py-5 space-y-1">
        @foreach ($menu as $item)
            @php $active = request()->routeIs($item['route']); @endphp
            <a href="{{ route($item['route']) }}" @class(['side-link', 'is-active' => $active]) @if ($active) aria-current="page" @endif>
                <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4"></i>
                {{ $item['label'] }}
                <i data-lucide="arrow-right" class="side-arrow w-4 h-4"></i>
            </a>
        @endforeach

        <div class="pt-3">
            <a href="{{ route('smart-talk') }}" @class(['smart-talk-btn', 'is-active' => request()->routeIs('smart-talk')]) @if (request()->routeIs('smart-talk')) aria-current="page" @endif>
                <i data-lucide="sparkles" class="w-4 h-4 text-indigo-300"></i>
                Smart Talk
                <span class="ml-auto rounded-full bg-indigo-500/20 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-indigo-200">AI</span>
            </a>
        </div>
    </nav>

    {{-- Footer --}}
    <div class="px-6 py-5 border-t border-slate-800/80 text-center text-xs text-slate-500 leading-relaxed">
        @auth
            <form method="POST" action="{{ route('logout') }}" class="mb-3">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-slate-400 hover:text-slate-100">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    Log out admin
                </button>
            </form>
        @endauth
        <p class="uppercase tracking-wider">Copyright &copy; {{ date('Y') }}</p>
        <p>Jeremia Imanuel Werung. All rights reserved.</p>
    </div>
</aside>
