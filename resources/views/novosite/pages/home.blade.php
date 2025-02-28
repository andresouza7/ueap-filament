@extends('novosite.template.main')

@section('title', 'Home')

@section('content')
    {{-- Hero Section with Background Image --}}
    <div class="w-full relative min-h-[400px] py-4 lg:py-16 bg-cover bg-center"
        style="background-image: url('{{ asset('img/home-bg.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-60"></div> {{-- Overlay for better readability --}}
        <div class="container mx-auto w-full max-w-6xl px-4 lg:px-8 py-8 relative z-10">
            <div class="grid md:grid-cols-3 gap-4">
                <!-- Carousel -->
                <div id="controls-carousel" class="relative col-span-2" data-carousel="slide" data-carousel-interval="5000">
                    <div class="relative h-72 md:h-96 overflow-hidden rounded-sm">
                        @php
                            $banners = \App\Models\WebBanner::latest('id')->take(3)->get();
                        @endphp
                        @foreach ($banners as $banner)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <a href="{{ $banner->url }}">

                                    <img src="{{ $banner->image_url }}"
                                        class="absolute block w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                        alt="...">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
                <!-- Notícias principais -->
                <div class="col-span-2 md:col-span-1 bg-black/50 p-3 rounded-sm"> <!-- Dark overlay background -->
                    {{-- Destaques Heading --}}
                    <h2 class="text-xl font-thin text-white mb-2">Destaques</h2>
                    <div class="w-full h-px bg-white/50 mb-4"></div> {{-- White Divider --}}
                    {{-- <div class="grid grid-cols-2 gap-4">
                        @foreach ($posts as $post)
                            <div
                                class="relative overflow-hidden rounded-sm shadow-md hover:scale-105 transition-transform duration-300">
                                <div class="w-full h-32 bg-gray-300 bg-cover bg-center"
                                    style="background-image: url('{{ $post->image_url ?? '' }}');">
                                    <div
                                        class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-3">
                                        <a href="{{ route('novosite.post.show', $post->slug) }}"
                                            class="text-xs font-semibold text-white line-clamp-2">
                                            {{ $post->title }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}

                    <div class="grid grid-rows-2 gap-2 sm:grid-rows-none"> <!-- Show only 2 rows on small screens -->
                        @foreach ($posts as $index => $post)
                            <div class="relative overflow-hidden rounded-sm shadow-md hover:scale-105 transition-transform duration-300 sm:block {{ $index >= 2 ? 'hidden sm:block' : '' }}">
                                <div class="w-full flex items-center gap-2">
                                    <!-- Thumbnail Image -->
                                    <img src="{{ $post->image_url }}" class="h-12 w-16 object-contain rounded-sm" />
                    
                                    <!-- Text Content -->
                                    <div class="flex-1 text-justify hover:underline">
                                        <a href="{{ route('novosite.post.show', $post->slug) }}"
                                            class="text-xs font-semibold text-gray-100 line-clamp-2">
                                            {{ $post->title }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Botão "Saiba Mais" -->
                    <a href="{{ route('novosite.post.list') }}"
                        class="inline-flex items-center text-gray-100 hover:text-gray-300 mt-3 font-medium text-sm transition-colors duration-200">
                        Ver Mais
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>


            </div>
        </div>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Payments tool for software companies</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">From
                    checkout to global sales tax compliance, companies around the world use Flowbite to simplify their
                    payment stack.</p>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Get started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Speak to Sales
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
            </div>
        </div>
    </section>

    <!-- Próximos Eventos -->
    <div class="container mx-auto w-full max-w-screen-xl px-4 lg:px-8 py-16">
        <!-- Título da Seção -->
        <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">Eventos</h2>

        <!-- Grid de Eventos -->
        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($events as $event)
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <!-- Imagem do Evento (opcional) -->
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        <img src="{{ $event->image_url ?? 'https://placehold.co/400x200' }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Conteúdo do Evento -->
                    <div class="p-4">
                        <!-- Título do Evento -->
                        <h3 class="text-base font-semibold text-gray-900 mb-2">{{ substr($event->title, 0, 80) . '...' }}
                        </h3>

                        <!-- Botão "Saiba Mais" -->
                        <a href="{{ route('novosite.post.show', $event->slug) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                            Saiba mais
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botão "Ver Todos os Eventos" (opcional) -->
        <div class="text-center mt-12">
            <a href="{{ route('novosite.post.list') }}"
                class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Ver Todos os Eventos
            </a>
        </div>
    </div>
@endsection
