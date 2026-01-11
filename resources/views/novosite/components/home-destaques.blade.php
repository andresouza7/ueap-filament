<div class="w-full relative overflow-hidden bg-slate-950">
    {{-- Camada 01: A Imagem Original de Background --}}
    <div class="absolute inset-0 z-0 opacity-40 mix-blend-luminosity bg-cover bg-center"
         style="background-image: url('/img/site/hero-bg.svg');">
    </div>

    {{-- Camada 02: Overlay de Cor e Gradiente --}}
    <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
    
    {{-- Camada 03: Efeito Skew (A faixa inclinada que você pediu) --}}
    <div class="hidden lg:block absolute right-0 top-0 w-1/3 h-full bg-emerald-500/10 skew-x-[-15deg] translate-x-32 z-20 border-l border-white/5"></div>

    {{-- Camada 04: Efeito Pontilhado restrito à esquerda --}}
    {{-- <div class="absolute inset-0 z-20 opacity-20" 
         style="background-image: radial-gradient(circle at 2px 2px, #fff 1px, transparent 0); 
                background-size: 32px 32px;
                mask-image: linear-gradient(to right, black 30%, transparent 70%);
                -webkit-mask-image: linear-gradient(to right, black 30%, transparent 70%);">
    </div> --}}

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

            <div class="w-full lg:max-w-ueap lg:mx-auto lg:py-12 lg:px-8">

                <div class="relative overflow-hidden lg:overflow-visible">
                    {{-- Container de Scroll --}}
                    <div x-ref="container" @scroll.debounce.50ms="handleScroll"
                        class="flex lg:grid lg:grid-cols-12 gap-0 lg:gap-4 overflow-x-auto lg:overflow-visible snap-x snap-mandatory lg:snap-none [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

                        {{-- POST PRINCIPAL --}}
                        @if (isset($posts[0]))
                            <div class="min-w-full lg:min-w-0 snap-center lg:col-span-8">
                                <a href="{{ route('site.post.show', $posts[0]->slug) }}"
                                    class="relative group h-[380px] lg:h-[520px] flex flex-col overflow-hidden border border-white/10 bg-slate-900/40 backdrop-blur-md">
                                    
                                    {{-- Image Layer --}}
                                    <div class="absolute inset-0">
                                        <img src="{{ 'https://picsum.photos/seed/' . $posts[0]->id . '/1200/800' }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 opacity-80 group-hover:opacity-100">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                                    </div>

                                    {{-- Content Layer --}}
                                    <div class="relative mt-auto p-8 lg:p-12">
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="h-[2px] w-8 bg-emerald-500"></div>
                                            <span class="text-white text-[11px] font-[1000] uppercase tracking-[0.4em]">
                                                {{ $posts[0]->category->name ?? 'DESTAQUE' }}
                                            </span>
                                        </div>
                                        <h2 class="text-white text-3xl lg:text-5xl font-[1000] uppercase italic leading-[0.85] tracking-tighter group-hover:text-emerald-400 transition-colors mb-6">
                                            {{ $posts[0]->title }}
                                        </h2>
                                        <div class="flex items-center gap-4">
                                            <span class="text-[10px] font-black text-white uppercase tracking-widest border-b-2 border-emerald-500 pb-1">Ver Reportagem</span>
                                            <i class="fa-solid fa-arrow-right-long text-emerald-500 transition-transform group-hover:translate-x-3"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        {{-- POSTS SECUNDÁRIOS --}}
                        <div class="hidden lg:flex lg:flex-col lg:col-span-4 gap-4">
                            @foreach ($posts->slice(1, 2) as $index => $item)
                                <a href="{{ route('site.post.show', $item->slug) }}"
                                    class="flex-1 relative group overflow-hidden border border-white/10 bg-slate-900/40 backdrop-blur-md flex flex-col">
                                    
                                    <div class="absolute inset-0">
                                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 opacity-70 group-hover:opacity-100">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
                                    </div>

                                    <div class="relative mt-auto p-6">
                                        <span class="text-emerald-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2 block">
                                            {{ $item->category->name }}
                                        </span>
                                        <h3 class="text-white text-xl font-[1000] uppercase italic leading-none tracking-tighter group-hover:text-emerald-400 transition-colors line-clamp-2">
                                            {{ $item->title }}
                                        </h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        {{-- Mobile Items --}}
                        @foreach ($posts->slice(1, 2) as $index => $item)
                            <div class="min-w-full lg:hidden snap-center">
                                <a href="{{ route('site.post.show', $item->slug) }}"
                                   class="h-[380px] relative group flex flex-col bg-slate-900">
                                   <div class="absolute inset-0">
                                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}"
                                            class="w-full h-full object-cover opacity-80">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
                                    </div>
                                    <div class="relative mt-auto p-8 pb-16">
                                        <span class="text-emerald-500 text-[10px] font-black uppercase tracking-[0.2em] mb-3 block">{{ $item->category->name }}</span>
                                        <h3 class="text-white text-2xl font-[1000] uppercase italic leading-none tracking-tighter">{{ $item->title }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Controles Mobile --}}
                    <div class="absolute bottom-6 left-0 right-0 flex justify-center items-center gap-2 lg:hidden z-40">
                        @foreach ($posts->take(3) as $index => $p)
                            <button @click="scrollTo({{ $index }})"
                                class="h-1 transition-all duration-500"
                                :class="active === {{ $index }} ? 'w-12 bg-emerald-500' : 'w-4 bg-white/20'">
                            </button>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>