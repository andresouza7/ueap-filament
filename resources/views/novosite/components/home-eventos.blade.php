{{-- CONTAINER UNIFICADO - UEAP STYLE --}}
<div class="bg-[#A4ED4A] relative overflow-hidden font-sans py-16 lg:py-24" role="region" aria-label="Eventos e Programação">

    {{-- ELEMENTOS VISUAIS DE FUNDO --}}
    <div aria-hidden="true" class="absolute inset-0 pointer-events-none z-0">
        {{-- Padrão de Pontos (Halftone) --}}
        <div class="absolute inset-0 opacity-10" 
             style="background-image: radial-gradient(#0055FF 1.5px, transparent 1.5px); background-size: 24px 24px;">
        </div>
        {{-- Ondas Orgânicas (Simuladas com Blur) --}}
        <div class="absolute -bottom-20 -left-20 w-[600px] h-[600px] bg-white/30 rounded-full blur-[100px]"></div>
        <div class="absolute -top-20 -right-20 w-[400px] h-[400px] bg-[#0055FF]/10 rounded-full blur-[80px]"></div>
    </div>

    {{-- SECTION 01: HEADER --}}
    <section class="relative z-10 mb-12 lg:mb-20">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">

                <div class="max-w-4xl">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="px-4 py-1 bg-[#0055FF] text-white text-[10px] font-black uppercase tracking-widest rounded-full">
                            Agenda 2026
                        </span>
                    </div>

                    <h2 class="text-5xl sm:text-7xl md:text-9xl font-black text-[#0055FF] leading-[0.85] tracking-tighter uppercase">
                        Eventos <br>
                        <span class="text-white">& Atividades</span>
                    </h2>
                </div>

                <div class="mt-4 md:mt-0">
                    <a href="{{ route('site.post.list', ['type' => 'event']) }}"
                        aria-label="Ver todos os eventos"
                        class="group inline-flex items-center justify-center px-10 py-5 bg-white text-[#0055FF] rounded-full text-sm font-black uppercase tracking-widest shadow-xl hover:bg-[#0055FF] hover:text-white transition-all transform hover:-translate-y-1">
                        Ver Agenda Completa
                        <i class="fa-solid fa-calendar-days ml-3" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 02: GRID DE CARDS ARREDONDADOS --}}
    <section class="relative z-10">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($events as $index => $event)
                    <article class="group relative aspect-[4/5] flex flex-col transition-all duration-500 bg-white rounded-[45px] shadow-xl hover:shadow-[0_20px_50px_rgba(0,85,255,0.2)] overflow-hidden">

                        <a href="{{ route('site.post.show', $event->slug) }}" class="absolute inset-0 z-30" aria-label="{{ $event->title }}"></a>

                        {{-- Imagem com Zoom no Hover --}}
                        <div class="h-1/2 overflow-hidden relative" aria-hidden="true">
                            <img src="{{ $event->image_url }}" alt=""
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-white to-transparent"></div>
                            
                            {{-- Contador Estilizado --}}
                            <div class="absolute top-6 right-6 w-10 h-10 bg-[#A4ED4A] rounded-full flex items-center justify-center border-2 border-white shadow-lg">
                                <span class="text-[#0055FF] font-black text-xs">0{{ $loop->iteration }}</span>
                            </div>
                        </div>

                        {{-- Conteúdo --}}
                        <div class="p-8 flex flex-col flex-1 relative z-20">
                            {{-- Data fake ou do evento --}}
                            <div class="flex items-center gap-2 mb-3">
                                <span class="w-2 h-2 rounded-full bg-[#A4ED4A]"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Brevemente</span>
                            </div>

                            <h3 class="text-xl md:text-2xl font-black text-[#0055FF] leading-tight uppercase tracking-tight group-hover:text-blue-700 transition-colors line-clamp-3">
                                {{ $event->title }}
                            </h3>

                            <div class="mt-auto flex items-center gap-2 group-hover:translate-x-2 transition-transform duration-300">
                                <span class="text-[10px] font-black text-[#0055FF] uppercase tracking-widest">Saiba Mais</span>
                                <div class="w-6 h-6 rounded-full bg-[#A4ED4A] flex items-center justify-center">
                                    <i class="fa-solid fa-plus text-[#0055FF] text-[10px]"></i>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Footer Estilizado --}}
            <div class="mt-20 pt-10 border-t-4 border-white/20 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-6">
                    <img src="https://www.ueap.edu.br/v7/public/images/logo_ueap_branca.png" class="h-8 opacity-80 brightness-0 invert" alt="Logo UEAP" aria-hidden="true">
                    <span class="text-[10px] font-black text-white uppercase tracking-[0.4em]">Processo Seletivo 2026</span>
                </div>
                <div class="text-[10px] font-black text-[#0055FF] bg-white px-6 py-2 rounded-full uppercase tracking-widest shadow-md">
                    Universidade do Estado do Amapá
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    /* Otimização de legibilidade para o título grande */
    h2 {
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
    }
    
    /* Suavização de scroll e transições */
    .group:hover .group-hover\:translate-x-2 {
        transform: translateX(0.5rem);
    }
</style>