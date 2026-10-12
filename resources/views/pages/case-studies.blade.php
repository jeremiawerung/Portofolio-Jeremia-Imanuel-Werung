@extends('layouts.portal')

@section('title', 'Case Studies')
@section('page', 'case-studies')
@section('description', 'QA case studies by Jeremia Imanuel Werung: requirements analysis, manual testing, bug reports, and Playwright automation.')

@section('content')
    <x-page-header title="Case Studies" lead="How I tested two real projects, from reading the requirements to writing manual test cases and Playwright scripts." />

    @include('pages.partials.case-studies')
@endsection
