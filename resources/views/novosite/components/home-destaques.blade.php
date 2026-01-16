{{-- Container Pai - Destaque Cinematográfico + Cards de Imagem --}}
<div class="w-full relative overflow-hidden bg-[#001a4d]">

    {{-- Camada 01: Background SVG sutil --}}
    <div class="absolute inset-0 z-0 opacity-[0.2] pointer-events-none bg-repeat"
        style="background-image: url('/img/site/hero-bg.svg'); background-size: contain; background-position: -170%;"
        aria-hidden="true">
    </div>

    {{-- Camada 02: Gradiente de transição --}}
    <div class="hidden lg:block absolute inset-0 z-10 bg-gradient-to-b from-[#001a4d] via-transparent to-[#001a4d]/60"
        aria-hidden="true"></div>

    <section class="w-full relative z-30 py-8 lg:py-10" aria-label="Destaques Institucionais">
        <div class="w-full lg:max-w-[1440px] lg:mx-auto lg:px-12">

            {{-- items-stretch é essencial aqui --}}
            <div class="grid grid-cols-12 gap-6 items-stretch">

                {{-- COLUNA DA ESQUERDA: NOTÍCIA PRINCIPAL --}}
                @if (isset($featured[0]))
                    <article class="col-span-12 lg:col-span-8 px-4 lg:px-0 flex">
                        <a href="{{ route('site.post.show', $featured[0]->slug) }}"
                            class="relative group w-full h-[450px] lg:h-[500px] flex flex-col overflow-hidden rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] transition-all border border-white/10">

                            <div class="absolute inset-0 bg-[#001133]">
                                <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-[2.5s] opacity-90 group-hover:opacity-100">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#001133] via-[#001133]/20 to-transparent opacity-90"></div>
                            </div>

                            <div class="absolute top-8 left-8 z-20">
                                <span class="bg-[#A4ED4A] text-[#001a4d] text-[10px] font-black px-5 py-2 rounded-full uppercase tracking-widest shadow-2xl">
                                    {{ $featured[0]->category->name ?? 'Destaque' }}
                                </span>
                            </div>

                            <div class="relative mt-auto p-8 lg:p-12">
                                <h2 class="text-white text-3xl lg:text-5xl font-black leading-[0.9] tracking-tighter mb-6 group-hover:text-[#A4ED4A] transition-colors duration-500 line-clamp-2">
                                    {{ $featured[0]->title }}
                                </h2>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-white text-[#001a4d] flex items-center justify-center group-hover:bg-[#A4ED4A] transition-all transform group-hover:rotate-[-45deg]">
                                        <i class="fa-solid fa-arrow-right text-lg"></i>
                                    </div>
                                    <span class="text-white font-black text-[10px] uppercase tracking-[0.3em]">Continuar Lendo</span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endif

                {{-- COLUNA DA DIREITA: ALINHAMENTO MILIMÉTRICO --}}
                <aside class="col-span-12 lg:col-span-4 px-4 lg:px-0 flex flex-col gap-6 h-full">
                    
                    {{-- Card 01 --}}
                    @if (isset($featured[1]))
                        <a href="{{ route('site.post.show', $featured[1]->slug) }}" 
                           class="flex-1 flex flex-col relative group overflow-hidden rounded-3xl border border-white/10 shadow-xl h-0 min-h-[220px]">
                            
                            <img src="{{ $featured[1]->image_url }}" 
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]" 
                                 alt="{{ $featured[1]->title }}">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-[#001133] via-[#001133]/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                            
                            <div class="relative mt-auto p-6">
                                <span class="text-[#A4ED4A] text-[9px] font-black uppercase tracking-widest mb-1 block">
                                    {{ $featured[1]->category->name ?? 'Destaque' }}
                                </span>
                                <h4 class="text-white font-bold text-lg leading-tight group-hover:text-[#A4ED4A] transition-colors line-clamp-2">
                                    {{ $featured[1]->title }}
                                </h4>
                            </div>
                        </a>
                    @endif

                    {{-- Card 02 --}}
                    @if (isset($featured[2]))
                        <a href="{{ route('site.post.show', $featured[2]->slug) }}" 
                           class="flex-1 flex flex-col relative group overflow-hidden rounded-3xl border border-white/10 shadow-xl h-0 min-h-[220px]">
                            
                            <img src="{{ $featured[2]->image_url }}" 
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s]" 
                                 alt="{{ $featured[2]->title }}">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-[#001133] via-[#001133]/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                            
                            <div class="relative mt-auto p-6">
                                <span class="text-[#A4ED4A] text-[9px] font-black uppercase tracking-widest mb-1 block">
                                    {{ $featured[2]->category->name ?? 'Destaque' }}
                                </span>
                                <h4 class="text-white font-bold text-lg leading-tight group-hover:text-[#A4ED4A] transition-colors line-clamp-2">
                                    {{ $featured[2]->title }}
                                </h4>
                            </div>
                        </a>
                    @endif

                </aside>

            </div>
        </div>
    </section>
</div>