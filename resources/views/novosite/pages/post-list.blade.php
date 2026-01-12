@extends('novosite.template.master')

@section('title', 'Publicações - UEAP')

@section('content')
    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- ================= HEADER CYBER ================= --}}
    <header class="bg-slate-950 border-b border-white/5 relative overflow-hidden">
        {{-- Efeito de Background Sutil --}}
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <div class="max-w-4xl">
                {{-- Badge de Seção Estilo Terminal --}}
                <div class="flex items-center gap-3 mb-6">
                    <span
                        class="inline-flex items-center bg-emerald-500/10 text-emerald-400 text-[10px] font-black px-3 py-1 border border-emerald-500/20 uppercase tracking-[0.2em]">
                        <span class="w-1.5 h-1.5 bg-emerald-500 animate-pulse mr-2"></span>
                        Central de Conteúdo
                    </span>
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest">// UEAP_DATABASE</span>
                </div>

                {{-- Título da Página --}}
                <h1 class="text-4xl md:text-6xl font-black text-white leading-none tracking-tighter mb-4 italic uppercase">
                    Explorar<br class="hidden md:block"> <span class="text-emerald-500">Publicações</span>
                </h1>

                <div
                    class="flex flex-col gap-6 pt-6 md:flex-row md:items-center md:justify-between border-t border-white/5">
                    {{-- Breadcrumb Técnico --}}
                    <nav class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <a href="/"
                                class="text-[10px] font-mono uppercase text-slate-500 hover:text-emerald-400 transition-colors">Início</a>
                            <i class="fa-solid fa-chevron-right text-[8px] text-slate-700"></i>
                            <span class="text-[10px] font-mono uppercase text-slate-200">Listar_Publicações</span>
                        </div>
                    </nav>

                    {{-- Info Bar Estática (Substituindo o Share) --}}
                    <div
                        class="flex items-center gap-6 bg-emerald-500/5 px-4 py-2 border border-emerald-500/10 w-fit backdrop-blur-sm">
                        {{-- Status Ativo --}}
                        <div class="flex items-center gap-2">
                            <div class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </div>
                            <span
                                class="text-[9px] font-mono text-emerald-500/80 uppercase tracking-widest font-bold">Server_Online</span>
                        </div>

                        {{-- Divisor sutil --}}
                        <div class="h-3 w-px bg-white/10"></div>

                        {{-- Timestamp Estático/Referencial --}}
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-microchip text-slate-600 text-[10px]"></i>
                            <span class="text-[9px] font-mono text-slate-500 uppercase tracking-widest">DB_Ver_2.0.26</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="bg-white py-12 relative">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- Listagem de Conteúdo --}}
                <div class="lg:col-span-8">

                    @php
                        $currentType = request('type');
                        $types = [
                            ['label' => 'Notícias', 'value' => 'news', 'icon' => 'fa-newspaper'],
                            ['label' => 'Eventos', 'value' => 'event', 'icon' => 'fa-calendar-check'],
                            ['label' => 'Páginas', 'value' => 'page', 'icon' => 'fa-file-lines'],
                        ];
                    @endphp

                    <div class="mb-12">
                        {{-- 1. HEADER DE CONTEXTO PREMIUM --}}
                        @if (isset($searchString) && $searchString)
                            <div class="mb-8 relative pl-6 border-l-2 border-emerald-500">
                                <div class="flex items-center gap-3 mb-1">
                                    <span
                                        class="text-[9px] font-mono font-bold uppercase tracking-[0.4em] text-emerald-600 animate-pulse">
                                        Exibindo_Resultados_Para
                                    </span>
                                    <span class="hidden md:block h-px w-12 bg-slate-200"></span>
                                    <span class="text-[9px] font-mono text-slate-400 uppercase tracking-widest">
                                        {{ $posts->total() }} registros_encontrados
                                    </span>
                                </div>
                                <h1
                                    class="text-3xl md:text-5xl font-black text-slate-900 uppercase tracking-tighter leading-none italic break-words">
                                    <span class="text-slate-300 mr-2 font-light">"</span>{{ $searchString }}<span
                                        class="text-slate-300 ml-2 font-light">"</span>
                                </h1>
                            </div>
                        @endif

                        {{-- 2. CAIXA DE COMANDO (ATUALIZADA) --}}
                        <div class="relative group">
                            {{-- Detalhes de Canto --}}
                            <div
                                class="absolute -top-2 -left-2 w-4 h-4 border-t-2 border-l-2 border-slate-200 transition-colors group-focus-within:border-emerald-500 hidden md:block">
                            </div>
                            <div
                                class="absolute -bottom-2 -right-2 w-4 h-4 border-b-2 border-r-2 border-slate-200 transition-colors group-focus-within:border-emerald-500 hidden md:block">
                            </div>

                            {{-- Container Principal --}}
                            <div
                                class="bg-white border border-slate-200 p-1.5 flex flex-col md:flex-row items-stretch gap-1.5 shadow-sm group-focus-within:shadow-md transition-shadow duration-300">

                                {{-- Input Principal --}}
                                <form action="{{ route('site.post.list') }}" method="GET"
                                    class="flex-1 flex items-center bg-slate-50 px-4 py-3 md:py-4 relative overflow-hidden group/input border border-transparent focus-within:border-emerald-500/20 transition-all">

                                    @if ($currentType)
                                        <input type="hidden" name="type" value="{{ $currentType }}">
                                    @endif

                                    <div
                                        class="absolute top-0 left-0 w-1 h-full bg-emerald-500 scale-y-0 group-focus-within/input:scale-y-100 transition-transform duration-300">
                                    </div>

                                    <i class="fa-solid fa-terminal text-emerald-500 mr-4 text-xs"></i>

                                    <div class="flex-1 flex flex-col">
                                        <label
                                            class="text-[8px] font-mono font-bold text-slate-400 uppercase tracking-widest mb-0.5">Executar_Busca</label>
                                        <input type="text" name="search" value="{{ $searchString ?? '' }}"
                                            placeholder="O QUE VOCÊ PROCURA?"
                                            class="w-full bg-transparent text-sm focus:outline-none font-black text-slate-800 placeholder:text-slate-300 uppercase tracking-tight">
                                    </div>

                                    @if ($searchString)
                                        <a href="{{ route('site.post.list', request()->except('search')) }}"
                                            class="ml-4 text-slate-300 hover:text-red-500 transition-colors">
                                            <i class="fa-solid fa-circle-xmark text-sm"></i>
                                        </a>
                                    @endif
                                </form>

                                {{-- Filtros --}}
                                <div class="grid grid-cols-3 md:flex items-stretch gap-1">
                                    @foreach ($types as $type)
                                        @php
                                            $isActive = $currentType == $type['value'];
                                            $params = request()->query();
                                            if ($isActive) {
                                                unset($params['type']);
                                            } else {
                                                $params['type'] = $type['value'];
                                            }
                                        @endphp

                                        <a href="{{ route('site.post.list', $params) }}"
                                            class="relative flex flex-col items-center justify-center py-3 px-2 md:px-6 md:min-w-[100px] transition-all duration-300 group/btn
                {{ $isActive
                    ? 'bg-slate-900 text-white'
                    : 'bg-white text-slate-500 border border-slate-100 md:border-slate-200 hover:bg-emerald-50/50' }}">

                                            <i
                                                class="fa-solid {{ $type['icon'] }} text-[11px] mb-1.5 {{ $isActive ? 'text-emerald-400' : 'text-slate-400' }}"></i>
                                            <span
                                                class="text-[8px] md:text-[9px] font-black uppercase tracking-widest text-center">{{ $type['label'] }}</span>

                                            <div
                                                class="absolute top-0 inset-x-0 h-[2px] bg-emerald-500 transition-transform duration-300 {{ $isActive ? 'scale-x-100' : 'scale-x-0' }}">
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Footer de Status e Resultados --}}
                            <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-4 px-2">
                                <div class="flex items-center gap-4">
                                    {{-- Label Dinâmico de Resultados --}}
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">
                                        @if (request('type'))
                                            Exibindo <span class="text-emerald-600">{{ $posts->total() }}</span> resultados
                                            para {{ $currentType }}
                                        @elseif(request('search'))
                                            Exibindo <span class="text-emerald-600">{{ $posts->total() }}</span> resultados
                                            para "{{ request('search') }}"
                                        @else
                                            Status: <span class="text-emerald-500">Sistema_Ativo</span>
                                        @endif
                                    </p>

                                    <span class="hidden sm:block text-slate-200 text-xs">|</span>

                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">
                                        Total_Entradas: <span class="text-slate-900">{{ $posts->total() }}</span>
                                    </p>
                                </div>

                                @if (request()->anyFilled(['search', 'type']))
                                    <a href="{{ route('site.post.list') }}"
                                        class="group flex items-center gap-2 text-[9px] font-black text-red-500 uppercase tracking-widest">
                                        <span class="h-px w-4 bg-red-200 group-hover:w-6 transition-all"></span>
                                        Limpar_Filtros
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        @forelse ($posts as $item)
                            <article
                                class="group relative flex flex-col sm:flex-row gap-6 p-4 border border-transparent hover:border-slate-100 hover:bg-slate-50/50 transition-all duration-300">

                                {{-- Imagem com Frame Técnico --}}
                                <div class="relative shrink-0 w-full sm:w-64 h-44 overflow-hidden bg-slate-100">
                                    <div
                                        class="absolute inset-0 z-10 border-[10px] border-transparent group-hover:border-white/20 transition-all">
                                    </div>
                                    <a href="{{ route('site.post.show', $item->slug) }}" class="block h-full">
                                        <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}"
                                            alt="{{ $item->title }}"
                                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                                    </a>
                                    {{-- Data Overlay --}}
                                    <div
                                        class="absolute bottom-0 left-0 bg-slate-950 text-white font-mono text-[9px] px-2 py-1 z-20">
                                        {{ $item->created_at->format('d.M.Y') }}
                                    </div>
                                </div>

                                {{-- Conteúdo --}}
                                <div class="flex-1 min-w-0 py-2">
                                    <div class="flex items-center gap-3 mb-3">
                                        <span
                                            class="text-[9px] font-mono font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-2">
                                            // {{ $item->categories->first()->name ?? 'Geral' }}
                                        </span>
                                        <span class="h-px flex-1 bg-slate-100"></span>
                                    </div>

                                    <a href="{{ route('site.post.show', $item->slug) }}" class="block mb-3">
                                        <h2
                                            class="text-xl font-black text-slate-900 leading-tight group-hover:text-emerald-600 transition-colors uppercase tracking-tight italic">
                                            {{ $item->title }}
                                        </h2>
                                    </a>

                                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-2 mb-4 font-medium">
                                        {{ $item->resume ?? Str::limit(clean_text(html_entity_decode(strip_tags($item->text))), 120) }}
                                    </p>

                                    <a href="{{ route('site.post.show', $item->slug) }}"
                                        class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-slate-950 transition-all">
                                        READ_FULL_ACCESS
                                        <i
                                            class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-2"></i>
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="py-20 text-center border border-dashed border-slate-200 bg-slate-50/50">
                                <i class="fa-solid fa-box-open text-slate-200 text-4xl mb-4"></i>
                                <p class="text-slate-400 text-xs font-mono uppercase tracking-widest">Error 404:
                                    No_Data_Found</p>
                            </div>
                        @endforelse
                    </div>

                    @if ($posts->hasPages())
                        <div class="pt-12">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>

                {{-- Sidebar Futurista --}}
                <aside class="lg:col-span-4 space-y-8">
                    <div class="sticky top-8">
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
