@extends('layouts.portal')

@section('title', 'Insights')
@section('page', 'insights')
@section('description', 'Articles, quick thoughts, and curated resources on software testing and quality engineering.')

@section('content')
    <x-page-header title="Insights" lead="Sharing knowledge, opinions, and curated resources from the world of software testing and quality engineering." />

    @include('pages.partials.insights')
@endsection
