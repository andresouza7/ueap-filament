@props([
    'categories' => [],
])

<section>
    {{-- Header Padrão Sidebar --}}
    <div class="flex items-center justify-between mb-4 border-b border-slate-200 pb-2">
        <div class="flex items-center gap-2">
            <span class="flex h-1.5 w-1.5 bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
            <h3 class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-900">
                Assuntos
            </h3>
        </div>
        <span class="text-[8px] font-mono text-slate-400 uppercase tracking-tighter bg-slate-100 px-1.5 py-0.5 border border-slate-200">TAGS_DB</span>
    </div>

    {{-- Tags com Design Sharp e Industrial --}}
    <div class="flex flex-wrap gap-2">
        @foreach ($categories as $category)
            <a href="{{ route('site.post.list', ['category' => $category->slug]) }}"
                class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-[1px] 
                       text-[10px] font-black text-slate-500 uppercase tracking-[0.1em]
                       hover:bg-emerald-600 hover:text-white hover:border-emerald-600 
                       transition-all duration-300">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</section>