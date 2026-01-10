<section class="py-10 lg:py-20 bg-white">
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Cabeçalho --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-8 lg:mb-12 gap-4">
            <div>
                <span class="text-emerald-600 font-bold text-sm uppercase tracking-[0.2em] mb-2 block">
                    Fique por dentro
                </span>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight">Últimas Notícias</h2>
            </div>
            <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                class="group flex items-center text-slate-500 font-bold hover:text-emerald-600 transition-colors duration-300">
                Explorar Tudo
                <span class="ml-2 flex items-center justify-center w-8 h-8 rounded-full bg-slate-200 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </a>
        </div>

        {{-- Grid Principal --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-4 sm:gap-y-10">
            @foreach ($posts as $post)
                {{-- No Mobile: Lista com borda | No SM+: Card sem borda --}}
                <article class="group flex flex-row sm:flex-col gap-4 sm:gap-0 pb-4 sm:pb-0 border-b border-gray-100 sm:border-0 last:border-0">
                    
                    {{-- Imagem --}}
                    {{-- Mobile: w-24 h-20 | Desktop: Aspect 16/9 --}}
                    <div class="shrink-0 w-24 h-20 sm:w-full sm:h-auto sm:aspect-[16/9] overflow-hidden rounded-xl sm:mb-4 bg-gray-50">
                        <a href="{{ route('site.post.show', $post->slug) }}" class="block h-full">
                            <img src="{{ $post->image_url ?: 'https://picsum.photos/seed/'.$post->id.'/400/300' }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </a>
                    </div>

                    {{-- Conteúdo --}}
                    <div class="flex-1 min-w-0">
                        {{-- Meta: Categoria e Data --}}
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[9px] sm:text-[10px] font-black uppercase tracking-widest text-emerald-600">
                                {{ $post->category->name ?? 'Geral' }}
                            </span>
                            <span class="text-gray-300">•</span>
                            <time class="text-[10px] sm:text-[11px] font-medium text-gray-400">
                                {{ $post->created_at->format('d/m/Y') }}
                            </time>
                        </div>

                        {{-- Título --}}
                        <a href="{{ route('site.post.show', $post->slug) }}" class="block mb-1.5 sm:mb-2">
                            <h3 class="text-sm sm:text-base font-bold text-gray-900 leading-snug group-hover:text-emerald-700 transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>
                        </a>

                        {{-- Resumo: Apenas Desktop (SM+) --}}
                        <p class="text-gray-500 text-xs leading-normal line-clamp-2 mb-3 hidden sm:block">
                            {{ Str::limit(clean_text(html_entity_decode(strip_tags($post->text))), 100) }}
                        </p>

                        {{-- Botão Ler Mais: Apenas Mobile --}}
                        <a href="{{ route('site.post.show', $post->slug) }}"
                            class="inline-flex sm:hidden items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-gray-400 group-hover:text-emerald-700 transition-all">
                            Ler Mais
                            <svg class="w-2.5 h-2.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Botão Ver mais (Mobile) --}}
        <div class="mt-6 sm:hidden">
            <a href="{{ route('site.post.list', ['type' => 'news']) }}" 
               class="flex items-center justify-center w-full py-3 px-6 bg-slate-100 text-slate-600 font-bold text-xs uppercase tracking-widest rounded-xl">
                Ver todas as notícias
            </a>
        </div>
    </div>
</section>