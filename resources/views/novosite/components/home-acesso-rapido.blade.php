{{-- BARRA DE ACESSO RÁPIDO - IDENTIDADE UEAP 2026 --}}
<section class="w-full relative z-20 bg-white border-b border-slate-100 overflow-hidden" role="navigation"
    aria-label="Acesso Rápido" x-data="{
        atStart: true,
        atEnd: false,
        checkScroll() {
            const el = $refs.grid;
            this.atStart = el.scrollLeft <= 10;
            this.atEnd = el.scrollLeft + el.clientWidth >= el.scrollWidth - 10;
        },
        scrollNext() { $refs.grid.scrollBy({ left: $refs.grid.clientWidth, behavior: 'smooth' }); },
        scrollPrev() { $refs.grid.scrollBy({ left: -$refs.grid.clientWidth, behavior: 'smooth' }); }
    }" x-init="checkScroll()">

    <div class="max-w-[1440px] mx-auto relative lg:px-12">
        <div class="flex items-stretch h-32 lg:h-36">

            {{-- Botão Voltar (Mobile) --}}
            <button @click="scrollPrev()" type="button" aria-label="Ver links anteriores" :disabled="atStart"
                class="lg:hidden flex-none w-10 flex items-center justify-center transition-all duration-300 z-30 bg-white shadow-[10px_0_15px_white]"
                :class="atStart ? 'opacity-0 pointer-events-none' : 'opacity-100 text-[#0055FF]'">
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>

            {{-- Grid de Itens --}}
            <div x-ref="grid" @scroll.debounce.50ms="checkScroll()"
                class="flex-1 flex overflow-x-auto py-0 snap-x snap-mandatory hide-scroll scroll-smooth lg:flex-row lg:overflow-visible lg:justify-between">

                @php
                    $links = [
                        ['icon' => 'fa-calendar-days', 'label' => 'Calendário Acadêmico', 'url' => '/calendario-academico'],
                        ['icon' => 'fa-scale-balanced', 'label' => 'Legislação UEAP', 'url' => '/pagina/legislacao.html'],
                        ['icon' => 'fa-file-lines', 'label' => 'Instruções Normativas', 'url' => '/pagina/instrucoes_normativas.html'],
                        ['icon' => 'fa-gavel', 'label' => 'Resoluções CONSU', 'url' => '/consu/resolucoes'],
                        ['icon' => 'fa-handshake', 'label' => 'Licitações', 'url' => 'https://transparencia.ueap.edu.br/licitacoes'],
                        ['icon' => 'fa-user-tie', 'label' => 'Processos Seletivos', 'url' => '/pagina/area-processos-seletivos.html'],
                    ];
                @endphp

                @foreach ($links as $link)
                    <a href="{{ $link['url'] }}"
                        class="flex-none w-[33.333%] lg:w-auto lg:flex-1 snap-start
                               flex flex-col items-center justify-center group transition-all duration-300
                               py-4 lg:py-6 px-2 relative border-r border-slate-50 last:border-r-0">
                        
                        {{-- Indicador de Hover (Pílula superior) --}}
                        <div class="absolute top-2 inset-x-4 h-1 bg-[#A4ED4A] rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 scale-x-50 group-hover:scale-x-100" aria-hidden="true"></div>

                        {{-- Círculo do Ícone --}}
                        <div class="relative z-10 mb-3 w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center rounded-2xl bg-slate-50 group-hover:bg-[#0055FF] transition-all duration-500 group-hover:shadow-lg group-hover:shadow-blue-200">
                            <i class="fa-solid {{ $link['icon'] }} text-[#002266] group-hover:text-white text-lg lg:text-xl transition-colors"
                                aria-hidden="true"></i>
                        </div>

                        {{-- Texto --}}
                        <div class="relative z-10 text-center px-1">
                            <span class="text-[9px] lg:text-[11px] font-black text-[#002266] group-hover:text-[#0055FF] uppercase tracking-tight leading-tight block transition-colors">
                                {{ $link['label'] }}
                            </span>
                        </div>

                        {{-- Tooltip Decorativo (Desktop) --}}
                        <div class="hidden lg:block absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-[#0055FF] rounded-full opacity-0 group-hover:opacity-100 transition-all" aria-hidden="true"></div>
                    </a>
                @endforeach
            </div>

            {{-- Botão Próximo (Mobile) --}}
            <button @click="scrollNext()" type="button" aria-label="Ver próximos links" :disabled="atEnd"
                class="lg:hidden flex-none w-10 flex items-center justify-center transition-all duration-300 z-30 bg-white shadow-[-10px_0_15px_white]"
                :class="atEnd ? 'opacity-0 pointer-events-none' : 'opacity-100 text-[#0055FF]'">
                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            </button>

        </div>
    </div>
</section>

<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* Garante que os itens no mobile tenham exatamente 1/3 da largura */
    @media (max-width: 1023px) {
        [x-ref="grid"] a {
            min-width: 33.333%;
        }
    }
</style>