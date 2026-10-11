@extends('layouts.portal')

@section('title', 'Projects')
@section('page', 'projects')
@section('description', 'Projects by Jeremia Imanuel Werung — production web apps, an RFID attendance system, and QA work.')

@section('content')
    <x-page-header title="Projects" lead="A showcase of my work — from web applications running in production to quality assurance projects." />

    @include('pages.partials.projects')

    <div class="mt-10 glass-card p-6 flex flex-col sm:flex-row sm:items-center gap-4">
        <div class="flex-1">
            <h2 class="font-semibold text-slate-100">Want the testing details?</h2>
            <p class="mt-1 text-sm text-slate-400">See how I planned, executed, and automated the tests in my QA case studies.</p>
        </div>
        <a href="{{ route('case-studies') }}" class="btn-outline shrink-0">
            Read Case Studies <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>
@endsection
