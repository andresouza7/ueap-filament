{{-- Container principal agora em fundo claro (Gray-50 ou White) --}}
<div class="w-full relative overflow-hidden bg-gray-50 border-b border-gray-200">

    {{-- Camada 01: Background com Textura Sutil (Ajustada para fundo claro) --}}
    <div class="absolute inset-0 z-0 opacity-10 mix-blend-multiply bg-cover bg-center"
        style="background-image: url('/img/site/hero-bg.svg');" aria-hidden="true">
    </div>

    {{-- Camada 02: Overlay Suave (Transição do fundo claro para o conteúdo) --}}
    <div class="absolute inset-0 z-10 bg-gradient-to-r from-gray-50 via-gray-50/40 to-transparent" aria-hidden="true">
    </div>

    {{-- Camada 03: Efeito Skew (Agora em Azul UEAP sutil para fundo claro) --}}
    <div class="hidden lg:block absolute right-0 top-0 w-1/3 h-full bg-ueap-blue/5 skew-x-[-15deg] translate-x-32 z-20 border-l border-ueap-blue/10"
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

            <div class="w-full lg:max-w-7xl lg:mx-auto lg:py-14 lg:px-8">

                <div class="relative overflow-hidden lg:overflow-visible">
                    {{-- Container de Scroll --}}
                    <div x-ref="container" @scroll.debounce.50ms="handleScroll" role="region" aria-live="polite"
                        class="flex lg:grid lg:grid-cols-12 gap-0 lg:gap-4 overflow-x-auto lg:overflow-visible snap-x snap-mandatory lg:snap-none [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

                        {{-- POST PRINCIPAL (COLUNA 8) --}}
                        @if (isset($featured[0]))
                            <article class="min-w-full lg:min-w-0 snap-center lg:col-span-8">
                                <a href="{{ route('site.post.show', $featured[0]->slug) }}"
                                    title="Ler reportagem: {{ $featured[0]->title }}"
                                    class="relative group h-[420px] lg:h-[550px] flex flex-col overflow-hidden border border-gray-200 bg-white shadow-xl">

                                    <div class="absolute inset-0">
                                        <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000">
                                        {{-- Overlay interno do card permanece escuro para garantir leitura do texto branco --}}
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-ueap-blue-dark via-ueap-blue-dark/20 to-transparent">
                                        </div>
                                    </div>

                                    {{-- DATA: POST PRINCIPAL (Azul escuro sobre o fundo claro do container pai) --}}
                                    <div class="absolute top-0 right-0 p-6 z-20">
                                        <time datetime="{{ $featured[0]->created_at->format('Y-m-d') }}"
                                            class="text-[10px] font-mono text-white/80 tracking-[0.2em] uppercase border-r-2 border-ueap-green pr-3">
                                            {{ $featured[0]->created_at->format('d.m.Y') }}
                                        </time>
                                    </div>

                                    <div class="relative mt-auto p-8 lg:p-12">
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="h-[3px] w-10 bg-ueap-green" aria-hidden="true"></div>
                                            <span class="text-white text-[11px] font-black uppercase tracking-[0.4em]">
                                                {{ $featured[0]->category->name ?? 'DESTAQUE' }}
                                            </span>
                                        </div>
                                        <h2
                                            class="text-white text-3xl lg:text-6xl font-display font-black uppercase italic leading-[0.85] tracking-tighter group-hover:text-ueap-green transition-colors mb-8">
                                            {{ $featured[0]->title }}
                                        </h2>
                                        <div class="flex items-center gap-4">
                                            <span
                                                class="text-[10px] font-black text-white uppercase tracking-widest border-b-2 border-ueap-green pb-1 transition-all group-hover:pr-4">
                                                Ver Reportagem
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-ueap-green transition-transform group-hover:translate-x-3"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endif

                        {{-- POSTS SECUNDÁRIOS (COLUNA 4 - DESKTOP) --}}
                        <div class="hidden lg:flex lg:flex-col lg:col-span-4 gap-4" role="none">
                            @foreach ($featured->slice(1, 2) as $item)
                                <article class="flex-1 flex flex-col">
                                    <a href="{{ route('site.post.show', $item->slug) }}"
                                        title="Ler reportagem: {{ $item->title }}"
                                        class="flex-1 relative group overflow-hidden border border-gray-200 bg-white shadow-md flex flex-col">

                                        <div class="absolute inset-0">
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 opacity-90 group-hover:opacity-100">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-ueap-blue-dark/90 to-transparent">
                                            </div>
                                        </div>

                                        <div class="relative mt-auto p-6">
                                            <span
                                                class="text-ueap-green text-[10px] font-black uppercase tracking-[0.2em] mb-2 block">
                                                {{ $item->category->name }}
                                            </span>
                                            <h3
                                                class="text-white text-xl font-display font-black uppercase italic leading-none tracking-tighter group-hover:text-ueap-green transition-colors line-clamp-2">
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
                                    class="h-[420px] relative group flex flex-col bg-white overflow-hidden">
                                    <div class="absolute inset-0">
                                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                            class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-ueap-blue-dark via-ueap-blue-dark/40 to-transparent">
                                        </div>
                                    </div>

                                    <div class="relative mt-auto p-8 pb-16 text-white">
                                        <span
                                            class="text-ueap-green text-[10px] font-black uppercase tracking-[0.2em] mb-3 block">
                                            {{ $item->category->name }}
                                        </span>
                                        <h3
                                            class="text-3xl font-display font-black uppercase italic leading-none tracking-tighter">
                                            {{ $item->title }}
                                        </h3>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    {{-- Controles Mobile (Ajustados para fundo claro) --}}
                    <nav class="absolute bottom-8 left-0 right-0 flex justify-center items-center gap-2 lg:hidden z-40">
                        @foreach ($featured->take(3) as $index => $p)
                            <button @click="scrollTo({{ $index }})" class="h-1.5 transition-all duration-500"
                                :class="active === {{ $index }} ? 'w-16 bg-ueap-blue' : 'w-6 bg-ueap-blue/20'">
                            </button>
                        @endforeach
                    </nav>
                </div>

            </div>
        </div>
    </section>
</div>
