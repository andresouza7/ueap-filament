@extends('novosite.template.master')

@section('title', 'Notícias - UEAP')

@section('content')
    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- ================= HEADER ================= --}}
    <header class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <div class="w-full">
                    {{-- Badge de Seção --}}
                    <div class="flex items-center gap-2 mb-4">
                        <span
                            class="bg-ueap-green text-white text-[10px] font-black px-2.5 py-1 rounded uppercase tracking-wider">
                            Portal de Notícias
                        </span>
                    </div>

                    {{-- Título da Página --}}
                    <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight mb-6">
                        Todas as Notícias
                    </h1>

                    {{-- Info Bar --}}
                    <div
                        class="flex flex-col md:flex-row md:items-center justify-between gap-6 pt-6 border-t border-gray-200/60 text-sm">

                        {{-- Caminho / Breadcrumb Sutil --}}
                        <div class="flex items-center gap-2 text-gray-500">
                            <i class="fa-solid fa-house text-[10px] text-ueap-green"></i>
                            <span class="font-medium">Início</span>
                            <i class="fa-solid fa-chevron-right text-[8px] text-gray-300"></i>
                            <span class="text-gray-900 font-bold">Notícias</span>
                        </div>

                        {{-- Compartilhamento (Estilo Consolidado) --}}
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Compartilhar
                                página</span>

                            <div class="flex items-center gap-1.5">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-blue-600 hover:border-blue-600 transition-all shadow-sm">
                                    <i class="fa-brands fa-facebook-f text-xs"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-green-600 hover:border-green-600 transition-all shadow-sm">
                                    <i class="fa-brands fa-whatsapp text-xs"></i>
                                </a>

                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-black hover:border-black transition-all shadow-sm">
                                    <i class="fa-brands fa-x-twitter text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="bg-white py-10">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Listagem de Notícias --}}
                <div class="lg:col-span-8 space-y-6">

                    @forelse ($posts as $item)
                        <article class="group flex flex-row gap-5 items-start pb-6 border-b border-gray-100 last:border-0">

                            {{-- Imagem Otimizada: Menor e mais rápida de escanear --}}
                            <div class="shrink-0 w-28 h-24 sm:w-54 sm:h-40 overflow-hidden rounded-xl bg-gray-50">
                                <a href="{{ route('novosite.post.show', $item->slug) }}" class="block h-full">
                                    <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/400/300' }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                </a>
                            </div>

                            {{-- Conteúdo Compacto --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-ueap-green">
                                        {{ $item->category->name ?? 'Geral' }}
                                    </span>
                                    <span class="text-gray-300">•</span>
                                    <time class="text-[11px] font-medium text-gray-400">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </time>
                                </div>

                                <a href="{{ route('novosite.post.show', $item->slug) }}" class="block mb-2">
                                    <h2
                                        class="text-base sm:text-lg font-bold text-gray-900 leading-snug group-hover:text-ueap-green transition-colors line-clamp-2">
                                        {{ $item->title }}
                                    </h2>
                                </a>

                                {{-- Descrição mais curta para economizar espaço vertical --}}
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-3 hidden sm:block">
                                    {{ $item->description ?? Str::limit(strip_tags($item->text), 120) }}
                                </p>

                                <a href="{{ route('novosite.post.show', $item->slug) }}"
                                    class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-gray-400 group-hover:text-ueap-green transition-all">
                                    Ler mais
                                    <i
                                        class="fa-solid fa-chevron-right text-[9px] transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </article>

                    @empty
                        <div class="py-12 text-center border-2 border-dashed border-gray-100 rounded-2xl">
                            <p class="text-gray-400 text-sm font-medium">Nenhuma notícia encontrada.</p>
                        </div>
                    @endforelse

                    {{-- Paginação mais discreta --}}
                    @if ($posts->hasPages())
                        <div class="pt-4">
                            {{ $posts->links() }}
                        </div>
                    @endif

                </div>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4 space-y-8">

                    {{-- Busca - Minimalista --}}
                    <section>
                        <div class="group relative">
                            <input type="text" placeholder="Buscar no portal..."
                                class="w-full bg-transparent border-b-2 border-gray-100 py-2 pl-0 pr-8
                       text-gray-800 placeholder:text-gray-400 focus:outline-none 
                       focus:border-ueap-green transition-all duration-300 text-lg">
                            <button
                                class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-ueap-green">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </section>

                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500">
                                Mais Visualizadas
                            </h3>
                            <div class="h-px flex-1 bg-gray-100 mx-4"></div>
                            <a href="{{ route('novosite.post.list') }}"
                                class="text-xs font-bold text-ueap-green hover:opacity-70">
                                Ver tudo
                            </a>
                        </div>

                        <section class="bg-[#f8f9fa] p-8 rounded-sm border-l-4 border-ueap-green">
                            <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">Newsletter</h3>
                            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                                Receba uma curadoria semanal das atividades acadêmicas.
                            </p>

                            <form class="flex flex-col gap-3">
                                <input type="email" placeholder="E-mail acadêmico ou pessoal"
                                    class="w-full bg-white border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 transition">

                                <button type="submit"
                                    class="w-full bg-gray-900 text-white py-3 text-xs font-bold uppercase tracking-widest hover:bg-ueap-green transition-colors cursor-pointer">
                                    Assinar agora
                                </button>
                            </form>
                        </section>
                    </div>

                </aside>
            </div>
        </div>
    </main>

@endsection
