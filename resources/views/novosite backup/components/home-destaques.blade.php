<div class="w-full relative overflow-hidden bg-slate-950">
    {{-- Camada 01: A Imagem Original de Background --}}
    <div class="absolute inset-0 z-0 opacity-40 mix-blend-luminosity bg-cover bg-center"
        style="background-image: url('/img/site/hero-bg.svg');" aria-hidden="true">
    </div>

    {{-- Camada 02: Overlay de Cor e Gradiente --}}
    <div class="absolute inset-0 z-10 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent" aria-hidden="true">
    </div>

    {{-- Camada 03: Efeito Skew --}}
    <div class="hidden lg:block absolute right-0 top-0 w-1/3 h-full bg-emerald-500/10 skew-x-[-15deg] translate-x-32 z-20 border-l border-white/5"
        aria-hidden="true">
    </div>

    <section class="w-full relative z-30" aria-label="Notícias em Destaque">
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

            <div class="w-full lg:max-w-ueap lg:mx-auto lg:py-14 lg:px-8">

                <div class="relative overflow-hidden lg:overflow-visible">
                    {{-- Container de Scroll --}}
                    <div x-ref="container" @scroll.debounce.50ms="handleScroll" role="region" aria-live="polite"
                        class="flex lg:grid lg:grid-cols-12 gap-0 lg:gap-4 overflow-x-auto lg:overflow-visible snap-x snap-mandatory lg:snap-none [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

                        {{-- POST PRINCIPAL --}}
                        @if (isset($featured[0]))
                            <article class="min-w-full lg:min-w-0 snap-center lg:col-span-8">
                                <a href="{{ route('site.post.show', $featured[0]->slug) }}"
                                    title="Ler reportagem: {{ $featured[0]->title }}"
                                    class="relative group h-[380px] lg:h-[520px] flex flex-col overflow-hidden border border-white/10 bg-slate-900/40 backdrop-blur-md">

                                    <div class="absolute inset-0">
                                        <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 opacity-80 group-hover:opacity-100">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent">
                                        </div>
                                    </div>

                                    {{-- REF_DATA: POST PRINCIPAL --}}
                                    <div class="absolute top-0 right-0 p-6 z-20">
                                        <time datetime="{{ $featured[0]->created_at->format('Y-m-d') }}"
                                            class="text-xs font-mono text-white/40 tracking-[0.2em] uppercase border-r-2 border-emerald-500 pr-3">
                                            REF_DATA: {{ $featured[0]->created_at->format('Y.m.d') }}
                                        </time>
                                    </div>

                                    <div class="relative mt-auto p-8 lg:p-12">
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="h-[2px] w-8 bg-emerald-500" aria-hidden="true"></div>
                                            <span class="text-white text-[11px] font-[1000] uppercase tracking-[0.4em]">
                                                {{ $featured[0]->category->name ?? 'DESTAQUE' }}
                                            </span>
                                        </div>
                                        <h2
                                            class="text-white text-3xl lg:text-5xl font-[1000] uppercase italic leading-[0.85] tracking-tighter group-hover:text-emerald-400 transition-colors mb-6">
                                            {{ $featured[0]->title }}
                                        </h2>
                                        <div class="flex items-center gap-4">
                                            <span
                                                class="text-[10px] font-black text-white uppercase tracking-widest border-b-2 border-emerald-500 pb-1">Ver
                                                Reportagem</span>
                                            <i class="fa-solid fa-arrow-right-long text-emerald-500 transition-transform group-hover:translate-x-3"
                                                aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endif

                        {{-- POSTS SECUNDÁRIOS (DESKTOP) --}}
                        <div class="hidden lg:flex lg:flex-col lg:col-span-4 gap-4" role="none">
                            @foreach ($featured->slice(1, 2) as $item)
                                <article class="flex-1 flex flex-col">
                                    <a href="{{ route('site.post.show', $item->slug) }}"
                                        title="Ler reportagem: {{ $item->title }}"
                                        class="flex-1 relative group overflow-hidden border border-white/10 bg-slate-900/40 backdrop-blur-md flex flex-col">

                                        <div class="absolute inset-0">
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 opacity-70 group-hover:opacity-100">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent">
                                            </div>
                                        </div>

                                        {{-- REF_DATA: SECUNDÁRIOS --}}
                                        <div class="absolute top-0 right-0 p-4 z-20">
                                            <time datetime="{{ $item->created_at->format('Y-m-d') }}"
                                                class="text-[9px] font-mono text-white/30 tracking-widest uppercase">
                                                REF_DATA: {{ $item->created_at->format('Y.m.d') }}
                                            </time>
                                        </div>

                                        <div class="relative mt-auto p-6">
                                            <span
                                                class="text-emerald-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2 block">
                                                {{ $item->category->name }}
                                            </span>
                                            <h3
                                                class="text-white text-xl font-[1000] uppercase italic leading-none tracking-tighter group-hover:text-emerald-400 transition-colors line-clamp-2">
                                                {{ $item->title }}
                                            </h3>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>

                        {{-- MOBILE ITEMS --}}
                        @foreach ($featured->slice(1, 2) as $item)
                            <article class="min-w-full lg:hidden snap-center">
                                <a href="{{ route('site.post.show', $item->slug) }}"
                                    class="h-[380px] relative group flex flex-col bg-slate-900 overflow-hidden">
                                    <div class="absolute inset-0">
                                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}"
                                            alt="{{ $item->title }}" class="w-full h-full object-cover opacity-80">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent">
                                        </div>
                                    </div>

                                    <div class="absolute top-0 right-0 p-6 z-20">
                                        <time datetime="{{ $item->created_at->format('Y-m-d') }}"
                                            class="text-[8px] font-mono text-white/40 tracking-widest uppercase">
                                            REF_DATA: {{ $item->created_at->format('Y.m.d') }}
                                        </time>
                                    </div>

                                    <div class="relative mt-auto p-8 pb-16">
                                        <span
                                            class="text-emerald-500 text-[10px] font-black uppercase tracking-[0.2em] mb-3 block">{{ $item->category->name }}</span>
                                        <h3
                                            class="text-white text-2xl font-[1000] uppercase italic leading-none tracking-tighter">
                                            {{ $item->title }}</h3>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    {{-- Controles Mobile --}}
                    <nav class="absolute bottom-6 left-0 right-0 flex justify-center items-center gap-2 lg:hidden z-40"
                        aria-label="Navegação dos destaques">
                        @foreach ($featured->take(3) as $index => $p)
                            <button @click="scrollTo({{ $index }})" class="h-1 transition-all duration-500"
                                aria-label="Ir para o slide {{ $index + 1 }}"
                                :aria-current="active === {{ $index }} ? 'true' : 'false'"
                                :class="active === {{ $index }} ? 'w-12 bg-emerald-500' : 'w-4 bg-white/20'">
                            </button>
                        @endforeach
                    </nav>
                </div>

            </div>
        </div>
    </section>
</div>
