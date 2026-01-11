{{-- BARRA DE ACESSO RÁPIDO - REFINADA E COMPACTA --}}
<section class="w-full relative z-20 bg-white border-b-2 lg:border-b-[3px] border-slate-200" 
         x-data="{ 
            scrollNext() { 
                const el = $refs.grid;
                el.scrollBy({ left: el.clientWidth, behavior: 'smooth' });
            },
            scrollPrev() { 
                const el = $refs.grid;
                el.scrollBy({ left: -el.clientWidth, behavior: 'smooth' });
            }
         }">
    <div class="max-w-[1440px] mx-auto relative lg:px-12">
        
        <div class="flex items-stretch">
            
            {{-- Seta Esquerda (Mobile) --}}
            <button @click="scrollPrev()" 
                class="lg:hidden flex items-center justify-center px-4 self-stretch text-slate-400 active:text-emerald-600 transition-all">
                <i class="fa-solid fa-chevron-left text-[11px]"></i>
            </button>

            {{-- Container --}}
            <div x-ref="grid" 
                 class="flex-1 flex overflow-x-auto py-0 snap-x snap-mandatory hide-scroll scroll-smooth
                        lg:flex-row lg:justify-between lg:overflow-visible">
                
                @php
                    $links = [
                        ['icon' => 'fa-calendar-days', 'label' => 'Calendário Acadêmico'],
                        ['icon' => 'fa-scale-balanced', 'label' => 'Legislação Ueap'],
                        ['icon' => 'fa-file-lines', 'label' => 'Instruções Normativas'],
                        ['icon' => 'fa-gavel', 'label' => 'Resoluções CONSU'],
                        ['icon' => 'fa-handshake', 'label' => 'Licitações'],
                        ['icon' => 'fa-user-tie', 'label' => 'Processos Seletivos'],
                    ];
                @endphp

                @foreach ($links as $link)
                    <a href="#"
                        class="flex-none w-1/3 lg:w-auto lg:flex-1 snap-start
                               flex flex-col items-center justify-center group transition-all duration-500 
                               py-5 lg:py-8 px-1 relative overflow-hidden">
                        
                        {{-- Underline com Gradiente --}}
                        <span class="absolute bottom-0 left-0 w-full h-[3px] bg-gradient-to-r from-emerald-500 to-teal-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center"></span>

                        {{-- Ícone Reduzido para Harmonia --}}
                        <div class="w-7 h-7 lg:w-9 lg:h-9 flex-shrink-0 flex items-center justify-center 
                                    mb-2.5 lg:mb-3 transition-all duration-500 group-hover:-translate-y-1">
                            <i class="fa-solid {{ $link['icon'] }} text-slate-700 group-hover:text-emerald-600 text-base lg:text-xl transition-colors"></i>
                        </div>

                        {{-- Tipografia Ajustada --}}
                        <span class="text-[9px] lg:text-[10px] font-bold text-slate-700 uppercase tracking-[0.12em] lg:tracking-[0.16em] 
                                     text-center leading-tight group-hover:text-slate-900 transition-colors duration-300
                                     max-w-[85px] lg:max-w-none mx-auto italic">
                            {{ $link['label'] }}
                        </span>
                        
                        {{-- Overlay de Fundo Sutil --}}
                        <div class="absolute inset-0 bg-slate-50/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    </a>
                @endforeach
            </div>

            {{-- Seta Direita (Mobile) --}}
            <button @click="scrollNext()" 
                class="lg:hidden flex items-center justify-center px-4 self-stretch text-slate-400 active:text-emerald-600 transition-all">
                <i class="fa-solid fa-chevron-right text-[11px]"></i>
            </button>
        </div>
    </div>
</section>

<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { 
        -ms-overflow-style: none; 
        scrollbar-width: none; 
        -webkit-overflow-scrolling: touch;
    }
</style>