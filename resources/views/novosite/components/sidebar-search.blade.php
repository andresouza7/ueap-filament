@props([
    'value' => '',
    'name' => 'search',
    'placeholder' => 'O QUE VOCÊ PROCURA?',
])

<section {{ $attributes->merge(['class' => 'w-full group/search']) }} role="search" aria-labelledby="search-title">
    {{-- HEADER ESTRUTURAL (DNA UEAP) --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-[12px] bg-[#002266]"></div>
        <h3 id="search-title" class="text-[13px] font-[1000] uppercase tracking-[0.4em] text-[#002266]">
            Pesquisar_<span class="text-[#A4ED4A] italic">Portal</span>
        </h3>
        <div class="flex-1 h-[2px] bg-[#002266]/10"></div>
    </div>

    <form action="{{ route('site.post.list') }}" method="GET" class="relative">
        @if (request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif

        {{-- INPUT CONTAINER COM BORDA PESADA --}}
        <div class="relative bg-white border-[3px] border-[#002266] rounded-full shadow-[4px_4px_0px_0px_#002266] transition-all duration-300 group-focus-within/search:shadow-[6px_6px_0px_0px_#A4ED4A] group-focus-within/search:translate-x-[-2px] group-focus-within/search:translate-y-[-2px] overflow-hidden">
            
            <div class="relative flex items-center h-14">
                {{-- CAMPO DE TEXTO --}}
                <input type="text" 
                    name="{{ $name }}" 
                    id="{{ $name }}-input"
                    value="{{ $value }}" 
                    placeholder="{{ $placeholder }}"
                    aria-label="{{ $placeholder }}"
                    class="flex-1 h-full bg-transparent pl-8 pr-16 text-[#002266] 
                           placeholder:text-[#002266]/30 focus:outline-none focus:ring-0
                           text-[11px] font-[900] tracking-widest leading-none uppercase">
                
                {{-- BOTÃO DE BUSCA - ESTILO "PILL" INTERNO --}}
                <div class="absolute right-1.5 top-1.5 bottom-1.5">
                    <button type="submit" 
                        aria-label="Executar Pesquisa"
                        class="h-full px-6 bg-[#002266] text-[#A4ED4A] rounded-full hover:bg-[#1d4ed8] transition-all flex items-center justify-center group-active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- STATUS INFERIOR COM GEOMETRIA --}}
        <div class="mt-4 flex justify-between items-center px-4" aria-hidden="true">
            <div class="flex gap-1.5 items-center">
                <div class="w-3 h-3 bg-[#A4ED4A] border-2 border-[#002266] rotate-45 group-focus-within/search:bg-[#002266]"></div>
                <div class="w-12 h-[2px] bg-[#002266]/10"></div>
            </div>
            <span class="text-[9px] font-[900] text-[#002266] uppercase tracking-[0.3em] opacity-40 group-focus-within/search:opacity-100 transition-opacity">
                Aguardando_Input
            </span>
        </div>
    </form>
</section>