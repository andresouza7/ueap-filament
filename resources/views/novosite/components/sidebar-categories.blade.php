@props([
    'categories' => [],
])

{{-- Adicionado aria-labelledby para contextualizar a seção de categorias --}}
<section aria-labelledby="sidebar-categories-title">
    {{-- Header Padrão Sidebar --}}
    <div class="flex items-center justify-between mb-4 border-b border-slate-200 pb-2">
        <div class="flex items-center gap-2">
            {{-- Decorativo: oculto para leitores de tela --}}
            <span class="flex h-1.5 w-1.5 bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]" aria-hidden="true"></span>
            <h3 id="sidebar-categories-title" class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-900">
                Assuntos
            </h3>
        </div>
        {{-- Oculto: termo técnico puramente estético --}}
        <span
            class="text-[8px] font-mono text-slate-400 uppercase tracking-tighter bg-slate-100 px-1.5 py-0.5 border border-slate-200"
            aria-hidden="true">TAGS_DB</span>
    </div>

    {{-- Tags com Design Sharp e Industrial --}}
    {{-- Adicionado role="list" para que o navegador anuncie "Lista com X itens" --}}
    <nav class="flex flex-wrap gap-2" role="list">
        @foreach ($categories as $category)
            {{-- Cada item dentro de uma lista deve ter role="listitem" para semântica correta --}}
            <div role="listitem">
                <a href="{{ route('site.post.list', ['category' => $category->slug]) }}"
                    aria-label="Ver postagens sobre {{ $category->name }}"
                    class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-[1px] 
                           text-[10px] font-black text-slate-500 uppercase tracking-[0.1em]
                           hover:bg-emerald-600 hover:text-white hover:border-emerald-600 
                           transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    {{ $category->name }}
                </a>
            </div>
        @endforeach
    </nav>
</section>
