{{-- ===== FYI SECTION ===== --}}
<section id="fyi" class="relative py-20 lg:py-28 overflow-hidden">

    {{-- Background Decoration --}}
    <div class="bg-decoration w-[500px] h-[500px] bg-indigo-600 -left-48 top-20 absolute"></div>
    <div class="bg-decoration w-[350px] h-[350px] bg-cyan-600 -right-32 bottom-20 absolute"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="tag mb-4 inline-flex">
                <i data-lucide="lightbulb" class="w-3 h-3 mr-1.5"></i>
                FYI (For Your Insights)
            </span>
            <h2 class="section-title text-slate-100 mt-3">
                Insights & <span class="gradient-text">Resources</span>
            </h2>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                Sharing knowledge, opinions, and curated resources from the world of software testing and quality engineering
            </p>
        </div>

        {{-- ==================== ARTICLES & BLOG ==================== --}}
        <div class="mb-20">
            <h3 class="text-xl font-bold text-slate-100 mb-8 flex items-center gap-2 reveal">
                <i data-lucide="pen-line" class="w-5 h-5 text-indigo-400"></i>
                Articles & Blog
            </h3>
            
            {{-- Featured Article --}}
            <div class="max-w-5xl mx-auto mb-10 reveal">
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
                                        September 2026
                                    </span>
                                    <span class="tag text-xs">QA Strategy</span>
                                </div>
                                <h3 class="text-xl font-bold text-slate-100 mb-3 group-hover:text-indigo-400 transition-colors">
                                    Building a QA Strategy from Scratch: A Guide for Startup Teams
                                </h3>
                                <p class="text-sm text-slate-400 leading-relaxed mb-4">
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
                <h4 class="text-lg font-bold text-slate-100 mb-6 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                        <i data-lucide="message-square-quote" class="w-4 h-4 text-violet-400"></i>
                    </div>
                    Quick Thoughts
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Microblog 1 --}}
                    <div class="glass-card p-6">
                        <div class="microblog-card pl-6 pt-4">
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

        {{-- ==================== LEARNING RESOURCES ==================== --}}
        <div class="mb-12">
            <h3 class="text-xl font-bold text-slate-100 mb-8 flex items-center gap-2 reveal">
                <i data-lucide="library" class="w-5 h-5 text-cyan-400"></i>
                Recommended Learning Resources
            </h3>

            {{-- Resources Grid --}}
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{-- Resource 1: Guru99 --}}
                <div class="reveal">
                    <div class="glass-card product-card overflow-hidden h-full flex flex-col">
                        {{-- Resource Visual --}}
                        <div class="relative h-48 overflow-hidden">
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 via-indigo-500 to-cyan-600 flex items-center justify-center">
                                <div class="text-center">
                                    <i data-lucide="globe" class="w-14 h-14 text-white/80 mx-auto mb-2"></i>
                                    <span class="text-white/70 text-xs font-medium uppercase tracking-wider">Tutorial</span>
                                </div>
                            </div>
                            {{-- Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-500/90 text-white shadow-lg">
                                    Free
                                </span>
                            </div>
                        </div>
                        {{-- Resource Info --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                                <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Guru99</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-100 mb-2">
                                Software Testing Tutorial
                            </h3>
                            <p class="text-sm text-slate-400 leading-relaxed mb-5 flex-1">
                                In this comprehensive QA course, you will gain foundational skills and a deep understanding of key Software Testing concepts using real-life examples.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-5">
                                <span class="tag text-xs">Comprehensive</span>
                                <span class="tag text-xs">Fundamentals</span>
                                <span class="tag text-xs">Syllabus</span>
                            </div>
                            <a href="https://www.guru99.com/software-testing.html" target="_blank" class="product-cta justify-center w-full">
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                                Go to Tutorial
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Resource 2: Coursera ISTQB --}}
                <div class="reveal">
                    <div class="glass-card product-card overflow-hidden h-full flex flex-col">
                        {{-- Resource Visual --}}
                        <div class="relative h-48 overflow-hidden">
                            <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-blue-600 to-violet-600 flex items-center justify-center">
                                <div class="text-center">
                                    <i data-lucide="award" class="w-14 h-14 text-white/80 mx-auto mb-2"></i>
                                    <span class="text-white/70 text-xs font-medium uppercase tracking-wider">Course</span>
                                </div>
                            </div>
                            {{-- Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-500/90 text-white shadow-lg">
                                    Free Trial
                                </span>
                            </div>
                        </div>
                        {{-- Resource Info --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                                <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Coursera</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-100 mb-2">
                                ISTQB Exams Prep Specialization
                            </h3>
                            <p class="text-sm text-slate-400 leading-relaxed mb-5 flex-1">
                                Master foundational software testing techniques. Gain comprehensive knowledge of testing principles and tools to effectively identify and manage defects. By Board Infinity.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-5">
                                <span class="tag text-xs">Certification</span>
                                <span class="tag text-xs">ISTQB CTFL</span>
                                <span class="tag text-xs">Video Lectures</span>
                            </div>
                            <a href="https://www.coursera.org/specializations/istqb-ctfl-prep" target="_blank" class="product-cta justify-center w-full">
                                <i data-lucide="play-circle" class="w-4 h-4"></i>
                                View on Coursera
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Resource 3: Katalon E-Book --}}
                <div class="reveal">
                    <div class="glass-card product-card overflow-hidden h-full flex flex-col">
                        {{-- Resource Visual --}}
                        <div class="relative h-48 overflow-hidden">
                            <div class="w-full h-full bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-600 flex items-center justify-center">
                                <div class="text-center">
                                    <i data-lucide="book-open" class="w-14 h-14 text-white/80 mx-auto mb-2"></i>
                                    <span class="text-white/70 text-xs font-medium uppercase tracking-wider">E-Book</span>
                                </div>
                            </div>
                            {{-- Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-500/90 text-white shadow-lg">
                                    Free E-Book
                                </span>
                            </div>
                        </div>
                        {{-- Resource Info --}}
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Katalon</span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-100 mb-2">
                                Manual to Automated Testing
                            </h3>
                            <p class="text-sm text-slate-400 leading-relaxed mb-5 flex-1">
                                Learn the 5 essential steps to shift from manual to automated testing. This guide covers tool selection, key metrics, and strategies for effective test automation.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-5">
                                <span class="tag text-xs">Automation</span>
                                <span class="tag text-xs">Strategy</span>
                                <span class="tag text-xs">PDF</span>
                            </div>
                            <a href="https://katalon.com/ebooks/shift-from-manual-automated-testing" target="_blank" class="product-cta justify-center w-full">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                Download E-Book
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ==================== CTA BANNER ==================== --}}
        <div class="max-w-3xl mx-auto mt-16 reveal">
            <div class="glass-card p-6 sm:p-8 text-center" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(6, 182, 212, 0.08) 100%);">
                <i data-lucide="message-square" class="w-8 h-8 text-indigo-400 mx-auto mb-4"></i>
                <h3 class="text-lg font-bold text-slate-100 mb-2">
                    Want to Discuss QA or Software Testing?
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed mb-5 max-w-lg mx-auto">
                    I'm always open to discussing testing strategies, automation tools, or sharing experiences. 
                    Feel free to reach out and connect!
                </p>
                <a href="#contact" class="btn-primary">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                    Get in Touch
                </a>
            </div>
        </div>

    </div>
</section>
