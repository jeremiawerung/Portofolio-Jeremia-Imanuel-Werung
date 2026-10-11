{{-- ===== HERO SECTION ===== --}}
<section id="hero" class="relative min-h-screen flex items-center overflow-hidden">
    {{-- Particle Canvas --}}
    <canvas id="particle-canvas" class="absolute inset-0 z-0"></canvas>

    {{-- Background Decorations --}}
    <div class="bg-decoration w-[600px] h-[600px] bg-indigo-600 -top-40 -right-40 absolute"></div>
    <div class="bg-decoration w-[500px] h-[500px] bg-cyan-600 -bottom-40 -left-40 absolute"></div>
    <div class="bg-decoration w-[300px] h-[300px] bg-violet-600 top-1/3 left-1/4 absolute animate-pulse-glow"></div>

    {{-- Grid Pattern Overlay --}}
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image: radial-gradient(circle, #6366f1 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20 lg:pt-40 lg:pb-32 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Left Content --}}
            <div class="order-2 lg:order-1">
                {{-- Name --}}
                <h1 class="font-black leading-tight mb-4"
                    style="font-size: clamp(1.7rem, 4vw, 3.4rem); animation: slide-up 0.8s ease-out forwards;">
                    <span class="text-slate-100">Hi, I'm</span><br>
                    <span class="gradient-text">Jeremia Werung</span>
                </h1>

                {{-- Typing Effect --}}
                <div class="flex items-center gap-2 mb-6" style="animation: slide-up 1s ease-out forwards;">
                    <span class="text-xl sm:text-2xl text-slate-400 font-light">I'm a</span>
                    <span id="typing-text" class="text-xl sm:text-2xl font-semibold text-indigo-400 border-r-2 border-indigo-400 pr-1"
                          style="animation: blink-caret 0.75s step-end infinite;"></span>
                </div>

                {{-- Description --}}
                <p class="text-slate-400 text-base sm:text-lg leading-relaxed mb-8 max-w-xl"
                   style="animation: slide-up 1.2s ease-out forwards;">
                    Information Systems student with a strong focus on system analysis, data processing, and operational administration. Highly adaptable and ready to contribute to business operations in a dynamic work environment.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4" style="animation: slide-up 1.4s ease-out forwards;">
                    <a href="#projects" class="btn-primary">
                        <i data-lucide="folder-open" class="w-5 h-5"></i>
                        View Projects
                    </a>
                    <a href="#contact" class="btn-outline">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        Let's Talk
                    </a>
                </div>

            </div>

            {{-- Right - Profile Visual --}}
            <div class="order-1 lg:order-2 flex justify-center lg:justify-end"
                 style="animation: fade-in 1.5s ease-out forwards;">
                
                {{-- Status Badge (Reverted & Empty) --}}
                <div></div>

                <div class="relative">
                    {{-- Orbiting Elements --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-[280px] h-[280px] sm:w-[340px] sm:h-[340px] rounded-full border border-indigo-500/10 animate-spin" style="animation-duration: 20s;">
                            <div class="absolute -top-3 left-1/2 w-6 h-6 rounded-lg bg-indigo-500/20 backdrop-blur flex items-center justify-center">
                                <span class="text-xs">🔍</span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-[340px] h-[340px] sm:w-[400px] sm:h-[400px] rounded-full border border-cyan-500/10 animate-spin" style="animation-duration: 30s; animation-direction: reverse;">
                            <div class="absolute -top-3 left-1/2 w-6 h-6 rounded-lg bg-cyan-500/20 backdrop-blur flex items-center justify-center">
                                <span class="text-xs">💻</span>
                            </div>
                        </div>
                    </div>

                    {{-- Profile Image Placeholder --}}
                    <div class="relative w-56 h-56 sm:w-72 sm:h-72 rounded-3xl overflow-hidden glow group">
                        <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-violet-600 to-cyan-600 flex items-center justify-center">
                            <div class="text-center">
                                <span class="text-6xl sm:text-7xl font-black text-white/90">JW</span>
                                <p class="text-white/60 text-xs mt-2 font-medium tracking-widest uppercase">Portfolio</p>
                            </div>
                        </div>
                        <img src="{{ asset('images/profile.jpeg') }}" alt="Jeremia Werung" fetchpriority="high" decoding="async" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        {{-- Shine effect --}}
                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-transparent pointer-events-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 animate-bounce">
        <span class="text-slate-500 text-xs tracking-widest uppercase">Scroll Down</span>
        <i data-lucide="chevron-down" class="w-5 h-5 text-indigo-400"></i>
    </div>
</section>
