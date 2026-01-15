@props([
    'posts' => [],
])

<section class="bg-transparent" aria-labelledby="side-popular-title">
    {{-- Header Técnico --}}
    <div class="flex items-center justify-between mb-6 border-b border-slate-200 pb-2">
        <div class="flex items-center gap-2">
            {{-- Decorativo: oculto --}}
            <span class="flex h-1.5 w-1.5 bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]" aria-hidden="true"></span>

            <h3 id="side-popular-title" class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-900">
                Mais_<span class="text-emerald-600 italic">Visualizadas</span>
            </h3>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('site.post.list') }}" aria-label="Ver todas as postagens populares"
                class="group flex items-center gap-2 text-[9px] font-mono font-bold uppercase tracking-tighter text-slate-400 hover:text-emerald-600 transition-colors">
                <span aria-hidden="true">[ VER_TUDO ]</span>
                <span class="sr-only">Ver Tudo</span>
                <i class="fa-solid fa-chevron-right text-[7px] transition-transform group-hover:translate-x-1"
                    aria-hidden="true"></i>
            </a>
        </div>
    </div>

    {{-- Lista com Indexação --}}
    <div class="flex flex-col gap-5">
        @foreach ($posts->take(5) as $index => $item)
            <article class="group relative">
                {{-- O link agora engloba o contexto com um aria-label para não ler apenas o título isolado --}}
                <a href="{{ route('site.post.show', $item->slug) }}" class="flex items-start gap-4"
                    aria-label="Postagem rank {{ $index + 1 }}: {{ $item->title }}">

                    {{-- Miniatura com Efeito de Monitor --}}
                    <div
                        class="relative shrink-0 w-20 h-14 lg:w-24 lg:h-16 overflow-hidden bg-slate-900 border border-slate-200">
                        {{-- Overlay de Scanline (Decorativo) --}}
                        <div aria-hidden="true"
                            class="absolute inset-0 z-10 pointer-events-none opacity-20 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.25)_50%),linear-gradient(90deg,rgba(255,0,0,0.06),rgba(0,255,0,0.02),rgba(0,0,255,0.06))] bg-[length:100%_2px,3px_100%]">
                        </div>

                        {{-- Número do Rank --}}
                        <div aria-hidden="true"
                            class="absolute top-0 left-0 z-20 bg-slate-900 text-white text-[8px] font-mono px-1 py-0.5">
                            0{{ $index + 1 }}
                        </div>

                        {{-- Alt vazio pois o contexto já está no aria-label do link pai --}}
                        <img src="{{ $item->image_url }}" alt=""
                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                    </div>

                    <div class="flex-1 min-w-0">
                        {{-- Metadados de Sistema --}}
                        <div class="flex items-center gap-2 mb-1">
                            <span
                                class="text-[9px] font-mono font-bold text-emerald-600 uppercase tracking-tighter bg-emerald-50 px-1">
                                {{ $item->categories->first()->name ?? 'GERAL' }}
                            </span>
                            <span class="w-1 h-1 bg-slate-200 rounded-full" aria-hidden="true"></span>
                            <span class="text-[9px] font-mono text-slate-400 uppercase flex items-center gap-1">
                                <i class="fa-solid fa-chart-line text-[8px]" aria-hidden="true"></i>
                                <span class="sr-only">Total de visualizações:</span>
                                {{ number_format($item->hits, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Título --}}
                        <h4
                            class="text-[13px] lg:text-[14px] font-extrabold text-slate-800 leading-tight tracking-tight uppercase italic group-hover:text-emerald-600 transition-colors">
                            {{ $item->title }}
                        </h4>
                    </div>
                </a>
            </article>
        @endforeach
    </div>
</section>
