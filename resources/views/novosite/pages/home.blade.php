@extends('novosite.template.master')

@section('title', 'Notícias')

@section('content')
    <div class="flex flex-col">

        <!-- SEÇÃO 1: Destaques -->
        <section class="relative w-full py-10 bg-gray-50 overflow-hidden">
            <!-- Gradiente base -->
            <div
                class="pointer-events-none absolute bottom-0 left-0 w-full h-32 
                bg-linear-to-t from-[#eff6f1] to-gray-50 z-0">
            </div>

            <!-- Conteúdo -->
            <div class="relative z-10 max-w-[1290px] mx-auto">
                @include('novosite.partials.featured-news', ['posts' => $featured])
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

        <section class="w-full text-[#1b1b1b] py-14 bg-gray-50">
            <div class="max-w-[1290px] mx-auto">
                @include('novosite.partials.events')
        </section>
    </div>

    <x-video-grid title="Vídeos em Destaque" :videos="[
        [
            'url' => 'https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4',
            'description' => 'Um teste de vídeo curto mostrando efeitos de meltdown.',
        ],
        [
            'url' => 'https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
            'description' => 'Efeitos visuais impressionantes com chamas e explosões.',
        ],
        [
            'url' => 'https://storage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
            'description' => 'Cena do clássico Big Buck Bunny, animação divertida.',
        ],
        [
            'url' => 'https://storage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
            'description' => 'Elephant’s Dream — curta surreal experimental.',
        ],
        [
            'url' => 'https://storage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
            'description' => 'Sintel — jornada emocional em busca de um dragão.',
        ],
        [
            'url' => 'https://storage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4',
            'description' => 'Tears of Steel — ficção científica com efeitos avançados.',
        ],
    ]" />

    </div>
@endsection
