{{-- BARRA DE ACESSO RÁPIDO - AJUSTADA PARA FUNDO BRANCO --}}
<section class="w-full relative z-20 bg-white border-b border-gray-200">
    
    <div class="max-w-ueap mx-auto px-0 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
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
                    class="flex flex-row lg:flex-col items-center justify-start lg:justify-center group transition-all duration-300 
                       py-4 sm:py-7 px-10 lg:py-6 lg:px-4 
                       bg-transparent hover:bg-gray-50/80">

                    {{-- Ícone --}}
                    <div class="w-8 h-8 lg:w-16 lg:h-16 flex-shrink-0 flex items-center justify-center 
                            mr-4 lg:mr-0 lg:mb-4 transition-transform duration-300 group-hover:-translate-y-1">
                        <i class="fa-solid {{ $link['icon'] }} {{ $link['color'] }} text-base lg:text-2xl opacity-90 group-hover:opacity-100 group-hover:drop-shadow-[0_4px_8px_rgba(0,0,0,0.1)]"></i>
                    </div>

                    {{-- Texto: Mudado para cinza escuro (slate-700) --}}
                    <span class="flex-1 lg:flex-none text-[9px] lg:text-[10px] font-bold text-slate-700 uppercase tracking-[0.15em] 
                                 text-left lg:text-center leading-tight group-hover:text-emerald-700 transition-colors duration-200">
                        {{ $link['label'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>