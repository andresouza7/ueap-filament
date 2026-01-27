@props([
    'posts' => [],
])

<section class="w-full py-8" aria-labelledby="reproduction-heading">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 pb-4 border-b border-gray-200">
        <div>
            <h3 id="reproduction-heading"
                class="text-2xl lg:text-3xl font-black text-ueap-blue-dark leading-none tracking-tighter uppercase pl-4 border-l-4 border-ueap-green">
                Relacionados
            </h3>
        </div>

        <div class="hidden md:block">
            <a href="{{ route('site.post.list') }}"
                class="text-ueap-blue-dark font-bold text-[10px] uppercase tracking-widest hover:text-ueap-green transition-colors">
                Ver todo o acervo →
            </a>
        </div>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach ($posts->take(4) as $item)
            <article class="group">
                <a href="{{ route('site.post.show', $item->slug) }}" class="block h-full flex flex-col">

                    {{-- Imagem --}}
                    <div class="relative overflow-hidden bg-gray-100 mb-4 aspect-[16/10]">
                        <img src="{{ $item->image_url ?? 'https://picsum.photos/seed/' . $item->id . '/400/225' }}"
                            alt=""
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        <div class="absolute top-3 left-3">
                            <span
                                class="bg-ueap-blue-dark/90 backdrop-blur-sm text-white text-[9px] font-bold px-2 py-1 uppercase tracking-widest">
                                {{ $item->categories->first()->name ?? 'Geral' }}
                            </span>
                        </div>
                    </div>

                    {{-- Conteúdo --}}
                    <div class="flex-1 flex flex-col">
                        <time
                            class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-2 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-ueap-green"></span>
                            {{ $item->created_at ? $item->created_at->format('d M, Y') : 'Recente' }}
                        </time>

                        <h4
                            class="text-lg font-bold text-ueap-blue-dark leading-tight group-hover:text-ueap-green transition-colors mb-2">
                            {{ $item->title }}
                        </h4>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    {{-- Mobile View More --}}
    <div class="mt-8 md:hidden text-center">
        <a href="{{ route('site.post.list') }}"
            class="text-ueap-blue-dark font-bold text-[10px] uppercase tracking-widest border-b border-ueap-blue-dark pb-0.5 hover:text-ueap-green hover:border-ueap-green transition-colors">
            Ver todo o acervo →
        </a>
    </div>
</section>
