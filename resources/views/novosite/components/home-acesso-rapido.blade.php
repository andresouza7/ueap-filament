{{-- BARRA DE ACESSO RÁPIDO - COM NAVEGAÇÃO MOBILE --}}
<section class="w-full relative z-20 bg-white border-b border-gray-200">
    <div class="max-w-ueap mx-auto relative z-10 lg:px-8">
        
        {{-- Setas de Navegação - Visíveis apenas no Mobile --}}
        <div class="flex items-center lg:block">
            
            {{-- Seta Esquerda --}}
            <button onclick="scrollGrid('left')" class="lg:hidden p-3 text-slate-400 active:text-emerald-600">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div id="quick-access-grid" 
                 class="flex overflow-x-auto pb-2 pt-2 gap-2 snap-x snap-mandatory hide-scroll scroll-smooth
                        lg:grid lg:grid-cols-6 lg:gap-0 lg:pb-0 lg:pt-0 lg:overflow-visible">
                
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
                        {{-- w-[calc(33.333%-8px)] garante que apareçam exatamente 3 itens no mobile --}}
                        class="flex-none w-[calc(33.333%-8px)] lg:w-auto snap-start
                               flex flex-col items-center justify-center group transition-all duration-300 
                               py-6 px-1 lg:py-6 lg:px-4 
                               bg-transparent hover:bg-gray-50/80">

                        <div class="w-10 h-10 lg:w-16 lg:h-16 flex-shrink-0 flex items-center justify-center 
                                    mb-3 lg:mb-4 transition-transform duration-300 group-hover:-translate-y-1">
                            <i class="fa-solid {{ $link['icon'] }} {{ $link['color'] }} text-lg lg:text-2xl opacity-90 group-hover:opacity-100"></i>
                        </div>

                        <span class="text-[9px] lg:text-[10px] font-bold text-slate-700 uppercase tracking-[0.15em] 
                                     text-center leading-tight group-hover:text-emerald-700 transition-colors duration-200">
                            {{ $link['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            {{-- Seta Direita --}}
            <button onclick="scrollGrid('right')" class="lg:hidden p-3 text-slate-400 active:text-emerald-600">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* Garante que o scroll suave funcione via JS */
    .scroll-smooth { scroll-behavior: smooth; }
</style>

<script>
    function scrollGrid(direction) {
        const grid = document.getElementById('quick-access-grid');
        // Calcula a largura de um "bloco" de 3 itens
        const scrollAmount = grid.clientWidth; 
        
        if (direction === 'left') {
            grid.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            grid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
</script>