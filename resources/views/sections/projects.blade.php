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

            {{-- Featured Project - Presensi Sekolah RFID (lebar 2 kolom) --}}
            <div class="reveal md:col-span-2">
                <div class="glass-card overflow-hidden project-card group cursor-pointer h-full lg:grid lg:grid-cols-2">
                    <div class="relative h-48 sm:h-56 lg:h-full lg:min-h-[320px] overflow-hidden">
                        <img src="{{ asset('images/imagePresensiRFID.jpg') }}" alt="RFID reader prototype for the school attendance system" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="w-full h-full bg-gradient-to-br from-sky-500 via-indigo-500 to-violet-600 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="nfc" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Presensi Sekolah RFID</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <a href="https://github.com/jeremiawerung/presensi-sekolah-demo" target="_blank" rel="noopener" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="github" class="w-3 h-3"></i>
                                        View GitHub
                                    </a>
                                    <a href="https://presensi.cetakfotojogja.my.id" target="_blank" rel="noopener" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                        Live Demo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 lg:p-8 flex flex-col justify-center">
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Product Development · 2026</span>
                            <span class="tag text-[10px] py-0.5 px-2">Featured</span>
                        </div>
                        <h3 class="text-lg lg:text-xl font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            RFID School Attendance System
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-3">
                            An offline-first attendance system for schools: students tap an RFID card at kiosk points (gate, prayer room, library) and attendance is recorded instantly. Built with Laravel 13, Filament 5, and SQLite, featuring flexible Excel import, bulk card registration, attendance &amp; prayer rules, daily/monthly reports with Excel export, automatic backups, and a portable Windows package for school PCs.
                        </p>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Also designed a custom WiFi card reader (Wemos D1 mini + RC522) whose requests are HMAC-signed per device with timestamp checks and replay protection. Covered by 244 PHPUnit tests and 24 JavaScript tests.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">Laravel &amp; Filament</span>
                            <span class="tag text-xs">IoT (ESP8266)</span>
                            <span class="tag text-xs">Automated Testing</span>
                            <span class="tag text-xs">Offline-first</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Project - Gracia Photo Website --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer h-full">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('images/imageGraciaPhoto.jpg') }}" alt="Gracia Photo website homepage" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover object-left-top transition-transform duration-500 group-hover:scale-110">
                        <div class="w-full h-full bg-gradient-to-br from-yellow-500 via-amber-600 to-stone-800 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="id-card" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Gracia Photo</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <a href="https://graciaphoto.my.id" target="_blank" rel="noopener" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                        View Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Business Website · 2026</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            Gracia Photo Company Profile
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Built and launched a 5-page company profile for Gracia Photo (ID cards, RFID stickers, and RFID attendance systems), including an interactive installation simulator where schools plan their reader points and send a summary via WhatsApp. Tested on phone, tablet, and laptop, meets WCAG AA contrast, and ships with hardened security headers and SSL.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">HTML / CSS / JS</span>
                            <span class="tag text-xs">Accessibility</span>
                            <span class="tag text-xs">Deployment</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Project - Aurora Beauty Salon --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer">
                    {{-- Project Image --}}
                    <div class="relative h-48 overflow-hidden">
                        {{-- Tempatkan foto kamu di dalam public/images/ lalu ubah source (src) di bawah ini --}}
                        {{-- Hapus <!-- dan --> pada img di bawah jika kamu ingin menggunakan gambar --}}
                         <img src="{{ asset('images/image.png') }}" alt="Project" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                        <div class="w-full h-full bg-gradient-to-br from-pink-500 via-rose-500 to-purple-600 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="scissors" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Aurora Beauty Salon</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <a href="https://www.figma.com/design/NoeYU0fwPnPtw9i77WpGkt/Aurora-Beauty-Salon-Design?node-id=0-1&t=pqOAho4UvNWyimCI-1" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="pen-tool" class="w-3 h-3"></i>
                                        View Design
                                    </a>
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
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Live in Production</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            Aurora Beauty Salon System
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Created comprehensive test cases, conducted Black Box testing on critical features (Login, Booking, Payment), and automated the booking-to-payment flow with Playwright. Still maintaining the live site: in Oct 2026 I fixed the defects reported by an external black-box QA review and resolved verification emails that were stuck in an unprocessed queue.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">Test Planning</span>
                            <span class="tag text-xs">Black Box Testing</span>
                            <span class="tag text-xs">Production Support</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Project 2 - Portfolio Website --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer">
                    <div class="relative h-48 overflow-hidden">
                         <img src="{{ asset('images/imageEstimator.png') }}" alt="Project" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-violet-500 to-cyan-500 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="cpu" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Estimator.id</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <a href="https://www.figma.com/design/mlFFt0G4wTXm3jlcCB2c17/Landing-Page--Copy-?node-id=570-43024&t=ImJ5uIRuKrp5mbZA-1" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="pen-tool" class="w-3 h-3"></i>
                                        View Design
                                    </a>
                                    <a href="https://estimator.id/" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                        View Website
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
                        <img src="{{ asset('images/imageRTHP.png') }}" alt="Project" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
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

            {{-- Project 4 - Cetak Foto Jogja --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer">
                    <div class="relative h-48 overflow-hidden">
                        <div class="w-full h-full bg-gradient-to-br from-amber-500 via-orange-500 to-rose-600 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="camera" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Cetak Foto Jogja</span>
                            </div>
                        </div>
                        <div class="project-overlay">
                            <div class="w-full">
                                <div class="flex flex-wrap justify-center gap-2">
                                    <a href="https://cetakfotojogja.my.id" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                        View Website
                                    </a>
                                    <a href="https://github.com/jeremiawerung/cetak-foto-jogja-business" target="_blank" class="btn-primary text-xs py-2 px-3">
                                        <i data-lucide="github" class="w-3 h-3"></i>
                                        View GitHub
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">Professional Experience</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            Cetak Foto Jogja — Business Platform & ID Card Verification System
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            As IT Developer &amp; Production Support, built and maintained Cetak Foto Jogja's public reservation website (photo printing &amp; photographer rental) with automated WhatsApp notifications and Airtable logging, plus an internal ID Card Data Verification system with dynamic per-institution field schemas, automated Google Sheets sync, and fuzzy-match conflict resolution. Reconciled student biodata and performed final QA before printing — live in production across 3 institutions and 600+ records.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">Laravel & MySQL</span>
                            <span class="tag text-xs">Google Sheets API</span>
                            <span class="tag text-xs">Production QA</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Project - Hermes AI Agent (private, tanpa link) --}}
            <div class="reveal">
                <div class="glass-card overflow-hidden project-card group cursor-pointer h-full">
                    <div class="relative h-48 overflow-hidden">
                        <div class="w-full h-full bg-gradient-to-br from-violet-600 via-fuchsia-600 to-indigo-700 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="bot" class="w-12 h-12 text-white/80 mx-auto mb-2"></i>
                                <span class="text-white/80 text-sm font-medium">Hermes AI Agent</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-2 h-2 rounded-full bg-violet-400"></span>
                            <span class="text-xs text-slate-500 uppercase tracking-wider font-medium">AI Tooling · 2026</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-100 mb-2 group-hover:text-indigo-400 transition-colors">
                            Personal AI Agent &amp; Knowledge Vault
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed mb-4">
                            Set up a self-hosted AI agent (Hermes) on Windows running NVIDIA NIM models with a fallback model, connected through MCP to the filesystem and GitHub. Built an Obsidian knowledge vault, auto-synced to a private GitHub repo, that stores project context and explicit approval rules so AI assistants can pick up work across sessions safely.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="tag text-xs">AI Agents</span>
                            <span class="tag text-xs">MCP</span>
                            <span class="tag text-xs">Knowledge Management</span>
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
