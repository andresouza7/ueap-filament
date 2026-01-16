@props([
    'posts' => [],
])

<section class="w-full" aria-labelledby="side-popular-title">
    {{-- HEADER ESTRUTURAL (DNA UEAP) --}}
    <div class="flex items-center gap-4 mb-10">
        {{-- O Retângulo de 12px da sua identidade --}}
        <div class="w-12 h-[12px] bg-[#002266]"></div>
        <h3 id="side-popular-title" class="text-[14px] font-black uppercase tracking-[0.3em] text-[#002266]">
            Mais_<span class="text-[#A4ED4A] italic">Lidas</span>
        </h3>
        <div class="flex-1 h-[1px] bg-slate-100"></div>
    </div>

    <div class="flex flex-col gap-10">
        @foreach ($posts->take(5) as $index => $item)
            <article class="group relative">
                <a href="{{ route('site.post.show', $item->slug) }}" class="flex gap-6 items-center">
                    
                    {{-- CONTAINER DA IMAGEM COM GEOMETRIA --}}
                    <div class="relative shrink-0">
                        {{-- Forma geométrica de 8px decorativa atrás da imagem no hover --}}
                        <div class="absolute -top-2 -left-2 w-full h-full border-[2px] border-[#A4ED4A] rounded-[24px] opacity-0 group-hover:opacity-100 transition-all duration-300 -z-10"></div>
                        
                        <div class="w-28 h-20 rounded-[22px] overflow-hidden bg-slate-200 shadow-sm border border-slate-100">
                            <img src="{{ $item->image_url }}" alt="" 
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-transform duration-500 group-hover:scale-110">
                        </div>

                        {{-- Rank numérico em badge Black --}}
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#002266] text-[#A4ED4A] flex items-center justify-center rounded-full text-[10px] font-black border-2 border-white shadow-lg">
                            {{ $index + 1 }}
                        </div>
                    </div>

                    {{-- TEXTO --}}
                    <div class="flex flex-col gap-1">
                        {{-- Categoria idêntica ao selo do footer --}}
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-[#A4ED4A] bg-[#002266] px-2 py-0.5 self-start mb-1">
                            {{ $item->categories->first()->name ?? 'GERAL' }}
                        </span>

                        {{-- Título minúsculo, bold e limpo --}}
                        <h4 class="text-[16px] font-bold text-[#002266] leading-[1.2] lowercase tracking-tight group-hover:text-[#0055FF] transition-colors">
                            {{ $item->title }}
                        </h4>

                        {{-- Hits com tipografia de info do footer --}}
                        <div class="flex items-center gap-2 mt-1">
                            <div class="w-4 h-[2px] bg-[#A4ED4A]"></div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                {{ number_format($item->hits, 0, ',', '.') }} acessos
                            </span>
                        </div>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    {{-- FECHAMENTO DA SEÇÃO --}}
    <div class="mt-12 flex items-center justify-between">
        <div class="flex gap-1">
            <div class="w-2 h-2 bg-[#002266] rounded-full"></div>
            <div class="w-2 h-2 bg-[#A4ED4A] rounded-full"></div>
            <div class="w-12 h-2 bg-slate-100 rounded-full"></div>
        </div>
        <a href="{{ route('site.post.list') }}" class="text-[10px] font-black uppercase tracking-widest text-[#002266] hover:underline">
            Ver_Relatório_Completo
        </a>
    </div>
</section>