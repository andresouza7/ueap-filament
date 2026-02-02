@if ($paginator->hasPages())
    {{-- justify-center garante a centralização em todas as telas --}}
    <nav role="navigation" aria-label="Navegação de páginas" class="flex flex-col md:flex-row flex-wrap items-center justify-center gap-4 lg:gap-4 font-mono w-full">
        
        {{-- CONTAINER DE BOTÕES (ANTERIOR/PRÓXIMO) --}}
        <div class="flex items-center justify-between w-full md:w-auto gap-2">
            {{-- Botão Voltar --}}
            @if ($paginator->onFirstPage())
                <span class="flex-1 md:flex-none text-center px-3 py-2 text-slate-300 border border-slate-200 text-[10px] uppercase font-black opacity-40 cursor-not-allowed" 
                      aria-disabled="true">
                    [ VOLTAR_NULO ]
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" 
                   rel="prev" 
                   aria-label="Página anterior"
                   class="flex-1 md:flex-none text-center px-3 py-2 border border-[#001030] text-[#001030] text-[10px] uppercase font-black hover:bg-[#001030] hover:text-[#a4ed4a] transition-all">
                    [ ANTERIOR ]
                </a>
            @endif

            {{-- Botão Próximo (Mobile Only) --}}
            <div class="md:hidden flex-1">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" 
                       rel="next" 
                       aria-label="Próxima página"
                       class="w-full block text-center px-3 py-2 border border-[#001030] text-[#001030] text-[10px] uppercase font-black hover:bg-[#001030] hover:text-[#a4ed4a] transition-all">
                        [ PRÓXIMO ]
                    </a>
                @else
                    <span class="w-full block text-center px-3 py-2 text-slate-300 border border-slate-200 text-[10px] uppercase font-black opacity-40 cursor-not-allowed" 
                          aria-disabled="true">
                        [ FIM_LISTA ]
                    </span>
                @endif
            </div>
        </div>

        {{-- Container de Páginas --}}
        <div class="flex flex-wrap items-center justify-center bg-[#001030] px-2 py-1 border-b-2 border-[#a4ed4a] w-full md:w-auto">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-white/30 text-[10px]" aria-hidden="true">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="relative px-3 py-1 text-[#a4ed4a] text-sm lg:text-base font-[1000] italic tracking-tighter" 
                                  aria-current="page" 
                                  aria-label="Página atual, Página {{ $page }}">
                                {{ sprintf('%02d', $page) }}
                                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4 h-[2px] bg-[#a4ed4a]" aria-hidden="true"></span>
                            </span>
                        @else
                            <a href="{{ $url }}" 
                               aria-label="Ir para página {{ $page }}"
                               class="px-3 py-1 text-white/50 hover:text-[#a4ed4a] text-sm lg:text-base font-bold italic transition-colors">
                                {{ sprintf('%02d', $page) }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Botão Próximo (Desktop Only) --}}
        <div class="hidden md:block">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" 
                   rel="next" 
                   aria-label="Próxima página"
                   class="px-3 py-2 border border-[#001030] text-[#001030] text-[10px] uppercase font-black hover:bg-[#001030] hover:text-[#a4ed4a] transition-all">
                    [ PRÓXIMO ]
                </a>
            @else
                <span class="px-3 py-2 text-slate-300 border border-slate-200 text-[10px] uppercase font-black opacity-40 cursor-not-allowed" 
                      aria-disabled="true">
                    [ FIM_LISTA ]
                </span>
            @endif
        </div>

        {{-- Info Técnica --}}
        <div class="hidden xl:block text-[9px] text-slate-400 uppercase tracking-[0.2em]" role="status">
            TOTAL_REGISTROS: <span class="text-[#001030] font-black italic">{{ $paginator->total() }}</span>
        </div>
    </nav>
@endif