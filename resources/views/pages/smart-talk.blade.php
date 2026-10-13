@extends('layouts.portal')

@section('title', 'Smart Talk')
@section('page', 'smart-talk')
@section('description', "Ask Smart Talk, an AI assistant that answers questions about Jeremia Imanuel Werung's work, skills, and projects.")

@section('content')
    <x-page-header title="Smart Talk" lead="An AI assistant that has read my portfolio. Ask about my experience, projects, or skills in English or Bahasa Indonesia." />

    @if ($enabled)
        <section class="glass-card flex flex-col" id="smart-talk" data-ask-url="{{ route('smart-talk.ask') }}">
            <div class="chat-scroll h-[55vh] min-h-[340px] px-4 sm:px-5 py-5 space-y-4" data-talk-list aria-live="polite">
                <div class="flex gap-3">
                    <div class="w-8 h-8 shrink-0 rounded-full bg-accent flex items-center justify-center">
                        <span class="text-[11px] font-semibold text-accent-ink" aria-hidden="true">AI</span>
                    </div>
                    <div class="chat-bubble from-ai">
                        <p>Hi! I'm Smart Talk 👋 I can tell you about Jeremia's projects, QA experience, skills, and how to reach him. What would you like to know?</p>
                    </div>
                </div>
            </div>

            <div class="px-4 sm:px-5 pb-3 flex flex-wrap gap-2" data-talk-suggestions>
                @foreach ([
                    'What has Jeremia built?',
                    'What QA tools does he use?',
                    'Tell me about the RFID attendance project',
                    'Apa pengalaman kerja Jeremia?',
                ] as $suggestion)
                    <button type="button" class="tag cursor-pointer" data-suggestion>{{ $suggestion }}</button>
                @endforeach
            </div>

            <form class="border-t border-line p-4 sm:p-5" data-talk-form novalidate>
                <div class="flex items-end gap-2">
                    <label for="talk-input" class="sr-only">Your question</label>
                    <textarea id="talk-input" rows="1" maxlength="1000" placeholder="Ask anything about Jeremia..." class="chat-input resize-none max-h-40"></textarea>
                    <button type="submit" class="btn-primary shrink-0 py-3" aria-label="Ask">
                        <i data-lucide="send" class="w-4 h-4"></i>
                    </button>
                </div>
                <p class="mt-2 flex flex-wrap justify-between gap-2 text-xs">
                    <span class="text-bad min-h-[1rem]" data-talk-error role="alert"></span>
                    <span class="text-muted">AI can get things wrong. For anything important, contact me directly.</span>
                </p>
            </form>
        </section>
    @else
        <section class="glass-card p-8 text-center">
            <h2 class="mt-4 text-lg font-semibold text-ink">Smart Talk is resting right now</h2>
            <p class="mt-2 text-sm text-ink-2">In the meantime, feel free to reach me directly.</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-5">
                <i data-lucide="mail" class="w-4 h-4"></i> Contact me
            </a>
            @if (app()->environment('local'))
                <p class="mt-6 text-xs text-warn">Catatan lokal: isi <code>SMART_TALK_API_KEY</code> di .env buat nyalain Smart Talk.</p>
            @endif
        </section>
    @endif
@endsection
