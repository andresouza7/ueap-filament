@extends('novosite.template.main')

@section('title', 'Home')

@section('content')
    @include('novosite.partials.home-banner')
    @include('novosite.partials.home-menu')
    @include('novosite.partials.servicos')
    @include('novosite.partials.programas')
    @include('novosite.partials.stats')
    @include('novosite.partials.faq')
@endsection
