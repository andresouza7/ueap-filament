@props([
    'pages' => []
])

<section>
    {{-- Header Padrão Sidebar --}}
    <div class="flex items-center gap-3 mb-5 border-b border-slate-100 pb-2">
        <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-900 whitespace-nowrap">
            Acesso <span class="text-emerald-600 italic">Rápido</span>
        </h3>
        <div class="h-[1px] flex-1 bg-transparent"></div>
        <i class="fa-solid fa-link text-[10px] text-slate-300"></i>
    </div>

    {{-- Lista de Páginas --}}
    <div class="flex flex-col">
        @foreach ($pages as $page)
            <a href="{{ route('site.post.show', ['slug' => $page->slug]) }}" 
                class="group flex items-center gap-3 py-3 border-b border-slate-50 last:border-0">
                
                {{-- Indicador: Traço Industrial em vez de Círculo --}}
                <span class="w-2 h-[2px] bg-slate-200 group-hover:w-4 group-hover:bg-emerald-500 transition-all duration-300"></span>
                
                <div class="flex-1">
                    {{-- Texto com Underline que respeita o comprimento --}}
                    <span class="inline text-[13px] font-bold text-slate-600 group-hover:text-slate-900 transition-all duration-300 uppercase tracking-tight
                                 bg-gradient-to-r from-emerald-500 to-emerald-500 bg-[length:0%_2px] bg-left-bottom bg-no-repeat 
                                 group-hover:bg-[length:100%_2px] group-hover:italic pb-0.5">
                        {{ $page->title }}
                    </span>
                </div>

                {{-- Ícone Chevron Minimalista --}}
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-200 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-emerald-500 transition-all duration-300"></i>
            </a>
        @endforeach
    </div>
</section>