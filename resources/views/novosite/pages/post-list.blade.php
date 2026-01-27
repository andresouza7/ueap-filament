@extends('novosite.template.master')

@section('title', 'Explorar Publicações - UEAP')

@section('content')
    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- HEADER PADRÃO (IGUAL POST-SHOW) --}}
    <header class="relative overflow-hidden bg-slate-50 border-b border-slate-300">
        {{-- textura --}}
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 30px 30px;"></div>

        {{-- skew decorativo --}}
        <div aria-hidden="true"
            class="hidden lg:block absolute right-0 top-0 w-[32%] h-full bg-slate-200/70 
               skew-x-[-12deg] translate-x-24 border-l border-ueap-green/30">
            <span class="absolute left-6 top-10 -rotate-90 text-[9px] font-mono tracking-[0.4em] text-slate-400 uppercase">
                UEAP_DOC
            </span>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
            <div class="max-w-4xl">

                {{-- categoria / tipo / status --}}
                <div class="flex flex-wrap items-center gap-4 mb-4">
                    <span class="px-4 py-1.5 bg-[#00388d] text-white text-[11px] font-bold uppercase tracking-wider">
                        Conteúdo
                    </span>

                    <span class="text-[11px] font-mono uppercase tracking-widest text-slate-500">
                        Explore
                    </span>

                    <div class="flex items-center gap-1.5 text-ueap-green">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full bg-ueap-green opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 bg-ueap-green"></span>
                        </span>
                    </div>
                </div>

                {{-- título --}}
                <h1
                    class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00388d] uppercase leading-tight tracking-tight mb-6">
                    Explorar Publicações<span class="text-ueap-green">.</span>
                </h1>

                {{-- Barra final inferior (Simulando o padrão do post-show) --}}
                <div class="flex items-center justify-between pt-6 border-t border-slate-300">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-mono uppercase tracking-widest text-slate-400">
                            Últimas Atualizações
                        </span>
                        <div class="h-1 w-12 bg-ueap-green"></div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- CAIXA DE BUSCA E FILTROS --}}
                    <div class="mb-12 bg-slate-50 p-6 border border-slate-200">
                        <form action="{{ route('site.post.list') }}" method="GET" class="flex flex-col gap-6">
                            @php $currentType = request('type'); @endphp
                            @if ($currentType)
                                <input type="hidden" name="type" value="{{ $currentType }}">
                            @endif

                            {{-- Input Search --}}
                            <div
                                class="flex items-center bg-white border border-slate-300 px-4 py-3 focus-within:border-[#00388d] transition-colors">
                                <i class="fa-solid fa-search text-slate-400 mr-3"></i>
                                <input type="text" name="search" value="{{ $searchString ?? '' }}"
                                    placeholder="BUSCAR POR TERMO..."
                                    class="w-full bg-transparent text-sm font-bold text-[#00388d] focus:outline-none placeholder:text-slate-400 uppercase tracking-wide">
                            </div>

                            {{-- Tipos de Filtro --}}
                            <div class="flex flex-wrap items-center justify-between gap-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('site.post.list') }}"
                                        class="px-4 py-2 text-[10px] font-black uppercase tracking-wider transition-colors {{ !request('type') ? 'bg-[#00388d] text-white' : 'bg-white border border-slate-200 text-slate-500 hover:text-[#00388d] hover:border-[#00388d]' }}">
                                        TODOS
                                    </a>
                                    @foreach ([['label' => 'NOTÍCIAS', 'val' => 'news'], ['label' => 'EVENTOS', 'val' => 'event']] as $t)
                                        <a href="{{ route('site.post.list', ['type' => $t['val']]) }}"
                                            class="px-4 py-2 text-[10px] font-black uppercase tracking-wider transition-colors {{ request('type') == $t['val'] ? 'bg-[#00388d] text-white' : 'bg-white border border-slate-200 text-slate-500 hover:text-[#00388d] hover:border-[#00388d]' }}">
                                            {{ $t['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                                <button type="submit"
                                    class="px-6 py-2 bg-ueap-green text-white font-black text-[10px] uppercase tracking-wider hover:bg-ueap-blue transition-colors">
                                    APLICAR FILTROS
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM DE POSTS --}}
                    <div class="space-y-12">
                        @forelse ($posts as $item)
                            <article
                                class="group flex flex-col md:flex-row gap-6 md:items-start border-b border-slate-100 pb-12 last:border-0 last:pb-0">
                                {{-- Thumbnail --}}
                                <a href="{{ route('site.post.show', $item->slug) }}"
                                    class="shrink-0 md:w-64 aspect-[16/10] overflow-hidden bg-slate-100 relative border border-slate-200">
                                    <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}"
                                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                </a>

                                {{-- Content --}}
                                <div class="flex-1 flex flex-col items-start">
                                    <div class="flex items-center gap-3 mb-2">
                                        <span
                                            class="text-[10px] font-black text-white bg-[#00388d] px-2 py-0.5 uppercase tracking-wider">
                                            {{ $item->categories->first()->name ?? 'Geral' }}
                                        </span>
                                        <time class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </time>
                                    </div>

                                    <h3
                                        class="text-xl md:text-2xl font-black text-[#00388d] leading-tight mb-3 uppercase tracking-tight">
                                        <a href="{{ route('site.post.show', $item->slug) }}"
                                            class="group-hover:text-ueap-green transition-colors">
                                            {{ $item->title }}
                                        </a>
                                    </h3>

                                    <p
                                        class="text-slate-600 text-sm leading-relaxed line-clamp-2 md:line-clamp-3 mb-4 font-normal">
                                        {{ $item->resume ?? Str::limit(strip_tags($item->text), 160) }}
                                    </p>

                                    <a href="{{ route('site.post.show', $item->slug) }}"
                                        class="text-[10px] font-black text-[#00388d] uppercase tracking-widest hover:text-ueap-green transition-colors flex items-center gap-2 border-b-2 border-transparent hover:border-ueap-green pb-0.5">
                                        LER MATÉRIA
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="py-20 text-center bg-slate-50 border border-slate-200">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Nenhuma publicação
                                    encontrada</span>
                            </div>
                        @endforelse
                    </div>

                    @if ($posts->hasPages())
                        <div class="pt-16">
                            {{ $posts->links('novosite.components.post-paginator') }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4">
                    <div class="sticky top-28 space-y-12">
                        @include('novosite.components.sidebar-search')
                        @include('novosite.components.sidebar-categories', ['categories' => $categories])
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
