<section class="py-10 lg:py-16 bg-white">
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Cabeçalho da Seção --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-12 gap-4">
            <div>
                <span class="text-emerald-600 font-bold text-sm uppercase tracking-[0.2em] mb-2 block">Fique por
                    dentro</span>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight">Últimas Notícias</h2>
            </div>
            <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                class="group flex items-center text-slate-500 font-bold hover:text-emerald-600 transition-colors duration-300">
                Ver todo o acervo
                <span
                    class="ml-2 flex items-center justify-center w-8 h-8 rounded-full bg-slate-200 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </a>
        </div>

        {{-- Grid de Notícias --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10">
            @foreach ($posts as $post)
                <article class="group flex flex-col">
                    {{-- Imagem Condensada --}}
                    <div class="relative aspect-[16/9] overflow-hidden rounded-xl mb-4 bg-gray-100">
                        <img src="{{ $post->image_url ?: 'https://picsum.photos/600/400?random=' . $post->id }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        {{-- Categoria Discreta --}}
                        <div class="absolute top-2.5 left-2.5">
                            <span
                                class="bg-black/60 backdrop-blur-md text-white text-[9px] font-bold px-2 py-1 rounded uppercase tracking-tighter">
                                {{ $post->category->name ?? 'Geral' }}
                            </span>
                        </div>
                    </div>

                    {{-- Conteúdo Condensado --}}
                    <div class="flex flex-col">
                        {{-- Data e Meta --}}
                        <div
                            class="flex items-center text-slate-400 text-[10px] font-bold uppercase tracking-tight mb-1.5">
                            <svg class="w-3 h-3 mr-1 opacity-60" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ $post->created_at->translatedFormat('d M Y') }}
                        </div>

                        {{-- Título --}}
                        <a href="{{ route('site.post.show', $post->slug) }}" class="block mb-2">
                            <h3
                                class="text-base font-bold text-slate-800 leading-snug group-hover:text-[#017D49] transition-colors line-clamp-2">
                                {{ $post->title }}
                            </h3>
                        </a>

                        {{-- Resumo Menor --}}
                        <p class="text-slate-500 text-xs leading-normal line-clamp-2 mb-3">
                            {{ Str::limit(clean_text(html_entity_decode(strip_tags($post->text))), 100) }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
