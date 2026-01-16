{{-- BARRA DE ACESSO RÁPIDO - ULTRA PREMIUM (HERO MATCH) --}}
<section class="w-full relative z-40 -mt-10 lg:-mt-14 px-4 lg:px-12" role="navigation">
    <div class="max-w-[1440px] mx-auto">
        
        {{-- Container com borda de vidro e sombra profunda --}}
        <div class="bg-white rounded-[35px] lg:rounded-[50px] shadow-[0_30px_70px_-15px_rgba(0,26,77,0.4)] overflow-hidden border border-white p-2">
            
            <div class="grid grid-cols-3 lg:flex lg:flex-row items-stretch bg-slate-50/50 rounded-[30px] lg:rounded-[42px]">

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
                        class="group relative flex flex-col items-center justify-center py-8 lg:py-12 px-4 transition-all duration-500
                               lg:flex-1 overflow-hidden first:rounded-l-[30px] last:rounded-r-[30px]">
                        
                        {{-- Background Hover: Azul Profundo igual ao Hero --}}
                        <div class="absolute inset-0 bg-[#001a4d] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        {{-- Círculo de Luz (Glow) atrás do ícone no hover --}}
                        <div class="absolute w-24 h-24 bg-[#A4ED4A]/10 rounded-full blur-2xl -translate-y-12 group-hover:translate-y-0 transition-transform duration-700"></div>

                        {{-- ÍCONE: Estilo Badge de App --}}
                        <div class="relative z-10 mb-4 transition-all duration-500 group-hover:-translate-y-2">
                            <div class="w-14 h-14 lg:w-16 lg:h-16 flex items-center justify-center rounded-[22px] bg-white shadow-sm border border-slate-100
                                        group-hover:bg-[#A4ED4A] group-hover:border-[#A4ED4A] group-hover:rotate-[10deg]
                                        transition-all duration-500">
                                
                                <i class="fa-solid {{ $link['icon'] }} text-[#001a4d] text-lg lg:text-xl transition-transform duration-500 group-hover:rotate-[-10deg]"></i>
                            </div>
                        </div>

                        {{-- LABEL: Tipografia Pesada --}}
                        <div class="relative z-10 text-center">
                            <span class="block text-[9px] lg:text-[11px] font-[1000] text-[#001a4d]/60 group-hover:text-white uppercase tracking-[0.2em] leading-tight transition-colors duration-300">
                                {{ $link['label'] }}
                            </span>
                            
                            {{-- Pill de Destaque --}}
                            <div class="mt-3 h-[4px] w-4 bg-slate-200 mx-auto rounded-full group-hover:w-10 group-hover:bg-[#A4ED4A] transition-all duration-500"></div>
                        </div>

                        {{-- Divisor sutil entre itens (só desktop) --}}
                        @if(!$loop->last)
                            <div class="hidden lg:block absolute right-0 top-1/4 bottom-1/4 w-[1px] bg-slate-200 group-hover:opacity-0 transition-opacity"></div>
                        @endif
                    </a>
                @endforeach

            </div>
        </div>
    </div>
</section>

<style>
    /* Ajustes para o grid mobile não quebrar o arredondamento interno */
    @media (max-width: 1023px) {
        .grid-cols-3 a { border-bottom: 1px solid rgba(0,0,0,0.05); border-right: 1px solid rgba(0,0,0,0.05); }
        .grid-cols-3 a:nth-child(3n) { border-right: 0; }
        .grid-cols-3 a:nth-child(n+4) { border-bottom: 0; }
    }
</style>