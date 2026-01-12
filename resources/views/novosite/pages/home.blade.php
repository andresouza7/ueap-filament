@extends('novosite.template.master')

@section('title', 'Início')

@section('content')
    <div class="flex flex-col">
        @include('novosite.components.home-destaques')
        @include('novosite.components.home-acesso-rapido-alt')
        @include('novosite.components.home-noticias')
        @include('novosite.components.home-eventos')
        @include('novosite.components.home-institucional')
        @include('novosite.components.home-programas')
        {{-- @include('novosite.components.videos') --}}
    </div>
@endsection
