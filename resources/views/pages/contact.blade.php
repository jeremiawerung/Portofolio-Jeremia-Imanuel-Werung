@extends('layouts.portal')

@section('title', 'Contact')
@section('page', 'contact')
@section('description', 'Get in touch with Jeremia Imanuel Werung via email, WhatsApp, or Instagram.')

@section('content')
    <x-page-header title="Contact" lead="Hiring for a QA or web role, or need help with a Laravel project? Email or WhatsApp works best." />

    @include('pages.partials.contact')

    <p class="mt-10 text-sm text-ink-2">
        Just want to say hi? Leave a note in the <a href="{{ route('chat') }}" class="font-medium text-accent hover:underline underline-offset-4">Chat Room</a>,
        or ask <a href="{{ route('smart-talk') }}" class="font-medium text-accent hover:underline underline-offset-4">Smart Talk</a> a quick question about my work.
    </p>
@endsection
