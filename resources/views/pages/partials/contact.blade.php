<div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-16">
    {{-- Contact Info Cards --}}
    <div class="lg:col-span-2 space-y-6 reveal">
        {{-- Email --}}
        <a href="mailto:jeremia07102004@gmail.com" class="glass-card p-5 flex items-center gap-4 group block">
            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 flex items-center justify-center shrink-0 transition-transform group-hover:scale-110">
                <i data-lucide="mail" class="w-6 h-6 text-indigo-400"></i>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-medium">Email</p>
                <p class="text-sm text-slate-200 font-medium group-hover:text-indigo-400 transition-colors">jeremia07102004@gmail.com</p>
            </div>
        </a>

        {{-- Phone --}}
        <a href="https://wa.me/62895805193249" target="_blank" class="glass-card p-5 flex items-center gap-4 group block">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center shrink-0 transition-transform group-hover:scale-110">
                <i data-lucide="phone" class="w-6 h-6 text-emerald-400"></i>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-medium">WhatsApp</p>
                <p class="text-sm text-slate-200 font-medium group-hover:text-emerald-400 transition-colors">0895805193249</p>
            </div>
        </a>

        {{-- Instagram --}}
        <a href="https://instagram.com/jeremia.werung" target="_blank" class="glass-card p-5 flex items-center gap-4 group block">
            <div class="w-12 h-12 rounded-xl bg-pink-500/10 flex items-center justify-center shrink-0 transition-transform group-hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-pink-400">
                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                </svg>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-medium">Instagram</p>
                <p class="text-sm text-slate-200 font-medium group-hover:text-pink-400 transition-colors">@jeremia.werung</p>
            </div>
        </a>

        {{-- Location --}}
        <div class="glass-card p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center shrink-0">
                <i data-lucide="map-pin" class="w-6 h-6 text-cyan-400"></i>
            </div>
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-medium">Location</p>
                <p class="text-sm text-slate-200 font-medium">Yogyakarta, Indonesia</p>
            </div>
        </div>
    </div>

    {{-- Contact Form --}}
    <div class="lg:col-span-3 reveal">
        <div class="glass-card p-6 sm:p-8">
            <h3 class="text-xl font-bold text-slate-100 mb-6 flex items-center gap-2">
                <i data-lucide="send" class="w-5 h-5 text-indigo-400"></i>
                Send Me a Message
            </h3>
            <form action="mailto:jeremia07102004@gmail.com" method="GET" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Your Name</label>
                        <input type="text" name="name" placeholder="John Doe"
                            class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-200 text-sm placeholder-slate-500 focus:ring-0 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Your Email</label>
                        <input type="email" name="email" placeholder="john@example.com"
                            class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-200 text-sm placeholder-slate-500 focus:ring-0 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Subject</label>
                    <input type="text" name="subject" placeholder="Project Collaboration"
                        class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-200 text-sm placeholder-slate-500 focus:ring-0 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Message</label>
                    <textarea name="body" rows="5" placeholder="Tell me about your project or idea..."
                        class="w-full px-4 py-3 rounded-xl bg-slate-800/50 border border-slate-700 text-slate-200 text-sm placeholder-slate-500 focus:ring-0 transition-all resize-none"></textarea>
                </div>
                <button type="submit" class="btn-primary w-full justify-center py-3.5 text-base">
                    <i data-lucide="send" class="w-5 h-5"></i>
                    Send Message
                </button>
            </form>
            <p class="text-xs text-slate-500 text-center mt-4">
                This will open your default email client. You can also reach me directly via WhatsApp.
            </p>
        </div>
    </div>
</div>
