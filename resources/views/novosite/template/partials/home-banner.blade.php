{{-- Hero Section with Background Image --}}
<div class="w-full relative min-h-[500px] py-4 lg:py-16 bg-cover bg-center"
    style="background-image: url('{{ asset('img/home-bg.jpg') }}');">
    <div class="absolute inset-0 bg-black opacity-60"></div> {{-- Overlay for better readability --}}
    <div class="lg:container mx-auto w-full lg:py-8 relative z-10">
        <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4">
            <!-- Carousel -->
            <div id="controls-carousel" class="relative col-span-1 lg:col-span-2" data-carousel="slide"
                data-carousel-interval="5000">
                <div class="relative h-[200px] md:h-[400px] lg:h-[500px] overflow-hidden rounded-sm">
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
            <div class="col-span-1 bg-black/50 p-4 xl:p-3 rounded-sm w-full"> <!-- Dark overlay background -->
                {{-- Destaques Heading --}}
                <h2 class="text-base lg:text-xl font-thin text-white mb-2">Últimas Notícias</h2>
                <div class="w-full h-px bg-white/50 mb-4"></div> {{-- White Divider --}}
                <div class="grid grid-rows-2 gap-2 sm:grid-rows-none"> <!-- Show only 2 rows on small screens -->
                    @foreach ($posts as $index => $post)
                        <div
                            class="relative overflow-hidden rounded-sm  block {{ $index >= 2 ? 'hidden lg:block' : '' }}">
                            <div class="w-full flex items-center gap-2 group">
                                <!-- Thumbnail Image -->
                                <img src="{{ $post->image_url }}" class="h-16 w-20 object-contain rounded-sm group-hover:scale-105 transition-transform duration-300" />

                                <!-- Text Content -->
                                <div class="flex-1 text-justify hover:underline">
                                    <a href="{{ route('novosite.post.show', $post->slug) }}"
                                        class="text-sm font-semibold text-gray-100 line-clamp-2">
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
