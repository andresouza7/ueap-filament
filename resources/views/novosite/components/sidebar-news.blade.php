@props([
    'posts' => [],
])

<section class="w-full" aria-labelledby="side-popular-title">
    {{-- HEADER --}}
    <div class="mb-6 pb-4 border-b border-gray-200">
        <h3 id="side-popular-title"
            class="text-2xl font-black text-ueap-blue-dark leading-none tracking-tighter uppercase pl-4 border-l-4 border-ueap-green">
            Destaques
        </h3>
    </div>

    <div class="flex flex-col gap-6">
        @foreach ($posts->take(5) as $index => $item)
            <article class="group relative">
                <a href="{{ route('site.post.show', $item->slug) }}" class="flex gap-4 items-start">

                    {{-- Imagem Thumbnail --}}
                    <div class="relative shrink-0 w-24 aspect-[16/10] bg-gray-100 overflow-hidden">
                        <img src="{{ $item->image_url }}" alt=""
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>

                    {{-- Texto --}}
                    <div class="flex flex-col">
                        {{-- Data --}}
                        <time class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">
                            {{ $item->created_at->format('d M, Y') }}
                        </time>

                        {{-- Título --}}
                        <h4
                            class="text-sm font-bold text-ueap-blue-dark leading-tight group-hover:text-ueap-green transition-colors line-clamp-3">
                            {{ $item->title }}
                        </h4>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    {{-- Link "Ver mais" --}}
    <div class="mt-8 pt-4 border-t border-gray-100">
        <a href="{{ route('site.post.list', ['type' => 'news']) }}"
            class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-ueap-blue-dark hover:text-ueap-green transition-colors">
            Ver todas as nótícias
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>
</section>
