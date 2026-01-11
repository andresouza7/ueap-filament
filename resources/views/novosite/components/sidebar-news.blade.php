@props([
    'posts' => [],
])

<section class="bg-white">
    {{-- Header: Borda Fina e Chevron --}}
    <div class="flex items-center justify-between mb-5 border-b border-slate-100 pb-2">
        <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-900 flex items-center gap-2">
            Mais <span class="text-emerald-600 italic">Lidas</span>
        </h3>
        <a href="{{ route('site.post.list') }}"
            class="group flex items-center gap-1 text-[10px] font-bold uppercase tracking-widest text-slate-400 hover:text-emerald-600 transition-colors">
            Ver tudo
            <i class="fa-solid fa-chevron-right text-[8px] transition-transform group-hover:translate-x-0.5"></i>
        </a>
    </div>

    {{-- Lista: Espaçamentos reduzidos (gap-4) --}}
    <div class="flex flex-col gap-4">
        @foreach ($posts->take(5) as $item)
            <article class="group relative">
                {{-- Link cobrindo imagem e título --}}
                <a href="{{ route('site.post.show', $item->slug) }}" class="flex items-start gap-3">

                    {{-- Miniatura Sharp --}}
                    <div
                        class="relative shrink-0 w-20 h-14 lg:w-24 lg:h-16 overflow-hidden rounded-[1px] bg-slate-50 border border-slate-100">
                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/200' }}"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                    </div>

                    <div class="flex-1 min-w-0">
                        {{-- Metadados --}}
                        <div class="flex items-center gap-2 mb-0.5">
                            <span class="text-[9px] font-black text-emerald-600 uppercase tracking-tighter">
                                {{ $item->categories->first()->name ?? 'Geral' }}
                            </span>
                            <span class="text-slate-300 text-[8px] font-light">/</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase flex items-center gap-1">
                                <i class="fa-solid fa-eye text-[8px] opacity-70"></i>
                                {{ number_format($item->hits, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Título com Underline que respeita o comprimento do texto --}}
                        <h4
                            class="inline text-[13px] lg:text-[14px] font-extrabold text-slate-800 leading-tight italic tracking-tight
                                   bg-gradient-to-r from-emerald-500 to-emerald-500 bg-[length:0%_2px] bg-left-bottom bg-no-repeat 
                                   transition-[background-size] duration-500 group-hover:bg-[length:100%_2px] pb-0.5">
                            {{ $item->title }}
                        </h4>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
</section>
