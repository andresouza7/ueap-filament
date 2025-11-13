@extends('novosite.template.master')

@section('title', 'Notícias')

@section('content')
    <div class="flex flex-col">
        @include('novosite.partials.menu-topo')

        <!-- SEÇÃO 1: Destaques -->
        <section class="w-full text-white relative py-12 overflow-hidden">
            <!-- Gradiente no topo (fade rápido) -->
            <div
                class="absolute top-0 left-0 w-full h-16 bg-gradient-to-b from-black/10 via-black/5 to-transparent z-20 pointer-events-none">
            </div>

            <!-- Conteúdo principal -->
            <div class="relative z-30 max-w-[1290px] mx-auto px-2">
                @include('novosite.partials.featured-news')
            </div>


        </section>


        <!-- SEÇÃO 2: Acesso Rápido -->
        <section class="w-full relative -mt-44 bg-gradient-to-b from-slate-100 to-white pt-40 z-0">
            <div class="max-w-[1290px] mx-auto px-2">
                @include('novosite.partials.acesso-rapido')
            </div>
        </section>

        <!-- SEÇÃO 3: Últimas Notícias -->
        <section class="w-full text-[#1b1b1b] py-14">
            <div class="max-w-[1290px] mx-auto px-2">
                @include('novosite.partials.latest-news')
            </div>
        </section>
    </div>
@endsection
