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
                        <div class="hidden duration-700 ease-in-out z-12" data-carousel-item>
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
                        <div
                            class="relative overflow-hidden rounded-sm shadow-md hover:scale-105 transition-transform duration-300 sm:block {{ $index >= 2 ? 'hidden sm:block' : '' }}">
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
