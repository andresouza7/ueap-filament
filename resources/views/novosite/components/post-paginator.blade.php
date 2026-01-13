@if ($paginator->hasPages())
    {{-- justify-center garante a centralização em todas as telas --}}
    <nav role="navigation" aria-label="Navegação das Páginas" class="flex flex-col md:flex-row flex-wrap items-center justify-center gap-4 lg:gap-4 font-mono w-full">
        
        {{-- CONTAINER DE BOTÕES (ANTERIOR/PRÓXIMO) --}}
        <div class="flex items-center justify-between w-full md:w-auto gap-2">
            {{-- Botão Voltar --}}
            @if ($paginator->onFirstPage())
                <span class="flex-1 md:flex-none text-center px-3 py-2 text-slate-300 border border-slate-200 text-[10px] uppercase font-black opacity-40 cursor-not-allowed">
                    [ VOLTAR_NULO ]
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="flex-1 md:flex-none text-center px-3 py-2 border border-emerald-500/30 text-emerald-600 text-[10px] uppercase font-black hover:bg-emerald-500 hover:text-white transition-all">
                    [ ANTERIOR ]
                </a>
            @endif

            {{-- Botão Próximo (Mobile Only) --}}
            <div class="md:hidden flex-1">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-full block text-center px-3 py-2 border border-emerald-500/30 text-emerald-600 text-[10px] uppercase font-black hover:bg-emerald-500 hover:text-white transition-all">
                        [ PRÓXIMO ]
                    </a>
                @else
                    <span class="w-full block text-center px-3 py-2 text-slate-300 border border-slate-200 text-[10px] uppercase font-black opacity-40 cursor-not-allowed">
                        [ FIM_LISTA ]
                    </span>
                @endif
            </div>
        </div>

        {{-- Container de Páginas --}}
        <div class="flex flex-wrap items-center justify-center bg-slate-50 px-2 py-1 border border-slate-200 w-full md:w-auto">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-slate-400 text-[10px]">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="relative px-3 py-1 text-emerald-600 text-sm lg:text-base font-[1000] italic tracking-tighter">
                                {{ sprintf('%02d', $page) }}
                                <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4 h-[2px] bg-emerald-500"></span>
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 text-slate-400 hover:text-emerald-600 text-sm lg:text-base font-bold transition-colors">
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
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 border border-emerald-500/30 text-emerald-600 text-[10px] uppercase font-black hover:bg-emerald-500 hover:text-white transition-all">
                    [ PRÓXIMO ]
                </a>
            @else
                <span class="px-3 py-2 text-slate-300 border border-slate-200 text-[10px] uppercase font-black opacity-40 cursor-not-allowed">
                    [ FIM_LISTA ]
                </span>
            @endif
        </div>

        {{-- Info Técnica --}}
        <div class="hidden xl:block text-[9px] text-slate-400 uppercase tracking-[0.2em]">
            TOTAL_REGISTROS: <span class="text-slate-900 font-bold">{{ $paginator->total() }}</span>
        </div>
    </nav>
@endif