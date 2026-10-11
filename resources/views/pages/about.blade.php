@extends('layouts.portal')

@section('title', 'About')
@section('page', 'about')
@section('description', 'About Jeremia Imanuel Werung — background, work experience, and education.')

@section('content')
    <x-page-header title="About" lead="A short story about who I am, where I've worked, and what I studied." />

    @include('pages.partials.about-intro')

    <hr class="page-divider">

    <section>
        <x-section-heading icon="briefcase" title="Career" lead="My professional experience and contributions." />
        @include('pages.partials.experience')
    </section>

    <hr class="page-divider">

    <section>
        <x-section-heading icon="graduation-cap" title="Education" lead="My academic background." />
        @include('pages.partials.education')
    </section>
@endsection
