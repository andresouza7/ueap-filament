@props([
    'value' => '',
    'name' => 'search',
    'placeholder' => 'Buscar no portal',
])

<section {{ $attributes->merge(['class' => 'w-full']) }} role="search" aria-labelledby="search-title">
    {{-- HEADER (Style Adapted from Home) --}}
    <div class="mb-6 pb-4 border-b border-gray-200">
        <h3 id="search-title"
            class="text-2xl font-black text-ueap-blue-dark leading-none tracking-tighter uppercase pl-4 border-l-4 border-ueap-green">
            Pesquisar
        </h3>
    </div>

    <form action="{{ route('site.post.list') }}" method="GET" class="relative group">
        @if (request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif

        <div class="relative">
            <input type="text" name="{{ $name }}" id="{{ $name }}-input" value="{{ $value }}"
                placeholder="{{ $placeholder }}" aria-label="{{ $placeholder }}"
                class="w-full bg-slate-50 border border-slate-200 pl-4 pr-14 py-4 text-ueap-blue-dark 
                           placeholder:text-slate-400 focus:outline-none focus:border-ueap-green focus:bg-white focus:ring-1 focus:ring-ueap-green
                           text-sm font-medium transition-all duration-300">

            <button type="submit" aria-label="Executar Pesquisa"
                class="absolute right-2 top-2 bottom-2 w-10 flex items-center justify-center bg-ueap-blue-dark text-white hover:bg-ueap-green hover:text-ueap-blue-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </form>
</section>
