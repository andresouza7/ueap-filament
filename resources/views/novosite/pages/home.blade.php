@extends('novosite.template.master')

@section('title', 'Notícias')

@section('content')
    <div class="flex flex-col">


        @include('novosite.components.hero')
        @include('novosite.components.quick-links')
        @include('novosite.components.news')
        @include('novosite.components.courses')
        @include('novosite.components.videos')
    </div>
@endsection
