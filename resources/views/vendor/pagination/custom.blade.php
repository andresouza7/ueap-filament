@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-1 mt-4 text-sm" role="navigation">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1.5 rounded border border-gray-300 text-gray-400 cursor-default">
                ‹
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-1.5 rounded border border-gray-300 text-gray-700 hover:bg-gray-100">
                ‹
            </a>
        @endif

        {{-- Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1.5 rounded border border-gray-300 text-gray-400 cursor-default">
                    {{ $element }}
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 rounded border border-gray-300 bg-gray-200 text-gray-800 cursor-default">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-1.5 rounded border border-gray-300 text-gray-700 hover:bg-gray-100">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-1.5 rounded border border-gray-300 text-gray-700 hover:bg-gray-100">
                ›
            </a>
        @else
            <span class="px-3 py-1.5 rounded border border-gray-300 text-gray-400 cursor-default">
                ›
            </span>
        @endif

    </nav>
@endif
