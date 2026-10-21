<div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-14">
    {{-- Kontak langsung --}}
    <div class="lg:col-span-2 reveal">
        <dl class="divide-y divide-line border-y border-line text-sm">
            <div class="py-4">
                <dt class="text-muted">Email</dt>
                <dd><a href="mailto:jeremia07102004@gmail.com" class="font-medium text-ink hover:text-accent">jeremia07102004@gmail.com</a></dd>
            </div>
            <div class="py-4">
                <dt class="text-muted">WhatsApp</dt>
                <dd><a href="https://wa.me/62895805193249" target="_blank" rel="noopener" class="font-medium text-ink hover:text-accent">0895805193249</a></dd>
            </div>
            <div class="py-4">
                <dt class="text-muted">LinkedIn</dt>
                <dd><a href="{{ config('portfolio.owner.profiles.linkedin') }}" target="_blank" rel="noopener" class="font-medium text-ink hover:text-accent">Jeremia Imanuel Werung</a></dd>
            </div>
            <div class="py-4">
                <dt class="text-muted">Instagram</dt>
                <dd><a href="https://instagram.com/jeremia.werung" target="_blank" rel="noopener" class="font-medium text-ink hover:text-accent">@jeremia.werung</a></dd>
            </div>
            <div class="py-4">
                <dt class="text-muted">GitHub</dt>
                <dd><a href="https://github.com/jeremiawerung" target="_blank" rel="noopener" class="font-medium text-ink hover:text-accent">jeremiawerung</a></dd>
            </div>
            <div class="py-4">
                <dt class="text-muted">Based in</dt>
                <dd class="font-medium text-ink">Yogyakarta, Indonesia</dd>
            </div>
        </dl>
    </div>

    {{-- Form email --}}
    <div class="lg:col-span-3 reveal">
        <div class="glass-card p-6 sm:p-8">
            <h2 class="text-xl font-semibold text-ink">Write me an email</h2>
            <p class="mt-1 text-sm text-ink-2">This opens your email app with the message filled in.</p>
            <form action="mailto:jeremia07102004@gmail.com" method="GET" class="mt-6 space-y-4">
                <div>
                    <label for="contact-subject" class="block text-sm font-medium text-ink-2 mb-1.5">Subject</label>
                    <input id="contact-subject" type="text" name="subject" placeholder="QA role at your company" class="chat-input">
                </div>
                <div>
                    <label for="contact-body" class="block text-sm font-medium text-ink-2 mb-1.5">Message</label>
                    <textarea id="contact-body" name="body" rows="6" placeholder="Hi Jeremia, ..." class="chat-input resize-none"></textarea>
                </div>
                <button type="submit" class="btn-primary">Open email app</button>
            </form>
        </div>
    </div>
</div>
