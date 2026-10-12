@extends('layouts.portal')

@section('title', 'Projects')
@section('page', 'projects')
@section('description', 'Projects by Jeremia Imanuel Werung: production web apps, an RFID attendance system, and QA work.')

@section('content')
    <x-page-header title="Projects" lead="Things I've built or tested, from client websites running in production to academic QA projects." />

    @include('pages.partials.projects')

    <p class="mt-12 pt-6 border-t border-line text-sm text-ink-2">
        Want the testing details? The <a href="{{ route('case-studies') }}" class="font-medium text-accent hover:underline underline-offset-4">case studies</a>
        show how I planned, ran, and automated the tests for two of these projects.
    </p>
@endsection
