@extends('novosite.template.master')

@section('title', 'Notícias')

@section('content')
    <!-- SEÇÃO 1: Destaques -->
    <section class="w-full  text-white py-14">
        <div class="max-w-[1290px] mx-auto px-2">
            @include('novosite.partials.featured-news')
        </div>
    </section>

    <!-- SEÇÃO 2: Últimas Notícias -->
    <section class="w-full bg-[#f6f7f8] text-[#1b1b1b] py-14">
        <div class="max-w-[1290px] mx-auto px-2">
            @include('novosite.partials.latest-news')
        </div>
    </section>
@endsection
