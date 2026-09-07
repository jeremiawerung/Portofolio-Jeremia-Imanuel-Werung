{{-- ===== ARTICLES / BLOG SECTION ===== --}}
<section id="articles" class="relative py-20 lg:py-28 overflow-hidden">

    {{-- Background Decoration --}}
    <div class="bg-decoration w-[450px] h-[450px] bg-indigo-600 -right-40 top-1/3 absolute"></div>
    <div class="bg-decoration w-[300px] h-[300px] bg-violet-600 -left-36 bottom-20 absolute"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="tag mb-4 inline-flex">
                <i data-lucide="pen-line" class="w-3 h-3 mr-1.5"></i>
                Articles & Blog
            </span>
            <h2 class="section-title text-slate-100 mt-3">
                Insights on <span class="gradient-text">Quality Assurance</span>
            </h2>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                Sharing knowledge, opinions, and experiences from the world of software testing and quality engineering
            </p>
        </div>

        {{-- Featured Article --}}
        <div class="max-w-5xl mx-auto mb-10 reveal">
            <!-- PLACEHOLDER: Replace with your featured article -->
            <a href="https://medium.com/@jeremia07102004/membangun-strategi-qa-dari-nol-panduan-untuk-tim-startup-6913b417f7a8" target="_blank" class="block group">
                <div class="glass-card article-card p-6 sm:p-8">
                    <div class="flex flex-col lg:flex-row gap-6">
                        {{-- Article Visual --}}
                        <div class="lg:w-1/3 shrink-0">
                            <div class="w-full h-48 lg:h-full rounded-xl bg-gradient-to-br from-indigo-500 via-violet-500 to-cyan-500 flex items-center justify-center min-h-[180px]">
                                <div class="text-center">
                                    <i data-lucide="book-open" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                    <span class="text-white/70 text-sm font-medium">Featured Article</span>
                                </div>
                            </div>
                        </div>
                        {{-- Article Content --}}
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="tag text-xs" style="background: rgba(245, 158, 11, 0.1); color: #fbbf24; border-color: rgba(245, 158, 11, 0.2);">
                                    <i data-lucide="star" class="w-3 h-3 mr-1"></i>
                                    Featured
                                </span>
                                <span class="tag text-xs">
                                    <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                    <!-- PLACEHOLDER: Article date -->
                                    September 2026
                                </span>
                                <span class="tag text-xs">QA Strategy</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-100 mb-3 group-hover:text-indigo-400 transition-colors">
                                <!-- PLACEHOLDER: Your featured article title -->
                                Building a QA Strategy from Scratch: A Guide for Startup Teams
                            </h3>
                            <p class="text-sm text-slate-400 leading-relaxed mb-4">
                                <!-- PLACEHOLDER: Article summary -->
                                How to build an effective quality assurance culture in a fast-paced startup environment? 
                                This article discusses practical steps from determining testing priorities, choosing the right tools, 
                                to integrating QA into the CI/CD pipeline — without slowing down the development team's velocity.
                            </p>
                            <div class="flex items-center gap-2 text-indigo-400 text-sm font-semibold">
                                Read Full Article
                                <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Microblog Section --}}
        <div class="max-w-5xl mx-auto reveal">
            <h3 class="text-lg font-bold text-slate-100 mb-6 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                    <i data-lucide="message-square-quote" class="w-4 h-4 text-violet-400"></i>
                </div>
                Quick Thoughts
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Microblog 1 --}}
                <div class="glass-card p-6">
                    <div class="microblog-card pl-6 pt-4">
                        <!-- PLACEHOLDER: Replace with your quick thoughts -->
                        <p class="text-sm text-slate-300 leading-relaxed mb-3">
                            Often hear "testing slows down development"? Quite the opposite. 
                            Testing integrated from the beginning of the sprint <span class="text-indigo-400 font-medium">reduces 60% of rework</span> 
                            in the deployment phase. Quality is not a phase, it's a mindset.
                        </p>
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-slate-500">
                                <i data-lucide="calendar" class="w-3 h-3 inline mr-1"></i>
                                Sep 2026
                            </span>
                            <span class="tag text-xs">Agile QA</span>
                        </div>
                    </div>
                </div>

                {{-- Microblog 2 --}}
                <div class="glass-card p-6">
                    <div class="microblog-card pl-6 pt-4">
                        <!-- PLACEHOLDER: Replace with your quick thoughts -->
                        <p class="text-sm text-slate-300 leading-relaxed mb-3">
                            Just finished exploring Playwright as a Selenium alternative. 
                            Its auto-wait, built-in assertions, and trace viewer are true 
                            <span class="text-cyan-400 font-medium">game changers</span> for debugging flaky tests. 
                            Highly recommended for new projects!
                        </p>
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-slate-500">
                                <i data-lucide="calendar" class="w-3 h-3 inline mr-1"></i>
                                Aug 2026
                            </span>
                            <span class="tag text-xs">Tools Review</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
