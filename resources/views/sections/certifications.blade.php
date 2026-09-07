{{-- ===== CERTIFICATIONS SECTION ===== --}}
<section id="certifications" class="relative py-20 lg:py-28 overflow-hidden">
    {{-- Background --}}
    <div class="bg-decoration w-[400px] h-[400px] bg-cyan-600 -right-40 bottom-20 absolute"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="tag mb-4 inline-flex">
                <i data-lucide="award" class="w-3 h-3 mr-1.5"></i>
                Certifications
            </span>
            <h2 class="section-title text-slate-100 mt-3">
                Licenses & <span class="gradient-text">Certifications</span>
            </h2>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                Professional certifications and courses I've completed to stay current
            </p>
        </div>

        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Cert 1 --}}
            <div class="reveal">
                <div class="glass-card p-6 h-full">
                    <div class="flex items-start gap-4">
                        <div class="cert-badge bg-gradient-to-br from-yellow-500/20 to-amber-600/20 text-yellow-400">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-base font-bold text-slate-100 mb-1">SQL for Data Science</h4>
                            <p class="text-indigo-400 text-sm font-medium mb-2">Great Learning Academy</p>
                            <p class="text-xs text-slate-500 flex items-center gap-1 mb-3">
                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                2024
                            </p>
                            <p class="text-sm text-slate-400 leading-relaxed mb-4">
                                Completed professional course on SQL for Data Science covering database queries, data manipulation, and foundational data analysis.
                            </p>
                            <a href="{{ asset('docs/sql-data-science.pdf') }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-full bg-yellow-500/10 text-yellow-500 hover:bg-yellow-500/20 transition-colors">
                                <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                                View Certificate
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cert 3 --}}
            <div class="reveal">
                <div class="glass-card p-6 h-full">
                    <div class="flex items-start gap-4">
                        <div class="cert-badge bg-gradient-to-br from-emerald-500/20 to-teal-600/20 text-emerald-400">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-base font-bold text-slate-100 mb-1">Data Engineering Professional</h4>
                            <p class="text-indigo-400 text-sm font-medium mb-2">Certification</p>
                            <p class="text-xs text-slate-500 flex items-center gap-1 mb-3">
                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                2024
                            </p>
                            <p class="text-sm text-slate-400 leading-relaxed mb-4">
                                Data Engineering Professional Certification course encompassing data processing, modeling, and pipelines.
                            </p>
                            <a href="{{ asset('docs/data-engineering.pdf') }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 transition-colors">
                                <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                                View Certificate
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cert 4 --}}
            <div class="reveal">
                <div class="glass-card p-6 h-full">
                    <div class="flex items-start gap-4">
                        <div class="cert-badge bg-gradient-to-br from-purple-500/20 to-violet-600/20 text-purple-400">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-base font-bold text-slate-100 mb-1">English Proficiency (TOEFL)</h4>
                            <p class="text-indigo-400 text-sm font-medium mb-2">Test Score</p>
                            <p class="text-xs text-slate-500 flex items-center gap-1 mb-3">
                                <i data-lucide="calendar" class="w-3 h-3"></i>
                                2026
                            </p>
                            <p class="text-sm text-slate-400 leading-relaxed mb-4">
                                TOEFL ITP English proficiency evaluation demonstrating ability to comprehend and communicate effectively in English.
                            </p>
                            <a href="{{ asset('docs/toefl.pdf') }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-semibold px-3 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 transition-colors">
                                <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                                View Certificate
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
