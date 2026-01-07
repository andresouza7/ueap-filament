@extends('novosite.template.master')

@section('title', 'Início')

@section('content')
    <div class="flex flex-col">
        @include('novosite.components.hero')
        {{-- @include('novosite.components.quick-links') --}}
        @include('novosite.components.news')
        @include('novosite.components.events')
        {{-- @include('novosite.components.courses') --}}
        {{-- @include('novosite.components.programs') --}}
        {{-- @include('novosite.components.videos') --}}
    </div>
@endsection
