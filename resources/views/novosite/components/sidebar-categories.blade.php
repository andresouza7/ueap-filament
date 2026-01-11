@props([
    'categories' => [],
])

<section>
    {{-- Header Padrão Sidebar --}}
    <div class="flex items-center gap-3 mb-5 border-b border-slate-100 pb-2">
        <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-900 whitespace-nowrap">
            Assuntos
        </h3>
        <div class="h-[1px] flex-1 bg-transparent"></div>
        <i class="fa-solid fa-tags text-[10px] text-slate-300"></i>
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