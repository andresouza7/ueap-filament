<div class="w-full bg-[#017D49] bg-cover bg-center bg-no-repeat pt-10 pb-28"
     style="background-image: url('/img/site/hero-bg.svg');">

    <section class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 
                    lg:grid lg:grid-cols-5 lg:gap-6 lg:pb-0 lg:overflow-visible">

            {{-- ===================== POST 0 (DESTAQUE PRINCIPAL) ===================== --}}
            @if(isset($posts[0]))
                <a href="{{ route('novosite.post.show', $posts[0]->slug) }}"
                   class="flex-none w-[85vw] md:w-[60vw] h-[400px] lg:w-auto lg:h-[500px] 
                          lg:col-span-3 snap-center relative group overflow-hidden 
                          rounded-xl shadow-none lg:shadow-2xl lg:shadow-black/50 cursor-pointer">

                    <img src="{{ $posts[0]->image_url ?? 'https://picsum.photos/id/1057/1200/800' }}"
                         class="absolute inset-0 w-full h-full object-cover 
                                transition-transform duration-500 group-hover:scale-105">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-6 lg:p-8 w-full">
                        <span
                            class="bg-ueap-green text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wide mb-3 inline-block shadow-sm">
                            {{ $posts[0]->category->name ?? 'Notícia' }}
                        </span>

                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight drop-shadow-md">
                            {{ $posts[0]->title }}
                        </h1>

                        <div class="flex items-center text-gray-300 text-sm">
                            <span>
                                {{ \Carbon\Carbon::parse($posts[0]->created_at)->translatedFormat('d \d\e M') }}
                            </span>
                        </div>
                    </div>
                </a>
            @endif



            {{-- ===================== COLUNA DIREITA ===================== --}}
            <div class="contents lg:col-span-2 lg:flex lg:flex-col lg:gap-6">

                {{-- -------- POST 1 -------- --}}
                @if(isset($posts[1]))
                    <a href="{{ route('novosite.post.show', $posts[1]->slug) }}"
                       class="flex-none w-[85vw] md:w-[60vw] h-[400px] lg:w-auto lg:h-auto 
                              lg:flex-1 snap-center relative group overflow-hidden 
                              rounded-2xl shadow-none lg:shadow-xl lg:shadow-black/50 cursor-pointer">

                        <img src="{{ $posts[1]->image_url ?? 'https://picsum.photos/id/1056/600/400' }}"
                             class="absolute inset-0 w-full h-full object-cover 
                                    transition-transform duration-500 group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 p-6">
                            <span
                                class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded uppercase mb-2 inline-block shadow-sm">
                                {{ $posts[1]->category->name ?? 'Notícia' }}
                            </span>

                            <h2 class="text-xl lg:text-xl font-bold text-white leading-snug drop-shadow-md">
                                {{ $posts[1]->title }}
                            </h2>
                        </div>
                    </a>
                @endif



                {{-- -------- POST 2 -------- --}}
                @if(isset($posts[2]))
                    <a href="{{ route('novosite.post.show', $posts[2]->slug) }}"
                       class="flex-none w-[85vw] md:w-[60vw] h-[400px] lg:w-auto lg:h-auto 
                              lg:flex-1 snap-center relative group overflow-hidden 
                              rounded-2xl shadow-none lg:shadow-xl lg:shadow-black/50 cursor-pointer">

                        <img src="{{ $posts[2]->image_url ?? 'https://picsum.photos/id/1055/600/400' }}"
                             class="absolute inset-0 w-full h-full object-cover 
                                    transition-transform duration-500 group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 p-6">
                            <span
                                class="bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded uppercase mb-2 inline-block shadow-sm">
                                {{ $posts[2]->category->name ?? 'Notícia' }}
                            </span>

                            <h2 class="text-xl lg:text-xl font-bold text-white leading-snug drop-shadow-md">
                                {{ $posts[2]->title }}
                            </h2>
                        </div>
                    </a>
                @endif

            </div>
        </div>
    </section>
</div>
