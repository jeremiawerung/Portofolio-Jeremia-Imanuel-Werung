{{-- ===== PROJECTS SECTION ===== --}}
<section id="projects" class="relative py-20 lg:py-28 overflow-hidden">
    {{-- Background --}}
    <div class="bg-decoration w-[500px] h-[500px] bg-cyan-600 -right-48 bottom-20 absolute"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="tag mb-4 inline-flex">
                <i data-lucide="folder-open" class="w-3 h-3 mr-1.5"></i>
                Projects
            </span>
            <h2 class="section-title text-slate-100 mt-3">
                Featured <span class="gradient-text">Projects</span>
            </h2>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                A showcase of my work — from web applications to quality assurance projects
            </p>
        </div>

        {{-- Projects Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            {{-- Project 1 - Aurora Beauty Salon --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer">
                    {{-- Project Image --}}
                    <div class="relative h-48 overflow-hidden">
                        {{-- Tempatkan foto kamu di dalam public/images/ lalu ubah source (src) di bawah ini --}}
                        {{-- Hapus <!-- dan --> pada img di bawah jika kamu ingin menggunakan gambar --}}
                         <img src="{{ asset('images/image.png') }}" alt="Project" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                        <div class="w-full h-full bg-gradient-to-br from-pink-500 via-rose-500 to-purple-600 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="scissors" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Aurora Beauty Salon</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex gap-3">
                                    <a href="https://aurorabeautysalonktg.com/" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                        View Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Project Info --}}
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-pink-400"></span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Academic Project</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            Aurora Beauty Salon System
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Created comprehensive test cases, conducted Black Box testing on critical features (Login, Booking, Payment), and documented test validation scenarios.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">Test Planning</span>
                            <span class="tag text-xs">Black Box Testing</span>
                            <span class="tag text-xs">Documentation</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Project 2 - Portfolio Website --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer">
                    <div class="relative h-48 overflow-hidden">
                         <img src="{{ asset('images/imageEstimator.png') }}" alt="Project" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-violet-500 to-cyan-500 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="cpu" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Estimator.id</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex gap-3">
                                    <a href="https://www.figma.com/design/mlFFt0G4wTXm3jlcCB2c17/Landing-Page--Copy-?node-id=570-43024&t=ImJ5uIRuKrp5mbZA-1" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                        View Design
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Academic Project</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            Estimator.id (AI Integration)
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Conducted specific testing on AI-generated responses for material price estimation, evaluated performance monitoring AI latency, and documented validation scenarios.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">AI Accuracy</span>
                            <span class="tag text-xs">Performance Testing</span>
                            <span class="tag text-xs">Validation</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Project 3 - QA Testing --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/imageRTHP.png') }}" alt="Project" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="w-full h-full bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-600 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="map" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">RTHP System</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex gap-3">
                                    <a href="https://www.figma.com/design/CjAiulADb2mUAmiMhLD6Nw/RTHP-KOTA-YOGYAKARTA?node-id=1-2&t=HZne0Ic2mGjqKjgJ-1" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                        View Design
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Academic Project</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            RTHP System (DLH Yogyakarta)
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Executed manual testing on the Green Open Space mapping system, verified Admin Dashboard CRUD operations, and ensured data stability.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">Functional Testing</span>
                            <span class="tag text-xs">CRUD Validation</span>
                            <span class="tag text-xs">Manual Testing</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- More Coming Card --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden h-full flex items-center justify-center min-h-[380px] border-dashed border-slate-700">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 rounded-2xl bg-slate-700/50 flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="plus" class="w-8 h-8 text-slate-500"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-400 mb-2">More Coming Soon</h3>
                        <p class="text-sm text-slate-500">Currently working on exciting new projects. Stay tuned!</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
