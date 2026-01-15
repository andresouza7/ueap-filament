{{-- Container Pai com a nova cor de background harmonizada --}}
<div class="w-full relative overflow-hidden bg-[#002a1d]"> 
    {{-- Camada 01: Background SVG ajustado para não "sumir" --}}
    <div class="absolute inset-0 z-0 opacity-[0.4] pointer-events-none bg-repeat"
        style="background-image: url('/img/site/hero-bg.svg'); background-size: contain; background-position: center;"
        aria-hidden="true">
    </div>

    {{-- Camada 02: Gradiente de transição suave (Apenas Desktop) --}}
    <div class="hidden lg:block absolute inset-0 z-10 bg-gradient-to-b from-[#002a1d] via-transparent to-[#002a1d]/50"
        aria-hidden="true"></div>

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

            <div class="w-full lg:max-w-[1440px] lg:mx-auto lg:py-12 lg:px-12">

                <div class="relative overflow-hidden lg:overflow-visible">
                    {{-- Container de Scroll --}}
                    <div x-ref="container" @scroll.debounce.50ms="handleScroll" role="region" aria-live="polite"
                        class="flex lg:grid lg:grid-cols-12 gap-0 lg:gap-6 overflow-x-auto lg:overflow-visible snap-x snap-mandatory lg:snap-none [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden">

                        {{-- POST PRINCIPAL --}}
                        @if (isset($featured[0]))
                            <article class="min-w-full lg:min-w-0 snap-center lg:col-span-8">
                                <a href="{{ route('site.post.show', $featured[0]->slug) }}"
                                    title="Ler reportagem: {{ $featured[0]->title }}"
                                    class="relative group h-[450px] lg:h-[580px] flex flex-col overflow-hidden rounded-none lg:rounded-[40px] shadow-2xl transition-all">

                                    <div class="absolute inset-0 bg-[#001a12]"> {{-- Fundo interno do card para evitar flickering --}}
                                        <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000 opacity-90 group-hover:opacity-100">
                                        
                                        {{-- Overlay Gradiente (ajustado para o novo tom) --}}
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#001a12] via-[#001a12]/40 to-transparent"></div>
                                    </div>

                                    {{-- Data e Categoria --}}
                                    <div class="absolute top-0 left-0 p-6 lg:p-10 z-20 flex flex-col gap-2">
                                        <span class="bg-[#A4ED4A] text-[#002266] text-[10px] lg:text-[11px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest w-fit">
                                            {{ $featured[0]->category->name ?? 'Destaque' }}
                                        </span>
                                    </div>

                                    <div class="relative mt-auto p-8 lg:p-12">
                                        <time datetime="{{ $featured[0]->created_at->format('Y-m-d') }}"
                                            class="text-emerald-200/50 text-[10px] font-bold uppercase tracking-[0.2em] block mb-4">
                                            Publicado em {{ $featured[0]->created_at->format('d \d\e M, Y') }}
                                        </time>

                                        <h2 class="text-white text-3xl lg:text-5xl font-black leading-[1.1] tracking-tighter mb-6 group-hover:text-[#A4ED4A] transition-colors">
                                            {{ $featured[0]->title }}
                                        </h2>

                                        <div class="flex items-center gap-4">
                                            <span class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-[#A4ED4A] group-hover:text-[#002266] transition-all">
                                                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                            </span>
                                            <span class="text-white font-bold text-sm uppercase tracking-widest group-hover:translate-x-2 transition-transform">
                                                Continuar lendo
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endif

                        {{-- POSTS SECUNDÁRIOS --}}
                        <div class="hidden lg:flex lg:flex-col lg:col-span-4 gap-6" role="none">
                            @foreach ($featured->slice(1, 2) as $item)
                                <article class="flex-1">
                                    <a href="{{ route('site.post.show', $item->slug) }}"
                                        class="h-full relative group overflow-hidden rounded-[30px] flex flex-col bg-[#001a12] shadow-xl border border-white/5">

                                        <div class="absolute inset-0">
                                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                                class="w-full h-full object-cover opacity-40 group-hover:scale-110 group-hover:opacity-20 transition-all duration-700">
                                            <div class="absolute inset-0 bg-gradient-to-t from-[#001a12] to-transparent"></div>
                                        </div>

                                        <div class="relative mt-auto p-8">
                                            <span class="text-[#A4ED4A] text-[10px] font-black uppercase tracking-widest mb-3 block">
                                                {{ $item->category->name }}
                                            </span>
                                            <h3 class="text-white text-xl font-black leading-tight tracking-tight group-hover:text-[#A4ED4A] transition-colors line-clamp-3">
                                                {{ $item->title }}
                                            </h3>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                        
                        {{-- (Restante do código de iterações mobile permanece o mesmo, ajustando apenas o bg-[#002266] para bg-[#001a12]) --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>