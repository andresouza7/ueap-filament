@props([
    'value' => '',
    'name' => 'search',
    'placeholder' => 'O que você procura?',
])

<section {{ $attributes->merge(['class' => 'w-full group/search']) }}>
    {{-- Cabeçalho da Consulta --}}
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <span class="flex h-1.5 w-1.5 bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-900">
                Realizar_Pesquisa
            </h3>
        </div>
        <span class="text-[8px] font-mono text-slate-400 uppercase tracking-tighter bg-slate-100 px-1.5 py-0.5">SISTEMA_ATIVO</span>
    </div>

    <form action="{{ route('site.post.list') }}" method="GET" class="relative">
        @if (request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif

        {{-- Container Industrial com Alinhamento Central --}}
        <div class="relative bg-white border border-slate-200 transition-all duration-300 group-focus-within/search:border-slate-900">
            
            {{-- Cantoneiras de Foco --}}
            <div class="absolute -top-[1px] -left-[1px] w-2 h-2 border-t border-l border-emerald-500 opacity-0 group-focus-within/search:opacity-100 transition-opacity"></div>
            <div class="absolute -bottom-[1px] -right-[1px] w-2 h-2 border-b border-r border-emerald-500 opacity-0 group-focus-within/search:opacity-100 transition-opacity"></div>

            <div class="relative flex items-center h-12 overflow-hidden">
                {{-- Prefixo de Prompt Centralizado --}}
                <div class="flex items-center h-full pl-4 pr-2">
                    <span class="text-[12px] font-mono font-bold text-slate-400 group-focus-within/search:text-emerald-600 transition-colors leading-none">>></span>
                </div>

                {{-- Campo de Texto Centralizado --}}
                <input type="text" 
                    name="{{ $name }}" 
                    value="{{ $value }}" 
                    placeholder="{{ $placeholder }}"
                    class="flex-1 h-full bg-transparent pr-12 text-slate-900 
                           placeholder:text-slate-300 focus:outline-none focus:ring-0
                           text-[13px] font-medium tracking-tight leading-none">
                
                {{-- Botão de Execução Centralizado --}}
                <button type="submit" 
                    class="absolute right-0 top-0 bottom-0 w-12 bg-slate-900 text-white hover:bg-emerald-600 transition-all flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                </button>
            </div>
        </div>

        {{-- Barra de Status Inferior --}}
        <div class="mt-2 flex justify-between items-center px-1">
            <div class="flex gap-1">
                <div class="w-1 h-1 bg-slate-200 group-focus-within/search:bg-emerald-500 transition-colors"></div>
                <div class="w-1 h-1 bg-slate-200 group-focus-within/search:bg-emerald-500/60 transition-colors"></div>
            </div>
            <span class="text-[7px] font-mono text-slate-400 uppercase tracking-widest">Aguardando_Entrada...</span>
        </div>
    </form>
</section>