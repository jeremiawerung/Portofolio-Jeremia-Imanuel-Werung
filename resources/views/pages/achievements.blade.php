@extends('layouts.portal')

@section('title', 'Achievements')
@section('page', 'achievements')
@section('description', 'Certifications and licenses earned by Jeremia Imanuel Werung.')

@section('content')
    <x-page-header title="Achievements" lead="Certifications and licenses I've earned along the way. Each one links to the original certificate." />

    @include('pages.partials.certifications')
@endsection
