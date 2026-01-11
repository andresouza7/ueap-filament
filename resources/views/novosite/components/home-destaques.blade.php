<div class="w-full bg-[#017D49] bg-cover bg-center relative overflow-hidden"
    style="background-image: url('/img/site/hero-bg.svg');">

    <section class="w-full relative z-30">
        <div x-data="{
            active: 0,
            scrollTo(index) {
                const container = this.$refs.container;
                const width = container.offsetWidth;
                container.scrollTo({ left: width * index, behavior: 'smooth' });
                this.active = index;
            },
            handleScroll() {
                const container = this.$refs.container;
                if (window.innerWidth < 1024) {
                    this.active = Math.round(container.scrollLeft / container.offsetWidth);
                }
            }
        }" class="relative w-full">

            <div class="w-full lg:max-w-ueap lg:mx-auto lg:mt-12 lg:mb-12 lg:px-8">

                <div class="relative overflow-hidden lg:overflow-visible">
                    {{-- Container de Scroll --}}
                    <div x-ref="container" @scroll.debounce.50ms="handleScroll"
                        class="flex lg:grid lg:grid-cols-12 gap-0 lg:gap-6 overflow-x-auto lg:overflow-visible snap-x snap-mandatory lg:snap-none [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

                        {{-- POST PRINCIPAL --}}
                        @if (isset($posts[0]))
                            <div class="min-w-full lg:min-w-0 snap-center lg:col-span-8 lg:row-span-2">
                                <a href="{{ route('site.post.show', $posts[0]->slug) }}"
                                    class="bg-black/30 backdrop-blur-sm overflow-hidden group h-[320px] lg:h-[520px] flex flex-col relative shadow-2xl transition-all block lg:rounded-[2rem]">
                                    <div class="absolute inset-0">
                                        <img src="{{ 'https://picsum.photos/seed/' . $posts[0]->id . '/600/450' }}"
                                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-90">
                                        <div class="absolute inset-0 bg-[#017D49]/20 mix-blend-multiply"></div>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent opacity-95">
                                        </div>
                                    </div>

                                    <div class="relative flex flex-col justify-end h-full p-6 pb-14 lg:p-10">
                                        <div class="mb-4">
                                            <span
                                                class="bg-emerald-500/90 text-white text-[9px] lg:text-[10px] font-black px-3 py-1.5 lg:px-4 lg:py-2 uppercase tracking-[0.2em] rounded-md lg:rounded-lg shadow-xl backdrop-blur-md">
                                                {{ $posts[0]->category->name ?? 'Destaque' }}
                                            </span>
                                        </div>
                                        <h2
                                            class="text-white text-xl lg:text-4xl font-bold leading-tight group-hover:text-emerald-300 transition-colors drop-shadow-2xl line-clamp-2 lg:line-clamp-none">
                                            {{ $posts[0]->title }}
                                        </h2>
                                    </div>
                                </a>
                            </div>
                        @endif

                        {{-- POSTS SECUNDÁRIOS --}}
                        @foreach ($posts->slice(1, 2) as $index => $item)
                            <div class="min-w-full lg:min-w-0 snap-center lg:col-start-9 lg:col-span-4">
                                <a href="{{ route('site.post.show', $item->slug) }}"
                                    class="h-[320px] lg:h-[248px] bg-black/30 backdrop-blur-sm overflow-hidden group flex flex-col relative shadow-xl transition-all block lg:rounded-[1.5rem] {{ $index === 0 ? 'lg:mb-6' : '' }}">
                                    <div class="absolute inset-0">
                                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/450' }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80">
                                        <div class="absolute inset-0 bg-[#017D49]/10 mix-blend-color"></div>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-95">
                                        </div>
                                    </div>

                                    <div class="relative flex flex-col justify-end h-full p-6 pb-14 lg:p-6">
                                        <span
                                            class="text-emerald-400 text-[9px] lg:text-[10px] font-black uppercase tracking-widest mb-2 block">
                                            {{ $item->category->name }}
                                        </span>
                                        <h3
                                            class="text-white text-lg font-bold leading-tight group-hover:text-emerald-300 transition-colors line-clamp-2">
                                            {{ $item->title }}
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Controles de Navegação (Dots) --}}
                    <div
                        class="absolute bottom-6 left-0 right-0 flex justify-center items-center gap-2 lg:hidden z-40 pointer-events-none">
                        @foreach ($posts->take(3) as $index => $p)
                            <button @click="scrollTo({{ $index }})"
                                class="h-1 rounded-full transition-all duration-500 pointer-events-auto"
                                :class="active === {{ $index }} ?
                                    'w-8 bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]' : 'w-2 bg-white/40'">
                            </button>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    
</div>

