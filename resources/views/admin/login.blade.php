@extends('layouts.portal')

@section('title', 'Admin Login')
@section('noindex', true)

@section('content')
    <div class="max-w-sm mx-auto pt-6">
        <x-page-header title="Admin" lead="Login to moderate the Chat Room." />

        <form method="POST" action="{{ url('/admin/login') }}" class="glass-card p-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm text-ink-2 mb-1.5">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="chat-input">
            </div>
            <div>
                <label for="password" class="block text-sm text-ink-2 mb-1.5">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="chat-input">
            </div>

            @if ($errors->any())
                <p class="text-sm text-bad" role="alert">{{ $errors->first() }}</p>
            @endif

            <button type="submit" class="btn-primary w-full justify-center">
                <i data-lucide="log-in" class="w-4 h-4"></i> Login
            </button>
        </form>
    </div>
@endsection
