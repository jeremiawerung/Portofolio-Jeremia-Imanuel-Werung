@extends('layouts.portal')

@section('title', 'Insights')
@section('page', 'insights')
@section('description', 'Articles, quick thoughts, and curated resources on software testing and quality engineering.')

@section('content')
    <x-page-header title="Insights" lead="Notes on software testing: an article I wrote, a few quick thoughts, and resources that helped me learn." />

    @include('pages.partials.insights')
@endsection
