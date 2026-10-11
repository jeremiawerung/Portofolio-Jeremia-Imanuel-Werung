@extends('layouts.portal')

@section('title', 'Contact')
@section('page', 'contact')
@section('description', 'Get in touch with Jeremia Imanuel Werung via email, WhatsApp, or Instagram.')

@section('content')
    <x-page-header title="Contact" lead="Have a project in mind or want to collaborate? Feel free to reach out — I'd love to hear from you." />

    @include('pages.partials.contact')

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-5">
        <a href="{{ route('chat') }}" class="glass-card p-5 flex items-center gap-4 group">
            <div class="w-11 h-11 rounded-xl bg-indigo-500/10 flex items-center justify-center shrink-0">
                <i data-lucide="messages-square" class="w-5 h-5 text-indigo-400"></i>
            </div>
            <div>
                <p class="font-semibold text-slate-100 group-hover:text-indigo-300 transition-colors">Leave a note in the Chat Room</p>
                <p class="text-sm text-slate-400">Say hi publicly — I reply there too.</p>
            </div>
        </a>
        <a href="{{ route('smart-talk') }}" class="glass-card p-5 flex items-center gap-4 group">
            <div class="w-11 h-11 rounded-xl bg-cyan-500/10 flex items-center justify-center shrink-0">
                <i data-lucide="sparkles" class="w-5 h-5 text-cyan-400"></i>
            </div>
            <div>
                <p class="font-semibold text-slate-100 group-hover:text-indigo-300 transition-colors">Ask Smart Talk</p>
                <p class="text-sm text-slate-400">Quick answers about my work, any time.</p>
            </div>
        </a>
    </div>
@endsection
