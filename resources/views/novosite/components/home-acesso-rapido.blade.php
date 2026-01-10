{{-- BARRA DE ACESSO RÁPIDO - AJUSTADA COM QUEBRA DE LINHA --}}
<section class="w-full relative z-20 bg-white border-b border-gray-200">
    <div class="max-w-ueap mx-auto relative z-10 lg:px-8">
        
        <div class="flex items-stretch lg:block">
            
            {{-- Seta Esquerda - Área de clique total --}}
            <button onclick="scrollGrid('left')" 
                class="lg:hidden flex items-center justify-center px-3 self-stretch text-slate-400 active:bg-gray-50 active:text-emerald-600 transition-all">
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>

            <div id="quick-access-grid" 
                 class="flex-1 flex overflow-x-auto py-2 gap-1 snap-x snap-mandatory hide-scroll scroll-smooth
                        lg:grid lg:grid-cols-6 lg:gap-0 lg:py-0 lg:overflow-visible">
                
                @php
                    $links = [
                        ['icon' => 'fa-calendar-days', 'label' => 'Calendário Acadêmico', 'color' => 'text-emerald-600'],
                        ['icon' => 'fa-scale-balanced', 'label' => 'Legislação Ueap', 'color' => 'text-teal-600'],
                        ['icon' => 'fa-file-lines', 'label' => 'Instruções Normativas', 'color' => 'text-emerald-600'],
                        ['icon' => 'fa-gavel', 'label' => 'Resoluções CONSU', 'color' => 'text-teal-600'],
                        ['icon' => 'fa-handshake', 'label' => 'Licitações', 'color' => 'text-emerald-600'],
                        ['icon' => 'fa-user-tie', 'label' => 'Processos Seletivos', 'color' => 'text-teal-600'],
                    ];
                @endphp

                @foreach ($links as $link)
                    <a href="#"
                        class="flex-none w-[calc(33.333%-4px)] lg:w-auto snap-start
                               flex flex-col items-center justify-center group transition-all duration-300 
                               py-3 px-1 lg:py-6 lg:px-4 
                               bg-transparent hover:bg-gray-50/80">

                        <div class="w-8 h-8 lg:w-16 lg:h-16 flex-shrink-0 flex items-center justify-center 
                                    mb-1 lg:mb-4 transition-transform duration-300 group-hover:-translate-y-1">
                            <i class="fa-solid {{ $link['icon'] }} {{ $link['color'] }} text-base lg:text-2xl opacity-90"></i>
                        </div>

                        {{-- Texto: 'max-w-[80px]' força a quebra em Legislação Ueap no mobile --}}
                        <span class="text-[9px] lg:text-[10px] font-bold text-slate-700 uppercase tracking-[0.12em] lg:tracking-[0.15em] 
                                     text-center leading-tight group-hover:text-emerald-700 transition-colors duration-200
                                     max-w-[75px] lg:max-w-none mx-auto">
                            {{ $link['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            {{-- Seta Direita - Área de clique total --}}
            <button onclick="scrollGrid('right')" 
                class="lg:hidden flex items-center justify-center px-3 self-stretch text-slate-400 active:bg-gray-50 active:text-emerald-600 transition-all">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
</section>

<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    .scroll-smooth { scroll-behavior: smooth; }
</style>

<script>
    function scrollGrid(direction) {
        const grid = document.getElementById('quick-access-grid');
        const scrollAmount = grid.offsetWidth; 
        grid.scrollBy({ 
            left: direction === 'left' ? -scrollAmount : scrollAmount, 
            behavior: 'smooth' 
        });
    }
</script>