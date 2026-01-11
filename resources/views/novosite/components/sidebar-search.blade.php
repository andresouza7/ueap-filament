@props([
    'value' => '',
    'name' => 'search',
    'placeholder' => 'O que você procura?',
])

<section {{ $attributes->merge(['class' => 'w-full']) }}>
    {{-- Título Harmonizado com o Padrão da Sidebar --}}
    <div class="flex items-center gap-3 mb-5 border-b border-slate-100 pb-2">
        <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-900 whitespace-nowrap">
            Pesquisar
        </h3>
        <div class="h-[1px] flex-1 bg-transparent"></div> {{-- Espaçador --}}
        <i class="fa-solid fa-magnifying-glass text-[10px] text-slate-300"></i>
    </div>

    <form class="relative group" action="{{ route('site.post.list') }}" method="GET">
        {{-- Mantém o tipo ativo durante a busca --}}
        @if (request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif

        <div class="relative overflow-hidden">
            {{-- Input com Background Sólido para evitar conflito de linhas --}}
            <input type="text" 
                name="{{ $name }}" 
                value="{{ $value }}" 
                placeholder="{{ $placeholder }}"
                class="w-full bg-slate-50 border-none py-4 px-4 text-slate-900 
                       placeholder:text-slate-300 focus:outline-none focus:ring-0
                       transition-all duration-500 text-[11px] font-black uppercase tracking-widest rounded-[1px]">
            
            {{-- Detalhe de foco: Uma linha que só aparece quando o bloco é acionado --}}
            <div class="absolute bottom-0 left-0 h-[2px] w-0 bg-emerald-600 transition-all duration-500 group-focus-within:w-full"></div>
            
            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-emerald-600 transition-colors p-2">
                <i class="fa-solid fa-arrow-right text-[11px]"></i>
            </button>
        </div>
    </form>
</section>