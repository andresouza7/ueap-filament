@props([
    'posts' => [],
])

<section>
    <div class="flex items-center justify-between mb-5">
        <h3 class="text-[10px] font-black uppercase tracking-[0.15em] text-gray-500">
            Mais Visualizadas
        </h3>
        <div class="h-px flex-1 bg-gray-100 mx-4"></div>
        <a href="{{ route('site.post.list') }}" class="text-[10px] font-bold text-[#017D49] hover:opacity-70 uppercase">
            Ver tudo
        </a>
    </div>

    <div class="space-y-4">
        @foreach ($posts->take(5) as $item)
            <a href="{{ route('site.post.show', $item->slug) }}" class="group flex items-start gap-4">
                {{-- Miniatura Otimizada para 4 colunas --}}
                <div class="relative shrink-0 w-20 h-16 overflow-hidden rounded-lg bg-gray-100 shadow-sm">
                    <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/200' }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>

                <div class="flex-1 min-w-0 py-0.5">
                    <span class="text-[9px] font-bold text-[#017D49] uppercase tracking-tight mb-1 block">
                        {{ $item->categories->first()->name ?? 'Geral' }}
                    </span>
                    <h4
                        class="text-[13px] font-bold text-gray-900 leading-snug group-hover:text-[#017D49] transition-colors line-clamp-2">
                        {{ $item->title }}
                    </h4>
                    <span class="text-[10px] text-gray-400 mt-1 flex items-center gap-1">
                        <i class="fa-regular fa-clock text-[9px]"></i>
                        {{ $item->created_at->diffForHumans() }}
                    </span>
                </div>
            </a>
        @endforeach
    </div>
</section>
