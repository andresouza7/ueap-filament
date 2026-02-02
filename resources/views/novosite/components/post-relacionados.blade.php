@props([
    'posts' => [],
])

<section class="w-full py-12" aria-labelledby="reproduction-heading">
    {{-- HEADER ESTRUTURAL (DNA UEAP) --}}
    <div class="flex items-center gap-4 mb-12">
        {{-- O Bloco de 12px da identidade --}}
        <div class="w-12 h-[12px] bg-[#002266]"></div>
        <h3 id="reproduction-heading" class="text-[14px] font-[900] uppercase tracking-[0.3em] text-[#002266]">
            Veja_<span class="text-[#A4ED4A] italic">Também</span>
        </h3>
        <div class="flex-1 h-[1px] bg-slate-100"></div>
    </div>

    {{-- GRID CONDENSADO (4 COLUNAS) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
        @foreach ($posts->take(4) as $item)
            <article class="group relative flex flex-col">
                
                {{-- CONTAINER DA IMAGEM COM GEOMETRIA --}}
                <a href="{{ route('site.post.show', $item->slug) }}" class="relative block mb-5">
                    {{-- Moldura decorativa atrás que aparece no hover --}}
                    <div class="absolute -top-2 -left-2 w-full h-full border-[2px] border-[#A4ED4A] rounded-[24px] opacity-0 group-hover:opacity-100 transition-all duration-300 -z-10"></div>
                    
                    <div class="aspect-video rounded-[22px] overflow-hidden bg-slate-200 border border-slate-100 shadow-sm">
                        <img src="{{ $item->image_url ?? 'https://picsum.photos/seed/'.$item->id.'/400/225' }}" 
                             alt="" 
                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500 group-hover:scale-110">
                    </div>

                    {{-- Selo de Categoria (Estilo Sticker) --}}
                    <div class="absolute -bottom-2 left-4 bg-[#002266] text-[#A4ED4A] text-[9px] font-black px-3 py-1 uppercase tracking-tighter shadow-md">
                        {{ $item->categories->first()->name ?? 'GERAL' }}
                    </div>
                </a>

                {{-- TEXTO --}}
                <div class="flex flex-col gap-2 px-1">
                    {{-- Título: Bold, Lowercase, Limpo --}}
                    <a href="{{ route('site.post.show', $item->slug) }}">
                        <h4 class="text-[16px] font-bold text-[#002266] leading-[1.2] lowercase tracking-tight group-hover:text-[#0055FF] transition-colors">
                            {{ $item->title }}
                        </h4>
                    </a>

                    {{-- Info Técnica --}}
                    <div class="flex items-center gap-2 mt-1">
                        <div class="w-4 h-[2px] bg-[#A4ED4A]"></div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                            publicado_em_{{ $item->created_at ? $item->created_at->format('d.m') : '15.01' }}
                        </span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    {{-- FECHAMENTO DA SEÇÃO --}}
    <div class="mt-16 flex items-center justify-between border-t border-slate-100 pt-8">
        <div class="flex gap-1">
            <div class="w-8 h-2 bg-[#002266] rounded-full"></div>
            <div class="w-2 h-2 bg-[#A4ED4A] rounded-full"></div>
            <div class="w-2 h-2 bg-slate-100 rounded-full"></div>
        </div>
        <a href="{{ route('site.post.list') }}" class="text-[10px] font-black uppercase tracking-widest text-[#002266] hover:text-[#A4ED4A] transition-colors">
            Explorar_Todas_Notícias →
        </a>
    </div>
</section>