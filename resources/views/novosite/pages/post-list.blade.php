@extends('novosite.template.master')

@section('title', 'Notícias - UEAP')

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
                        Portal de Notícias
                    </span>
                    <span class="h-px w-8 bg-gray-200"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Ueap</span>
                </div>

                {{-- Título da Página --}}
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-[1.15] md:leading-[1.1] tracking-tight mb-1">
                    Explorar Notícias
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
                            <span class="text-[11px] font-bold uppercase tracking-tight text-gray-900">Notícias</span>
                        </div>
                    </nav>

                    {{-- Social Share - Estilo Floating Pill (Igual ao post) --}}
                    <div class="flex items-center gap-4 bg-gray-50/50 p-1.5 pr-4 rounded-full border border-gray-100 w-fit">
                        <div class="flex items-center -space-x-1">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-blue-600 hover:shadow-md transition-all border border-gray-100"
                                aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f text-xs"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-green-600 hover:shadow-md transition-all border border-gray-100"
                                aria-label="WhatsApp">
                                <i class="fa-brands fa-whatsapp text-xs"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-black hover:shadow-md transition-all border border-gray-100"
                                aria-label="Twitter">
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

                {{-- Listagem de Notícias --}}
<div class="lg:col-span-8 space-y-4 sm:space-y-6">

    @forelse ($posts as $item)
        {{-- Reduzi o padding bottom (pb-4) e gap no mobile --}}
        <article class="group flex flex-row gap-4 sm:gap-5 items-start pb-4 sm:pb-6 border-b border-gray-100 last:border-0">

            {{-- Imagem Otimizada: Reduzi de w-28 para w-24 no mobile --}}
            <div class="shrink-0 w-24 h-20 sm:w-54 sm:h-40 overflow-hidden rounded-xl bg-gray-50">
                <a href="{{ route('novosite.post.show', $item->slug) }}" class="block h-full">
                    <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/400/300' }}"
                        alt="{{ $item->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </a>
            </div>

            {{-- Conteúdo Compacto --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    {{-- Fontes ligeiramente menores no mobile (text-[9px]) --}}
                    <span class="text-[9px] sm:text-[10px] font-black uppercase tracking-widest text-ueap-green">
                        {{ $item->category->name ?? 'Geral' }}
                    </span>
                    <span class="text-gray-300">•</span>
                    <time class="text-[10px] sm:text-[11px] font-medium text-gray-400">
                        {{ $item->created_at->format('d/m/Y') }}
                    </time>
                </div>

                <a href="{{ route('novosite.post.show', $item->slug) }}" class="block mb-1.5 sm:mb-2">
                    {{-- Título reduzido para text-sm no mobile --}}
                    <h2 class="text-sm sm:text-lg font-bold text-gray-900 leading-snug group-hover:text-ueap-green transition-colors line-clamp-2">
                        {{ $item->title }}
                    </h2>
                </a>

                {{-- Descrição oculta no mobile conforme solicitado pelo design compacto --}}
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-3 hidden sm:block">
                    {{ $item->description ?? Str::limit(strip_tags($item->text), 120) }}
                </p>

                <a href="{{ route('novosite.post.show', $item->slug) }}"
                    class="inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-gray-400 group-hover:text-ueap-green transition-all">
                    Ler mais
                    <i class="fa-solid fa-chevron-right text-[8px] sm:text-[9px] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </article>

    @empty
        <div class="py-12 text-center border-2 border-dashed border-gray-100 rounded-2xl">
            <p class="text-gray-400 text-sm font-medium">Nenhuma notícia encontrada.</p>
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
