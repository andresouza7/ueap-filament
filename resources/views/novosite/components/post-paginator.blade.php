@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navegação de páginas"
        class="flex flex-col md:flex-row items-center justify-between gap-4 w-full border-t border-slate-200 pt-8 mt-12 mb-12">

        {{-- Total --}}
        <div class="hidden md:block text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            {{ $paginator->firstItem() ?? 0 }}-{{ $paginator->lastItem() ?? 0 }} / {{ $paginator->total() }}
        </div>

        {{-- Container de Páginas --}}
        <div class="flex flex-wrap items-center justify-center gap-1">
            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-300">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex items-center justify-center w-8 h-8 bg-white border border-slate-200 text-[#00388d] hover:bg-ueap-green hover:text-white hover:border-ueap-green transition-colors">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </a>
            @endif

            {{-- Links --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-slate-400 text-xs font-bold">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="flex items-center justify-center w-8 h-8 bg-[#00388d] text-white text-xs font-bold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="flex items-center justify-center w-8 h-8 bg-white border border-slate-200 text-slate-500 hover:border-ueap-green hover:text-[#00388d] text-xs font-bold transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Próximo --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex items-center justify-center w-8 h-8 bg-white border border-slate-200 text-[#00388d] hover:bg-ueap-green hover:text-white hover:border-ueap-green transition-colors">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </a>
            @else
                <span class="flex items-center justify-center w-8 h-8 bg-slate-100 text-slate-300">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </span>
            @endif
        </div>
    </nav>
@endif
