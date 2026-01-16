{{-- BARRA DE ACESSO RÁPIDO - SEM MARGENS E TOTALMENTE CONTIDA --}}
<section class="w-full relative z-40 py-4 px-4" role="navigation">
    {{-- max-w controlado para ficar menor que a seção anterior --}}
    <div class="max-w-[1200px] mx-auto">
        
        {{-- Container com overflow-hidden para travar tudo dentro --}}
        <div class="bg-white rounded-3xl shadow-[0_15px_40px_-15px_rgba(0,26,77,0.2)] border border-slate-100 overflow-hidden">
            
            {{-- Flex container sem wrap no desktop para manter a linha --}}
            <div class="flex flex-wrap lg:flex-nowrap w-full items-stretch">

                @php
                    $links = [
                        ['icon' => 'fa-calendar-days', 'label' => 'Calendário', 'url' => '/calendario-academico'],
                        ['icon' => 'fa-scale-balanced', 'label' => 'Legislação', 'url' => '/pagina/legislacao.html'],
                        ['icon' => 'fa-file-lines', 'label' => 'Instruções', 'url' => '/pagina/instrucoes_normativas.html'],
                        ['icon' => 'fa-gavel', 'label' => 'Resoluções', 'url' => '/consu/resolucoes'],
                        ['icon' => 'fa-handshake', 'label' => 'Licitações', 'url' => 'https://transparencia.ueap.edu.br/licitacoes'],
                        ['icon' => 'fa-user-tie', 'label' => 'Seletivos', 'url' => '/pagina/area-processos-seletivos.html'],
                    ];
                @endphp

                @foreach ($links as $link)
                    <a href="{{ $link['url'] }}"
                        class="group relative flex flex-col items-center justify-center py-5 lg:py-7 px-2 
                               flex-1 min-w-[33.33%] lg:min-w-0 lg:w-full overflow-hidden transition-all duration-300">
                        
                        {{-- Hover Background --}}
                        <div class="absolute inset-0 bg-[#001a4d] translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                        
                        {{-- Conteúdo Centralizado --}}
                        <div class="relative z-10 flex flex-col items-center w-full">
                            {{-- ÍCONE --}}
                            <div class="mb-2 transition-transform duration-300 group-hover:scale-110">
                                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 shadow-sm border border-slate-100
                                            group-hover:bg-[#A4ED4A] group-hover:border-[#A4ED4A] transition-all duration-300">
                                    <i class="fa-solid {{ $link['icon'] }} text-[#001a4d] text-sm"></i>
                                </div>
                            </div>

                            {{-- LABEL --}}
                            <span class="block w-full text-center truncate text-[8px] lg:text-[9.5px] font-black text-[#001a4d]/70 group-hover:text-white uppercase tracking-wider px-2">
                                {{ $link['label'] }}
                            </span>
                            
                            {{-- Indicador --}}
                            <div class="mt-1.5 h-[2px] w-2 bg-slate-300 rounded-full group-hover:w-6 group-hover:bg-[#A4ED4A] transition-all"></div>
                        </div>

                        {{-- Divisor Vertical --}}
                        @if(!$loop->last)
                            <div class="hidden lg:block absolute right-0 top-1/2 -translate-y-1/2 h-8 w-[1px] bg-slate-200/60 group-hover:opacity-0"></div>
                        @endif
                    </a>
                @endforeach

            </div>
        </div>
    </div>
</section>