{{-- ==================== ARTICLES & BLOG ==================== --}}
<div class="mb-20">
    <h3 class="text-xl font-bold text-ink mb-8 flex items-center gap-2 reveal">Articles & Blog
    </h3>
    
    {{-- Featured Article --}}
    <div class="max-w-5xl mx-auto mb-10 reveal">
        <a href="https://medium.com/@jeremia07102004/membangun-strategi-qa-dari-nol-panduan-untuk-tim-startup-6913b417f7a8" target="_blank" class="block group">
            <div class="glass-card article-card p-6 sm:p-8">
                <div class="flex flex-col lg:flex-row gap-6">
                    {{-- Article Visual --}}
                    <div class="lg:w-1/3 shrink-0">
                        <div class="w-full h-48 lg:h-full rounded-xl bg-surface-2 flex items-center justify-center min-h-[180px]">
                            <div class="text-center">
                                <i data-lucide="book-open" class="w-12 h-12 text-ink mx-auto mb-2"></i>
                                <span class="text-ink text-sm font-medium">Featured Article</span>
                            </div>
                        </div>
                    </div>
                    {{-- Article Content --}}
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <span class="tag text-xs">
                                <i data-lucide="star" class="w-3 h-3 mr-1"></i>
                                Featured
                            </span>
                            <span class="tag text-xs">
                                September 2026
                            </span>
                            <span class="tag text-xs">QA Strategy</span>
                        </div>
                        <h3 class="text-xl font-bold text-ink mb-3 group-hover:text-accent transition-colors">
                            Building a QA Strategy from Scratch: A Guide for Startup Teams
                        </h3>
                        <p class="text-sm text-ink-2 leading-relaxed mb-4">
                            How to build an effective quality assurance culture in a fast-paced startup environment? 
                            This article discusses practical steps from determining testing priorities, choosing the right tools, 
                            to integrating QA into the CI/CD pipeline without slowing down the development team's velocity.
                        </p>
                        <div class="flex items-center gap-2 text-accent text-sm font-semibold">
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
        <h4 class="text-lg font-bold text-ink mb-6 flex items-center gap-2">
            Quick Thoughts
        </h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Microblog 1 --}}
            <div class="glass-card p-6">
                <div class="microblog-card pl-6 pt-4">
                    <p class="text-sm text-ink-2 leading-relaxed mb-3">
                        Often hear "testing slows down development"? Quite the opposite. 
                        Testing integrated from the beginning of the sprint <span class="font-semibold text-ink">reduces 60% of rework</span> 
                        in the deployment phase. Quality is not a phase, it's a mindset.
                    </p>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-muted">
                            Sep 2026
                        </span>
                        <span class="tag text-xs">Agile QA</span>
                    </div>
                </div>
            </div>

            {{-- Microblog 2 --}}
            <div class="glass-card p-6">
                <div class="microblog-card pl-6 pt-4">
                    <p class="text-sm text-ink-2 leading-relaxed mb-3">
                        Just finished exploring Playwright as a Selenium alternative. 
                        Its auto-wait, built-in assertions, and trace viewer are true 
                        <span class="font-semibold text-ink">game changers</span> for debugging flaky tests. 
                        Highly recommended for new projects!
                    </p>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-muted">
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
    <h3 class="text-xl font-bold text-ink mb-8 flex items-center gap-2 reveal">Recommended Learning Resources
    </h3>

    {{-- Resources Grid --}}
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        
        {{-- Resource 1: Guru99 --}}
        <div class="reveal">
            <div class="glass-card product-card overflow-hidden h-full flex flex-col">
                {{-- Resource Visual --}}
                <div class="relative h-48 overflow-hidden">
                    <div class="w-full h-full bg-surface-2 flex items-center justify-center">
                        <div class="text-center">
                            <i data-lucide="globe" class="w-14 h-14 text-ink mx-auto mb-2"></i>
                            <span class="text-ink text-xs font-medium uppercase tracking-wider">Tutorial</span>
                        </div>
                    </div>
                    {{-- Badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-good-soft text-ink">
                            Free
                        </span>
                    </div>
                </div>
                {{-- Resource Info --}}
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-2 h-2 rounded-full bg-accent"></span>
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Guru99</span>
                    </div>
                    <h3 class="text-lg font-bold text-ink mb-2">
                        Software Testing Tutorial
                    </h3>
                    <p class="text-sm text-ink-2 leading-relaxed mb-5 flex-1">
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
                    <div class="w-full h-full bg-surface-2 flex items-center justify-center">
                        <div class="text-center">
                            <i data-lucide="award" class="w-14 h-14 text-ink mx-auto mb-2"></i>
                            <span class="text-ink text-xs font-medium uppercase tracking-wider">Course</span>
                        </div>
                    </div>
                    {{-- Badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-warn-soft text-ink">
                            Free Trial
                        </span>
                    </div>
                </div>
                {{-- Resource Info --}}
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-2 h-2 rounded-full bg-accent"></span>
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Coursera</span>
                    </div>
                    <h3 class="text-lg font-bold text-ink mb-2">
                        ISTQB Exams Prep Specialization
                    </h3>
                    <p class="text-sm text-ink-2 leading-relaxed mb-5 flex-1">
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
                    <div class="w-full h-full bg-surface-2 flex items-center justify-center">
                        <div class="text-center">
                            <i data-lucide="book-open" class="w-14 h-14 text-ink mx-auto mb-2"></i>
                            <span class="text-ink text-xs font-medium uppercase tracking-wider">E-Book</span>
                        </div>
                    </div>
                    {{-- Badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-good-soft text-ink">
                            Free E-Book
                        </span>
                    </div>
                </div>
                {{-- Resource Info --}}
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-2 h-2 rounded-full bg-good"></span>
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Katalon</span>
                    </div>
                    <h3 class="text-lg font-bold text-ink mb-2">
                        Manual to Automated Testing
                    </h3>
                    <p class="text-sm text-ink-2 leading-relaxed mb-5 flex-1">
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

{{-- ==================== AJAKAN NGOBROL ==================== --}}
<div class="mt-16 pt-8 border-t border-line reveal">
    <h3 class="text-xl font-semibold text-ink">Want to talk about testing?</h3>
    <p class="mt-2 text-sm text-ink-2 leading-relaxed max-w-xl">
        I'm happy to swap notes on test strategy, Playwright, or how you handle QA in a small team.
    </p>
    <a href="{{ route('contact') }}" class="btn-outline mt-5">Contact me</a>
</div>
