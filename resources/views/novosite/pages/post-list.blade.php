@extends('novosite.template.master')

@section('title', 'Publicações - UEAP')

@section('content')
    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- ================= HEADER ================= --}}
    <header class="bg-white border-b border-gray-100">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="max-w-4xl">

                {{-- Badge de Seção Estilo Pill --}}
                <div class="flex items-center gap-3 mb-6">
                    <span
                        class="inline-flex items-center bg-[#017D49]/5 text-[#017D49] text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest">
                        Central de Conteúdo
                    </span>
                    <span class="h-px w-8 bg-gray-200"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Ueap</span>
                </div>

                {{-- Título da Página --}}
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-[1.15] md:leading-[1.1] tracking-tight mb-1">
                    Explorar Publicações
                </h1>

                {{-- Info Bar: Breadcrumb e Share --}}
                <div class="flex flex-col gap-6 pt-6 md:flex-row md:items-center md:justify-between">

                    {{-- Breadcrumb Sutil --}}
                    <nav class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-[#017D49]">
                            <i class="fa-solid fa-house text-xs"></i>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="/"
                                class="text-[11px] font-bold uppercase tracking-tight text-gray-400 hover:text-[#017D49] transition-colors">Início</a>
                            <i class="fa-solid fa-chevron-right text-[8px] text-gray-300"></i>
                            <span class="text-[11px] font-bold uppercase tracking-tight text-gray-900">Publicações</span>
                        </div>
                    </nav>

                    {{-- Social Share --}}
                    <div class="flex items-center gap-4 bg-gray-50/50 p-1.5 pr-4 rounded-full border border-gray-100 w-fit">
                        <div class="flex items-center -space-x-1">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-blue-600 hover:shadow-md transition-all border border-gray-100">
                                <i class="fa-brands fa-facebook-f text-xs"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-green-600 hover:shadow-md transition-all border border-gray-100">
                                <i class="fa-brands fa-whatsapp text-xs"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-black hover:shadow-md transition-all border border-gray-100">
                                <i class="fa-brands fa-x-twitter text-xs"></i>
                            </a>
                        </div>
                        <span
                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-2">Compartilhar</span>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <main class="bg-white py-10">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Listagem de Conteúdo --}}
                <div class="lg:col-span-8 space-y-4 sm:space-y-6">

                    @php
                        $currentType = request('type');
                        $types = [
                            ['label' => 'Notícias', 'value' => 'news', 'icon' => 'fa-newspaper'],
                            ['label' => 'Eventos', 'value' => 'event', 'icon' => 'fa-calendar-check'],
                            ['label' => 'Páginas', 'value' => 'page', 'icon' => 'fa-file-lines'],
                        ];
                    @endphp

                    <div class="mb-12">
                        {{-- Header de Contexto --}}
                        @if (isset($searchString) && $searchString)
                            <div class="mb-6">
                                {{-- Rótulo de Contexto --}}
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="h-[2px] w-4 bg-[#017D49]"></span>
                                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">
                                        Resultados Para
                                    </span>
                                </div>

                                {{-- Título de Busca Estilizado --}}
                                <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter leading-none">
                                    <span class="text-gray-300">"</span>{{ $searchString }}<span
                                        class="text-gray-300">"</span>
                                </h1>
                            </div>
                        @endif

                        {{-- Caixa de Comando Integrada --}}
                        <div class="bg-gray-50 p-1 border border-gray-100 flex flex-col md:flex-row items-stretch gap-1">

                            {{-- Input de Busca Principal --}}
                            <form action="{{ route('site.post.list') }}" method="GET"
                                class="flex-1 flex items-center bg-white border border-gray-100 px-4 py-3">
                                {{-- Preserva o Tipo se já estiver selecionado --}}
                                @if ($currentType)
                                    <input type="hidden" name="type" value="{{ $currentType }}">
                                @endif

                                <i class="fa-solid fa-magnifying-glass text-gray-300 mr-3 text-xs"></i>
                                <input type="text" name="search" value="{{ $searchString ?? '' }}"
                                    placeholder="Refinar busca atual..."
                                    class="w-full bg-transparent text-sm focus:outline-none font-medium placeholder:text-gray-300 italic">

                                @if ($searchString)
                                    <a href="{{ route('site.post.list', request()->except('search')) }}"
                                        class="text-gray-300 hover:text-red-500 transition-colors">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </a>
                                @endif
                            </form>

                            {{-- Filtros de Tipo Integrados (Empilháveis) --}}
                            <div class="flex items-stretch gap-1">
                                @foreach ($types as $type)
                                    @php
                                        $isActive = $currentType == $type['value'];
                                        // Lógica de Toggle: se clicar no ativo, remove o filtro
                                        $params = request()->query();
                                        if ($isActive) {
                                            unset($params['type']);
                                        } else {
                                            $params['type'] = $type['value'];
                                        }
                                    @endphp

                                    <a href="{{ route('site.post.list', $params) }}"
                                        class="flex items-center gap-2 px-5 py-3 transition-all duration-300 whitespace-nowrap
                   {{ $isActive
                       ? 'bg-gray-900 text-white shadow-inner'
                       : 'bg-white text-gray-500 hover:text-gray-900 border border-gray-100' }}">
                                        <i
                                            class="fa-solid {{ $type['icon'] }} text-[10px] {{ $isActive ? 'text-ueap-green' : 'opacity-30' }}"></i>
                                        <span
                                            class="text-[11px] font-black uppercase tracking-tighter italic">{{ $type['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Footer de Status --}}
                        <div class="mt-4 flex items-center justify-between px-1">
                            <p class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">
                                Exibindo <span class="text-gray-900">{{ $posts->total() }}</span> registros
                                @if ($currentType)
                                    para <span class="text-[#017D49]">{{ ucfirst($currentType) }}</span>
                                @endif
                            </p>

                            @if (request()->anyFilled(['search', 'type', 'category']))
                                <a href="{{ route('site.post.list') }}"
                                    class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:underline">
                                    Limpar todos os filtros ×
                                </a>
                            @endif
                        </div>
                    </div>

                    @forelse ($posts as $item)
                        <article
                            class="group flex flex-row gap-4 sm:gap-5 items-start pb-4 sm:pb-6 border-b border-gray-100 last:border-0">

                            {{-- Imagem --}}
                            <div class="shrink-0 w-24 h-20 sm:w-54 sm:h-40 overflow-hidden rounded-xl bg-gray-50">
                                <a href="{{ route('site.post.show', $item->slug) }}" class="block h-full">
                                    <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/400/300' }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </a>
                            </div>

                            {{-- Conteúdo --}}
                            <div class="flex-1 min-w-0">
                                {{-- Meta: Categoria/Data (Esquerda) e Tipo (Direita) --}}
                                <div class="flex items-center justify-between gap-2 mb-1 w-full">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-[9px] sm:text-[10px] font-black uppercase tracking-widest text-ueap-green">
                                            {{ $item->categories->first()->name ?? 'Geral' }}
                                        </span>
                                        <span class="text-gray-300">•</span>
                                        <time class="text-[10px] sm:text-[11px] font-medium text-gray-400">
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </time>
                                    </div>

                                    {{-- @if ($item->type)
                                        <span
                                            class="px-1.5 py-0.5 rounded bg-gray-100 text-gray-500 text-[8px] sm:text-[9px] font-bold uppercase border border-gray-200">
                                            {{ $item->type }}
                                        </span>
                                    @endif --}}
                                </div>

                                <a href="{{ route('site.post.show', $item->slug) }}" class="block mb-1.5 sm:mb-2">
                                    <h2
                                        class="text-sm sm:text-lg font-bold text-gray-900 leading-snug group-hover:text-ueap-green transition-colors line-clamp-2">
                                        {{ $item->title }}
                                    </h2>
                                </a>

                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-3 hidden sm:block">
                                    {{ $item->resume ?? Str::limit(clean_text(html_entity_decode(strip_tags($item->text))), 120) }}
                                </p>

                                <a href="{{ route('site.post.show', $item->slug) }}"
                                    class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-gray-400 group-hover:text-ueap-green transition-all">
                                    Ler Mais
                                    <i
                                        class="fa-solid fa-chevron-right text-[8px] sm:text-[9px] transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </article>

                    @empty
                        <div class="py-12 text-center border-2 border-dashed border-gray-100 rounded-2xl">
                            <p class="text-gray-400 text-sm font-medium">Nenhum conteúdo encontrado.</p>
                        </div>
                    @endforelse

                    @if ($posts->hasPages())
                        <div class="pt-4">
                            {{ $posts->links() }}
                        </div>
                    @endif

                </div>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4 space-y-8">
                    @include('novosite.components.sidebar-newsletter')
                </aside>
            </div>
        </div>
    </main>

@endsection
