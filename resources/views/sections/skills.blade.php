{{-- ===== SKILLS SECTION ===== --}}
<section id="skills" class="relative py-20 lg:py-28 overflow-hidden">
    {{-- Background --}}
    <div class="bg-decoration w-[400px] h-[400px] bg-indigo-600 -right-40 top-1/4 absolute"></div>
    <div class="bg-decoration w-[300px] h-[300px] bg-cyan-600 -left-32 bottom-20 absolute"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="tag mb-4 inline-flex">
                <i data-lucide="wrench" class="w-3 h-3 mr-1.5"></i>
                Skills
            </span>
            <h2 class="section-title text-slate-100 mt-3">
                Technical <span class="gradient-text">Expertise</span>
            </h2>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                Technologies and tools I work with on a regular basis
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">
            {{-- Left - Skill Bars --}}
            <div class="space-y-6 reveal">
                <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-6">
                    <i data-lucide="code-2" class="w-5 h-5 text-indigo-400"></i>
                    Programming & Frameworks
                </h3>

                {{-- PHP / Laravel --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-300">PHP / Laravel</span>
                        <span class="text-xs text-indigo-400 font-semibold">85%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="--skill-level: 85%"></div>
                    </div>
                </div>

                {{-- HTML / CSS --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-300">HTML / CSS / Tailwind</span>
                        <span class="text-xs text-indigo-400 font-semibold">90%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="--skill-level: 90%"></div>
                    </div>
                </div>

                {{-- JavaScript --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-300">JavaScript</span>
                        <span class="text-xs text-indigo-400 font-semibold">75%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="--skill-level: 75%"></div>
                    </div>
                </div>

                {{-- MySQL --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-300">MySQL / Database</span>
                        <span class="text-xs text-indigo-400 font-semibold">80%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="--skill-level: 80%"></div>
                    </div>
                </div>

                {{-- Python --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-300">Python</span>
                        <span class="text-xs text-indigo-400 font-semibold">65%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="--skill-level: 65%"></div>
                    </div>
                </div>

                {{-- Git --}}
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-slate-300">Git / Version Control</span>
                        <span class="text-xs text-indigo-400 font-semibold">78%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" style="--skill-level: 78%"></div>
                    </div>
                </div>
            </div>

            {{-- Right - Skill Categories --}}
            <div class="space-y-6 reveal">
                {{-- QA & Testing --}}
                <div class="glass-card p-6">
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                            <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                        </div>
                        Quality Assurance
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="tag">Manual Testing</span>
                        <span class="tag">Black Box Testing</span>
                        <span class="tag">Functional Testing (CRUD)</span>
                        <span class="tag">UI/UX Testing</span>
                        <span class="tag">Test Cases & Scenarios</span>
                        <span class="tag">Bug Reports</span>
                    </div>
                </div>

                {{-- Data & Analytics --}}
                <div class="glass-card p-6">
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                            <i data-lucide="bar-chart-3" class="w-4 h-4 text-violet-400"></i>
                        </div>
                        Data & Analytics
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="tag">Data Analysis</span>
                        <span class="tag">Data Processing</span>
                        <span class="tag">RapidMiner</span>
                        <span class="tag">Microsoft Excel</span>
                    </div>
                </div>

                {{-- Tools & Platforms --}}
                <div class="glass-card p-6">
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-cyan-500/10 flex items-center justify-center">
                            <i data-lucide="settings-2" class="w-4 h-4 text-cyan-400"></i>
                        </div>
                        Tools & Platforms
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="tag">Figma</span>
                        <span class="tag">VS Code</span>
                        <span class="tag">Microsoft Word</span>
                        <span class="tag">Microsoft Excel</span>
                        <span class="tag">RapidMiner</span>
                    </div>
                </div>

                {{-- Soft Skills --}}
                <div class="glass-card p-6">
                    <h3 class="text-lg font-bold text-slate-100 flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center">
                            <i data-lucide="heart-handshake" class="w-4 h-4 text-amber-400"></i>
                        </div>
                        Soft Skills
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="tag">Attention to Detail</span>
                        <span class="tag">Analytical Thinking</span>
                        <span class="tag">Effective Communication</span>
                        <span class="tag">Problem Solving</span>
                        <span class="tag">Adaptability</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
