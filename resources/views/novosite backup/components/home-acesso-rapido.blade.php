{{-- BARRA DE ACESSO RÁPIDO - DARK MODE COM NAVEGAÇÃO INTELIGENTE --}}
<section class="w-full relative z-20 bg-[#0f172a] border-b border-white/5 overflow-hidden" role="navigation"
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

    {{-- Numeração Lateral Decorativa (Desktop) --}}
    <div class="absolute left-0 top-0 h-full w-12 bg-black/20 border-r border-white/5 pointer-events-none hidden lg:flex flex-col items-center py-4 gap-4 opacity-40"
        aria-hidden="true">
        @for ($i = 1; $i <= 6; $i++)
            <span class="text-[7px] font-mono text-slate-500 font-bold">0{{ $i }}</span>
        @endfor
    </div>

    <div class="max-w-ueap mx-auto relative lg:pl-12 lg:pr-12">
        <div class="flex items-stretch h-32 lg:h-auto">

            {{-- Seta Esquerda Mobile --}}
            <button @click="scrollPrev()" type="button" aria-label="Ver links anteriores" :disabled="atStart"
                :class="atStart ? 'text-slate-600' : 'text-emerald-500'"
                class="lg:hidden flex-none w-10 flex items-center justify-center transition-colors duration-300 z-30">
                <i class="fa-solid fa-chevron-left text-[14px]" aria-hidden="true"></i>
            </button>

            {{-- Grid de Itens --}}
            <div x-ref="grid" @scroll.debounce.50ms="checkScroll()"
                class="flex-1 flex overflow-x-auto py-0 snap-x snap-mandatory hide-scroll scroll-smooth lg:flex-row lg:overflow-visible lg:justify-center">

                {{-- Label Vertical (Desktop) --}}
                <div class="hidden lg:flex items-center justify-center w-12 border-r border-white/5 bg-black/10 flex-none"
                    aria-hidden="true">
                    <span
                        class="rotate-180 [writing-mode:vertical-lr] text-[8px] font-black uppercase tracking-[0.5em] text-slate-500">
                        ACESSO_RÁPIDO
                    </span>
                </div>

                @php
                    $links = [
                        [
                            'icon' => 'fa-calendar-days',
                            'label' => 'Calendário Acadêmico',
                            'url' => '/calendario-academico',
                            'color' => 'text-emerald-400',
                        ],
                        [
                            'icon' => 'fa-scale-balanced',
                            'label' => 'Legislação Ueap',
                            'url' => '/pagina/legislacao.html',
                            'color' => 'text-teal-400',
                        ],
                        [
                            'icon' => 'fa-file-lines',
                            'label' => 'Instruções Normativas',
                            'url' => '/pagina/instrucoes_normativas.html',
                            'color' => 'text-emerald-400',
                        ],
                        [
                            'icon' => 'fa-gavel',
                            'label' => 'Resoluções CONSU',
                            'url' => '/consu/resolucoes',
                            'color' => 'text-teal-400',
                        ],
                        [
                            'icon' => 'fa-handshake',
                            'label' => 'Licitações',
                            'url' => 'https://transparencia.ueap.edu.br/licitacoes',
                            'color' => 'text-emerald-500',
                        ],
                        [
                            'icon' => 'fa-user-tie',
                            'label' => 'Processos Seletivos',
                            'url' => '/pagina/area-processos-seletivos.html',
                            'color' => 'text-teal-400',
                        ],
                    ];
                @endphp

                @foreach ($links as $link)
                    <a href="{{ $link['url'] }}"
                        class="flex-none w-[33.333%] lg:w-auto lg:min-w-[175px] lg:flex-1 snap-start
                               flex flex-col items-center lg:items-start justify-center lg:justify-between group transition-all duration-300
                               py-5 lg:py-7 px-2 lg:px-9 relative overflow-hidden 
                               border-none lg:border-r lg:border-white/5 last:border-r-0">

                        <div class="absolute inset-0 bg-[#020618] translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out z-0"
                            aria-hidden="true"></div>

                        <div class="hidden lg:flex relative z-10 w-full justify-end items-start mb-4"
                            aria-hidden="true">
                            <div
                                class="w-1.5 h-1.5 bg-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity shadow-[0_0_8px_#10b981]">
                            </div>
                        </div>

                        <div
                            class="relative z-10 mb-2 lg:mb-4 transition-transform duration-500 group-hover:-translate-y-1 text-center">
                            <i class="fa-solid {{ $link['icon'] }} {{ $link['color'] }} group-hover:text-white text-lg lg:text-2xl transition-colors"
                                aria-hidden="true"></i>
                        </div>

                        <div class="relative z-10 text-center lg:text-left">
                            <span
                                class="text-[8px] lg:text-[12px] font-[1000] text-slate-300 group-hover:text-white uppercase italic tracking-tighter leading-[1.1] max-w-[80px] lg:max-w-[110px] block">
                                {{ $link['label'] }}
                            </span>
                        </div>

                        <div class="hidden lg:block absolute top-0 right-0 w-2 h-2 border-t border-r border-white/10 group-hover:border-emerald-500 transition-colors"
                            aria-hidden="true"></div>
                        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left z-20 shadow-[0_0_15px_#10b981]"
                            aria-hidden="true"></div>
                    </a>
                @endforeach
            </div>

            {{-- Seta Direita Mobile --}}
            <button @click="scrollNext()" type="button" aria-label="Ver próximos links" :disabled="atEnd"
                :class="atEnd ? 'text-slate-600' : 'text-emerald-500'"
                class="lg:hidden flex-none w-10 flex items-center justify-center transition-colors duration-300 z-30">
                <i class="fa-solid fa-chevron-right text-[14px]" aria-hidden="true"></i>
            </button>

        </div>
    </div>
</section>

<style>
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }

    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
