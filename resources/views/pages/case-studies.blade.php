@extends('layouts.portal')

@section('title', 'Case Studies')
@section('page', 'case-studies')
@section('description', 'QA case studies by Jeremia Imanuel Werung — requirements analysis, manual testing, bug reports, and Playwright automation.')

@section('content')
    <x-page-header title="Case Studies" lead="In-depth analysis of testing strategies applied to real-world projects — from requirements analysis to manual testing and automation scripting." />

    @include('pages.partials.case-studies')
@endsection
