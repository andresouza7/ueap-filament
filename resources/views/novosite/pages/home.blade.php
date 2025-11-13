@extends('novosite.template.master')

@section('title', 'Notícias')

@section('content')
    <div class="flex flex-col">
        @include('novosite.partials.menu-topo')

        <!-- SEÇÃO 1: Destaques -->
        <section class="w-full relative py-12 overflow-hidden bg-gradient-to-t from-gray-100 to-white">
            <!-- Conteúdo principal -->
            <div class="relative z-10 max-w-[1290px] mx-auto">
                @include('novosite.partials.featured-news')
            </div>
        </section>

        <!-- SEÇÃO 2: Acesso Rápido -->
        <section class="w-full relative -mt-15">
            <div class="max-w-[1290px] mx-auto">
                @include('novosite.partials.acesso-rapido')
            </div>
        </section>

        <!-- SEÇÃO 3: Últimas Notícias -->
        <section class="w-full text-[#1b1b1b] py-14">
            <div class="max-w-[1290px] mx-auto">
                @include('novosite.partials.latest-news')
            </div>
        </section>
    </div>
@endsection
