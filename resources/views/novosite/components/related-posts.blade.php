@props([
    'posts' => []
])

<!-- Read Also (Bottom Grid) -->
<section class="mt-8 pt-12">
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-xl font-black uppercase tracking-tight text-gray-900 flex items-center gap-3">
            <span class="w-8 h-1 bg-ueap-green"></span>
            Veja também
        </h2>
    </div>

    {{-- Grid: Flex-col no mobile, 4 colunas no desktop --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-6">
        @foreach ($posts as $post)
            <article>
                <a href="{{ route('site.post.show', $post->slug) }}"
                    class="group flex flex-row lg:flex-col gap-4 lg:gap-4 items-start">

                    {{-- Container da Imagem: Tamanho fixo no mobile, proporção 4:3 no desktop --}}
                    <div
                        class="shrink-0 w-28 h-20 sm:w-36 sm:h-28 lg:w-full lg:h-auto lg:aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100 shadow-sm transition-all duration-500 group-hover:shadow-xl group-hover:shadow-ueap-green/10">
                        <img src="{{ 'https://picsum.photos/seed/' . $post->id . '/600/450' }}" alt="{{ $post->title }}"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110 group-hover:rotate-1">
                    </div>

                    {{-- Conteúdo --}}
                    <div class="flex flex-col min-w-0 py-1">
                        <div class="flex items-center gap-2 mb-1 lg:mb-2">
                            <span class="text-[10px] font-bold uppercase tracking-[0.1em] text-ueap-green">
                                {{ $post->category->name ?? 'Notícia' }}
                            </span>
                        </div>

                        <h3
                            class="font-bold text-sm sm:text-base text-gray-900 group-hover:text-ueap-green transition-colors leading-snug line-clamp-2 lg:line-clamp-3">
                            {{ $post->title }}
                        </h3>

                        <div
                            class="mt-2 lg:mt-3 flex items-center text-gray-400 text-[10px] sm:text-[11px] font-medium">
                            <i class="fa-regular fa-calendar-days mr-1.5"></i>
                            {{ $post->created_at->translatedFormat('d \d\e M, Y') }}
                        </div>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
</section>
