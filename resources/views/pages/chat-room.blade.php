@extends('layouts.portal')

@section('title', 'Chat Room')
@section('page', 'chat-room')
@section('description', 'Leave a message for Jeremia Werung or say hi to other visitors.')

@section('content')
    <x-page-header title="Chat Room" lead="Leave a message, say hi, or ask something. Messages are public, so please keep it friendly — I'll reply here when I can." />

    <section
        class="glass-card flex flex-col"
        id="chat-room"
        data-messages-url="{{ route('chat.messages') }}"
        data-delete-url="{{ url('/chat-room/messages') }}"
        data-is-admin="{{ $isAdmin ? '1' : '0' }}"
    >
        <div class="flex items-center justify-between gap-3 px-5 py-3 border-b border-slate-800">
            <p class="flex items-center gap-2 text-sm font-medium text-slate-300">
                <span class="relative flex w-2 h-2">
                    <span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-60 animate-ping"></span>
                    <span class="relative inline-flex w-2 h-2 rounded-full bg-emerald-400"></span>
                </span>
                Live
            </p>
            @if ($isAdmin)
                <span class="text-xs text-indigo-300">Logged in as {{ $adminName }} (admin)</span>
            @endif
        </div>

        <div class="chat-scroll h-[55vh] min-h-[320px] px-4 sm:px-5 py-4 space-y-4" data-chat-list aria-live="polite">
            <p class="text-center text-sm text-slate-500" data-chat-empty>Loading messages…</p>
        </div>

        <form class="border-t border-slate-800 p-4 sm:p-5 space-y-3" data-chat-form action="{{ route('chat.store') }}" method="POST" novalidate>
            @csrf
            <div class="hp-field" aria-hidden="true">
                <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
            </div>

            @unless ($isAdmin)
                <div>
                    <label for="chat-name" class="sr-only">Your name</label>
                    <input id="chat-name" name="name" type="text" maxlength="40" required autocomplete="nickname" placeholder="Your name" class="chat-input sm:max-w-xs">
                </div>
            @endunless

            <div class="flex items-end gap-2">
                <label for="chat-message" class="sr-only">Message</label>
                <textarea id="chat-message" name="message" rows="1" maxlength="500" required placeholder="Write a message…" class="chat-input resize-none max-h-40"></textarea>
                <button type="submit" class="btn-primary shrink-0 py-3" aria-label="Send message">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">Send</span>
                </button>
            </div>

            <div class="flex flex-wrap justify-between gap-2 text-xs">
                <p class="text-rose-300 min-h-[1rem]" data-chat-error role="alert"></p>
                <p class="text-slate-500"><span data-chat-count>0</span>/500 · Links aren't allowed</p>
            </div>
        </form>
    </section>

    <noscript>
        <p class="mt-4 text-sm text-amber-300">The Chat Room needs JavaScript to work.</p>
    </noscript>
@endsection
