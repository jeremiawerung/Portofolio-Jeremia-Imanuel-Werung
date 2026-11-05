@extends('layouts.portal')

@section('title', 'Achievements')
@section('page', 'achievements')
@section('description', 'Certifications, reference letters, and test scores earned by Jeremia Imanuel Werung.')

@section('content')
    <x-page-header title="Achievements" lead="Letters, certificates, and test scores. Each one links to the original document." />

    @include('pages.partials.certifications')
@endsection
