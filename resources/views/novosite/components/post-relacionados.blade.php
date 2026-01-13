@props([
    'posts' => [],
])

<section class="w-full">
    {{-- Header alinhado com a identidade visual --}}
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl lg:text-4xl font-black tracking-tighter uppercase italic text-slate-900 whitespace-nowrap">
            <span class="text-slate-400 not-italic font-light">Veja</span> também<span class="text-emerald-500 not-italic">.</span>
        </h2>
        <div class="hidden lg:block h-[2px] flex-1 mx-8 bg-slate-100"></div>
    </div>

    {{-- Layout Adaptativo: Lista no Mobile (cols-1) e Grid no Desktop (lg:cols-4) --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:gap-6">
        @foreach ($posts->take(4) as $item)
            <article class="group relative flex flex-col gap-3">
                
                {{-- Miniatura Sharp --}}
                <a href="{{ route('site.post.show', $item->slug) }}" class="block">
                    <div class="relative aspect-video overflow-hidden rounded-[1px] bg-slate-50 border border-slate-100">
                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/400/225' }}"
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                        
                        {{-- Detalhe Cyber Sutil no Canto da Imagem --}}
                        <div class="absolute top-0 right-0 w-4 h-4 border-t border-r border-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </a>

                {{-- Conteúdo --}}
                <div class="flex flex-col">
                    {{-- Badge de Categoria --}}
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">
                            {{ $item->categories->first()->name ?? 'Geral' }}
                        </span>
                    </div>

                    {{-- Título com Underline Dinâmico --}}
                    <a href="{{ route('site.post.show', $item->slug) }}">
                        <h4 class="text-lg lg:text-[15px] font-extrabold text-slate-800 leading-tight italic tracking-tight
                                   bg-gradient-to-r from-emerald-500 to-emerald-500 bg-[length:0%_2px] bg-left-bottom bg-no-repeat 
                                   transition-[background-size] duration-500 group-hover:bg-[length:100%_2px] pb-1">
                            {{ $item->title }}
                        </h4>
                    </a>
                    
                    {{-- Info extra visível apenas no mobile ou em hover --}}
                    <p class="mt-2 text-xs text-slate-500 line-clamp-2 lg:hidden">
                        {{ $item->excerpt ?? '' }}
                    </p>
                </div>
            </article>
        @endforeach
    </div>
</section>