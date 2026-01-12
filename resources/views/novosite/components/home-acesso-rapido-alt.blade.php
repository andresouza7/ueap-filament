{{-- BARRA DE ACESSO RÁPIDO - DESKTOP ORIGINAL / MOBILE 3-ITENS FULL --}}

<section class="w-full relative z-20 bg-slate-50 border-b-2 border-slate-300 overflow-hidden" x-data="{

    scrollNext() { $refs.grid.scrollBy({ left: $refs.grid.clientWidth, behavior: 'smooth' }); },

        scrollPrev() { $refs.grid.scrollBy({ left: -$refs.grid.clientWidth, behavior: 'smooth' }); }

}">



    {{-- Numeração Lateral Decorativa --}}

    <div
        class="absolute left-0 top-0 h-full w-12 bg-slate-100 border-r border-slate-200 pointer-events-none hidden lg:flex flex-col items-center py-4 gap-4 opacity-60">

        @for ($i = 1; $i <= 6; $i++)
            <span class="text-[7px] font-mono text-slate-400 font-bold">0{{ $i }}</span>
        @endfor

    </div>



    <div class="max-w-ueap mx-auto relative lg:pl-12">

        <div class="flex items-stretch h-32 lg:h-auto"> {{-- Altura menor no mobile, original no LG --}}



            {{-- Label Vertical --}}

            <div class="hidden lg:flex items-center justify-center w-10 border-r border-slate-200 bg-slate-100/50">

                <span
                    class="rotate-180 [writing-mode:vertical-lr] text-[8px] font-black uppercase tracking-[0.5em] text-slate-400">

                    SISTEMA_ACESSO

                </span>

            </div>



            {{-- Navegação Mobile --}}

            <button @click="scrollPrev()"
                class="lg:hidden px-4 text-slate-400 border-r border-slate-200 active:bg-slate-200 transition-all">

                <i class="fa-solid fa-chevron-left text-[10px]"></i>

            </button>



            {{-- Grid de Itens --}}

            <div x-ref="grid"
                class="flex-1 flex overflow-x-auto py-0 snap-x snap-mandatory hide-scroll scroll-smooth lg:flex-row lg:overflow-visible">



                @php

                    $links = [
                        [
                            'icon' => 'fa-calendar-days',

                            'label' => 'Calendário Acadêmico',

                            'id' => 'CAL-01',

                            'color' => 'text-emerald-600',
                        ],

                        [
                            'icon' => 'fa-scale-balanced',

                            'label' => 'Legislação Ueap',

                            'id' => 'LEG-02',

                            'color' => 'text-teal-600',
                        ],

                        [
                            'icon' => 'fa-file-lines',

                            'label' => 'Instruções Normativas',

                            'id' => 'NOR-03',

                            'color' => 'text-emerald-600',
                        ],

                        [
                            'icon' => 'fa-gavel',

                            'label' => 'Resoluções CONSU',

                            'id' => 'RES-04',

                            'color' => 'text-teal-600',
                        ],

                        [
                            'icon' => 'fa-handshake',

                            'label' => 'Licitações',

                            'id' => 'LIC-05',

                            'color' => 'text-emerald-600',
                        ],

                        [
                            'icon' => 'fa-user-tie',

                            'label' => 'Processos Seletivos',

                            'id' => 'SEL-06',

                            'color' => 'text-teal-600',
                        ],
                    ];

                @endphp



                @foreach ($links as $link)
                    <a href="#" {{-- w-1/3 no mobile para 3 itens cravados; lg:flex-1 volta ao original --}}
                        class="flex-none w-1/3 lg:w-auto lg:flex-1 snap-start

                               flex flex-col items-start justify-between group transition-all duration-300

                               py-6 lg:py-7 px-4 lg:px-7 relative overflow-hidden border-r border-slate-200 last:border-r-0">



                        {{-- O Efeito Hover Original (Slide-up Escuro) --}}

                        <div
                            class="absolute inset-0 bg-slate-900 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out z-0">

                        </div>



                        {{-- Metadata --}}

                        <div class="relative z-10 w-full flex justify-between items-start mb-4">

                            <span
                                class="text-[7px] font-mono text-slate-400 group-hover:text-slate-500 transition-colors uppercase tracking-tighter">

                                Entry_{{ $link['id'] }}

                            </span>

                            <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">

                                <div class="w-1 h-1 bg-emerald-500"></div>

                            </div>

                        </div>



                        {{-- Ícone --}}

                        <div class="relative z-10 mb-3 transition-transform duration-500 group-hover:-translate-y-1">

                            <i
                                class="fa-solid {{ $link['icon'] }} {{ $link['color'] }} group-hover:text-emerald-400/90 text-lg lg:text-xl transition-colors"></i>

                        </div>



                        {{-- Label --}}

                        <div class="relative z-10">

                            <h2
                                class="text-[9px] lg:text-[10px] font-[1000] text-slate-700 group-hover:text-slate-300 uppercase italic tracking-tighter leading-[1.1]

                                         text-left transition-colors duration-300 max-w-[90px] lg:max-w-none">

                                {{ $link['label'] }}

                            </h2>

                        </div>



                        {{-- Cantos Técnicos --}}

                        <div
                            class="absolute top-0 right-0 w-2 h-2 border-t border-r border-slate-200 group-hover:border-emerald-500 transition-colors">

                        </div>

                        <div
                            class="absolute bottom-0 left-0 w-full h-[2px] bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left z-20">

                        </div>

                    </a>
                @endforeach

            </div>



            <button @click="scrollNext()"
                class="lg:hidden px-4 text-slate-400 border-l border-slate-200 active:bg-slate-200 transition-all">

                <i class="fa-solid fa-chevron-right text-[10px]"></i>

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
