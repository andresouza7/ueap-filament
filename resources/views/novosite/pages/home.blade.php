@extends('novosite.template.main')

@section('title', 'Home')

@section('content')
    @include('novosite.template.partials.home-banner')
    @include('novosite.template.partials.home-menu')
    @include('novosite.template.partials.servicos')
    @include('novosite.template.partials.programas')
    @include('novosite.template.partials.stats')
    @include('novosite.template.partials.faq')
@endsection
