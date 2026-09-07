<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio Jeremia Imanuel Werung - QA Engineer, Web Developer, Data Analyst. Information Systems graduate with expertise in software quality assurance and web development.">
    <meta name="keywords" content="Jeremia Werung, QA Engineer, Web Developer, Data Analyst, Portfolio">
    <meta name="author" content="Jeremia Imanuel Werung">

    <title>Jeremia Imanuel Werung — Portfolio</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">

    {{-- ===== NAVBAR ===== --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-transparent transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Logo --}}
                <a href="#hero" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center font-bold text-white text-lg transition-transform group-hover:scale-110">
                        J
                    </div>
                    <span class="text-lg font-bold text-slate-100 hidden sm:block">
                        Jeremia<span class="text-indigo-400">.dev</span>
                    </span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center gap-6">
                    <a href="#hero" class="nav-link">Home</a>
                    <a href="#about" class="nav-link">About</a>
                    <a href="#experience" class="nav-link">Experience</a>
                    <a href="#projects" class="nav-link">Projects</a>
                    <a href="#case-studies" class="nav-link">Case Studies</a>
                    <a href="#automation" class="nav-link">Automation</a>
                    <a href="#articles" class="nav-link">Articles</a>
                    <a href="#products" class="nav-link">Products</a>
                    <a href="#skills" class="nav-link">Skills</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>

                {{-- CTA & Mobile Menu --}}
                <div class="flex items-center gap-3">
                    <a href="#contact" class="btn-primary hidden sm:inline-flex text-sm">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        Hire Me
                    </a>
                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-400 hover:text-indigo-400 transition-colors">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu Overlay --}}
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[60] hidden"></div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="mobile-menu fixed top-0 right-0 h-full w-72 bg-[#0f172a]/98 backdrop-blur-xl z-[70] p-6">
        <div class="flex justify-end mb-8">
            <button id="mobile-menu-close" class="p-2 text-slate-400 hover:text-indigo-400 transition-colors">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        <div class="flex flex-col gap-4">
            <a href="#hero" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Home</a>
            <a href="#about" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">About</a>
            <a href="#experience" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Experience</a>
            <a href="#projects" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Projects</a>
            <a href="#case-studies" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Case Studies</a>
            <a href="#automation" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Automation</a>
            <a href="#articles" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Articles</a>
            <a href="#products" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Products</a>
            <a href="#skills" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Skills</a>
            <a href="#contact" class="text-slate-300 hover:text-indigo-400 transition-colors py-2 text-lg font-medium">Contact</a>
            <hr class="border-slate-700 my-2">
            <a href="#contact" class="btn-primary justify-center">
                <i data-lucide="send" class="w-4 h-4"></i>
                Hire Me
            </a>
        </div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <main>
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="relative border-t border-slate-800/50 bg-[#0a0f1e]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                {{-- Brand --}}
                <div>
                    <a href="#hero" class="flex items-center gap-2 mb-4 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-500 flex items-center justify-center font-bold text-white text-lg transition-transform group-hover:scale-110">
                            J
                        </div>
                        <span class="text-lg font-bold text-slate-100">
                            Jeremia<span class="text-indigo-400">.dev</span>
                        </span>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-xs">
                        QA Engineer & Web Developer based in Yogyakarta, Indonesia. Building quality software with passion and precision.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-300 mb-4">Quick Links</h4>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="#about" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">About</a>
                        <a href="#experience" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Experience</a>
                        <a href="#projects" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Projects</a>
                        <a href="#case-studies" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Case Studies</a>
                        <a href="#automation" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Automation</a>
                        <a href="#articles" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Articles</a>
                        <a href="#products" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Products</a>
                        <a href="#skills" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Skills</a>
                        <a href="#contact" class="text-slate-400 hover:text-indigo-400 transition-colors text-sm py-1">Contact</a>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-300 mb-4">Get in Touch</h4>
                    <div class="space-y-3">
                        <a href="mailto:jeremia07102004@gmail.com" class="flex items-center gap-3 text-slate-400 hover:text-indigo-400 transition-colors text-sm">
                            <i data-lucide="mail" class="w-4 h-4 text-indigo-400"></i>
                            jeremia07102004@gmail.com
                        </a>
                        <a href="tel:+620895805193249" class="flex items-center gap-3 text-slate-400 hover:text-indigo-400 transition-colors text-sm">
                            <i data-lucide="phone" class="w-4 h-4 text-indigo-400"></i>
                            0895805193249
                        </a>
                        <a href="https://instagram.com/jeremia.werung" target="_blank" class="flex items-center gap-3 text-slate-400 hover:text-indigo-400 transition-colors text-sm">
                            <i data-lucide="instagram" class="w-4 h-4 text-indigo-400"></i>
                            @jeremia.werung
                        </a>
                        <div class="flex items-center gap-3 text-slate-400 text-sm">
                            <i data-lucide="map-pin" class="w-4 h-4 text-indigo-400"></i>
                            Yogyakarta, Indonesia
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="mt-12 pt-8 border-t border-slate-800/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} Jeremia Imanuel Werung. All rights reserved.
                </p>
                <p class="text-slate-600 text-xs">
                    Built with <span class="text-red-400">&hearts;</span> using Laravel & Tailwind CSS
                </p>
            </div>
        </div>
    </footer>

    {{-- Back to Top --}}
    <button id="back-to-top"
        class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-indigo-500/90 backdrop-blur-md text-white flex items-center justify-center shadow-lg shadow-indigo-500/30 hover:bg-indigo-500 transition-all duration-300 opacity-0 pointer-events-none translate-y-4">
        <i data-lucide="chevron-up" class="w-5 h-5"></i>
    </button>

    {{-- Initialize Lucide Icons --}}
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
