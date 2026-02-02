@extends('novosite.template.master')

@section('title', 'Explorar Publicações - UEAP')

@section('content')
    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- ================= HEADER INDUSTRIAL ================= --}}
    <header class="relative bg-[#001030] py-14 lg:py-20 overflow-hidden border-b-[10px] border-[#a4ed4a]">
        {{-- Layer de Fundo --}}
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute -top-10 -right-20 text-[150px] lg:text-[220px] font-black leading-none select-none opacity-[0.05] uppercase tracking-tighter text-white whitespace-nowrap -rotate-12" style="-webkit-text-stroke: 3px white; color: transparent;">
                NEWS_
            </div>
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#a4ed4a 1.5px, transparent 1.5px); background-size: 32px 32px;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-5xl">
                <div class="flex items-center gap-4 mb-6">
                    <span class="bg-[#a4ed4a] text-[#001030] text-[10px] font-black px-4 py-1 uppercase tracking-widest shadow-[0_10px_30px_rgba(164,237,74,0.4)]">
                        CENTRAL DE CONTEÚDO
                    </span>
                    <span class="text-white/20 font-mono text-xs tracking-tighter uppercase">// UEAP_DATABASE_SYSTEM</span>
                </div>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[0.85] tracking-tighter uppercase italic mb-10">
                    EXPLORAR<br>
                    <span class="text-[#a4ed4a]">PUBLICAÇÕES</span>_
                </h1>

                {{-- Status Bar --}}
                <div class="flex flex-wrap items-center gap-6 pt-8 border-t border-white/10">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-[#a4ed4a] animate-pulse"></span>
                        <span class="text-[9px] font-black text-white/40 uppercase tracking-widest italic">Server: ONLINE</span>
                    </div>
                    <div class="text-[9px] font-black text-white/40 uppercase tracking-widest italic">
                        TOTAL_ENTRADAS: <span class="text-[#a4ed4a]">{{ $posts->total() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="bg-[#f8fafc] py-16">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- CAIXA DE BUSCA E FILTROS BRUTALISTA --}}
                    <div class="mb-12">
                        <div class="bg-white border-[4px] border-[#001030] shadow-[8px_8px_0px_0px_#001030] p-2">
                            <form action="{{ route('site.post.list') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                                @php $currentType = request('type'); @endphp
                                @if ($currentType) <input type="hidden" name="type" value="{{ $currentType }}"> @endif

                                {{-- Input Search --}}
                                <div class="flex-1 bg-slate-50 flex items-center px-4 py-3 border-2 border-transparent focus-within:border-[#0055ff] transition-all">
                                    <i class="fa-solid fa-search text-[#001030] mr-3 opacity-30"></i>
                                    <div class="flex-1">
                                        <label class="block text-[8px] font-black text-slate-400 uppercase mb-0.5">Query_Search</label>
                                        <input type="text" name="search" value="{{ $searchString ?? '' }}" 
                                            placeholder="BUSCAR NO REPOSITÓRIO..."
                                            class="w-full bg-transparent text-sm font-black text-[#001030] focus:outline-none placeholder:text-slate-300 uppercase">
                                    </div>
                                </div>

                                {{-- Tipos de Filtro --}}
                                <div class="flex gap-1">
                                    @foreach ([['label' => 'NEWS', 'val' => 'news'], ['label' => 'EVENTOS', 'val' => 'event']] as $t)
                                        <a href="{{ route('site.post.list', ['type' => $t['val']]) }}" 
                                           class="flex items-center px-6 py-3 text-[10px] font-black transition-all border-2 {{ request('type') == $t['val'] ? 'bg-[#001030] text-[#a4ed4a] border-[#001030]' : 'bg-white text-slate-400 border-slate-100 hover:border-[#001030] hover:text-[#001030]' }}">
                                            {{ $t['label'] }}
                                        </a>
                                    @endforeach
                                    <button type="submit" class="bg-[#a4ed4a] text-[#001030] px-6 py-3 text-[10px] font-black uppercase border-2 border-[#001030] hover:bg-[#001030] hover:text-[#a4ed4a] transition-all">
                                        BUSCAR_
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        @if(request()->anyFilled(['search', 'type']))
                            <div class="mt-4 flex justify-end">
                                <a href="{{ route('site.post.list') }}" class="text-[9px] font-black text-red-500 uppercase italic hover:underline">
                                    [X] RESET_FILTERS
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- LISTAGEM DE POSTS --}}
                    <div class="space-y-8">
                        @forelse ($posts as $item)
                            <article class="group bg-white border-[3px] border-[#001030] hover:shadow-[12px_12px_0px_0px_#a4ed4a] transition-all duration-300 overflow-hidden">
                                <div class="flex flex-col md:flex-row">
                                    {{-- Thumbnail --}}
                                    <div class="md:w-64 h-48 shrink-0 bg-[#001030] overflow-hidden relative">
                                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}" 
                                             class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-500 opacity-80 group-hover:opacity-100">
                                        <div class="absolute top-0 left-0 bg-[#a4ed4a] text-[#001030] font-black text-[9px] px-2 py-1 uppercase">
                                            {{ $item->created_at->format('d/m/y') }}
                                        </div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="p-6 flex-1 flex flex-col justify-between">
                                        <div>
                                            <span class="text-[9px] font-black text-[#0055ff] uppercase tracking-widest mb-2 block">
                                                // {{ $item->categories->first()->name ?? 'Geral' }}
                                            </span>
                                            <h3 class="text-xl font-black text-[#001030] uppercase italic leading-none mb-3 group-hover:text-[#0055ff] transition-colors">
                                                {{ $item->title }}
                                            </h3>
                                            {{-- Descrição em minúsculas para legibilidade --}}
                                            <p class="text-slate-600 text-sm leading-relaxed font-medium normal-case line-clamp-2">
                                                {{ $item->resume ?? Str::limit(strip_tags($item->text), 140) }}
                                            </p>
                                        </div>

                                        <div class="mt-4 pt-4 border-t border-slate-50 flex justify-between items-center">
                                            <a href="{{ route('site.post.show', $item->slug) }}" 
                                               class="text-[10px] font-black text-[#001030] uppercase tracking-widest flex items-center gap-2 group/link">
                                                LER_CONTEÚDO_COMPLETO
                                                <i class="fa-solid fa-arrow-right-long text-[#a4ed4a] group-hover/link:translate-x-2 transition-transform"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-20 text-center border-[4px] border-dashed border-slate-200 bg-white">
                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic">No_Records_Found_In_Database</span>
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
                    <div class="sticky top-8 space-y-8">
                        @include('novosite.components.sidebar-newsletter')
                        
                        {{-- Widget Estilizado --}}
                        <div class="bg-[#001030] border-l-[8px] border-[#a4ed4a] p-8">
                            <h4 class="text-white font-black uppercase italic tracking-tighter text-xl mb-4">CATEGORIAS_</h4>
                            @include('novosite.components.sidebar-categories', ['categories' => $categories])
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection