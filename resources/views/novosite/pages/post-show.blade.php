@extends('novosite.template.master')

@section('title', isset($post->title) ? $post->title : (isset($post->slug) ? str_replace('-', ' ', ucfirst($post->slug))
    : 'Notícia'))

@section('content')

    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- ================= HEADER ================= --}}
    <header class="bg-white border-b border-gray-100">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="max-w-4xl"> {{-- Limitador para melhor leitura do título --}}

                {{-- Breadcrumb / Categoria --}}
                <div class="flex items-center gap-3 mb-6">
                    <a href="{{ route('site.post.list', ['category' => $post->category->slug]) }}"
                        class="inline-flex items-center bg-[#017D49]/5 text-[#017D49] text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest hover:bg-[#017D49] hover:text-white transition-all duration-300">
                        {{ $post->category->name }}
                    </a>
                    <span class="h-px w-8 bg-gray-200"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $post->type }}</span>
                </div>

                {{-- Título Principal --}}
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-[1.15] md:leading-[1.1] tracking-tight mb-1">
                    {{ $post->title }}
                </h1>

                {{-- Info Bar: Metadados e Share --}}
                <div class="flex flex-col gap-6 pt-6 md:flex-row md:items-center md:justify-between">

                    {{-- Autor e Info --}}
                    <div class="flex flex-wrap items-center gap-y-4 gap-x-8">
                        {{-- Data de Publicação --}}
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-[#017D49]">
                                <i class="fa-regular fa-calendar-check text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <span
                                    class="text-[10px] leading-none text-gray-400 uppercase font-bold tracking-tight">Publicado
                                    em</span>
                                <span class="text-sm font-semibold text-gray-700">
                                    {{ $post->created_at->translatedFormat('d M, Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Leituras --}}
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">
                                <i class="fa-solid fa-chart-line text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <span
                                    class="text-[10px] leading-none text-gray-400 uppercase font-bold tracking-tight">Engajamento</span>
                                <span class="text-sm font-semibold text-gray-700">{{ $post->hits }} leituras</span>
                            </div>
                        </div>
                    </div>

                    {{-- Social Share - Estilo Floating Pill --}}
                    <div class="flex items-center gap-4 bg-gray-50/50 p-1.5 pr-4 rounded-full border border-gray-100 w-fit">
                        <div class="flex items-center -space-x-1">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-blue-600 hover:shadow-md transition-all border border-gray-100"
                                aria-label="Facebook">
                                <i class="fa-brands fa-facebook-f text-xs"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-white text-gray-500 hover:text-green-600 hover:shadow-md transition-all border border-gray-100"
                                aria-label="WhatsApp">
                                <i class="fa-brands fa-whatsapp text-xs"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" target="_blank"
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

    {{-- ================= CONTENT ================= --}}
    <section x-data="{ open: false }" class="w-full py-8 border-b border-gray-200">
        <div class="max-w-[1290px] mx-auto space-y-12 px-4 sm:px-6 lg:px-8 xl:px-0">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- ========== MAIN ========= --}}
                <main class="lg:col-span-8 space-y-16">
                    <article class="article-body prose max-w-none">

                        @foreach ($post->content ?? [] as $block)
                            @switch($block['type'])
                                {{-- ===== TEXT ===== --}}
                                @case('text')
                                    {!! clean_text($block['data']['body'] ?? '') !!}
                                @break

                                {{-- ===== IMAGE / GALLERY ===== --}}
                                @case('image')
                                @case('gallery')
                                    @php
                                        $mediaItems = $post->getMedia();
                                        $count = $mediaItems->count();
                                    @endphp

                                    @if ($count === 1)
                                        {{-- SINGLE IMAGE --}}
                                        <figure class="my-10">
                                            <div class="w-full max-w-3xl mx-auto">
                                                <div class="aspect-video overflow-hidden rounded-xl shadow-lg">
                                                    <img src="{{ $mediaItems->first()->getUrl() }}" alt="{{ $post->title }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            </div>

                                            @if (!empty($block['data']['subtitle']))
                                                <figcaption class="text-sm text-gray-500 text-center italic mt-2 max-w-4xl mx-auto">
                                                    {{ $block['data']['subtitle'] }}
                                                    @isset($block['data']['credits'])
                                                        — {{ $block['data']['credits'] }}
                                                    @endisset
                                                </figcaption>
                                            @endif
                                        </figure>
                                    @elseif ($count > 1)
                                        {{-- CAROUSEL --}}
                                        <section class="my-12">
                                            <div class="relative max-w-5xl mx-auto">
                                                <div
                                                    class="flex gap-4 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-4 -mx-2 px-2">
                                                    @foreach ($mediaItems as $media)
                                                        <div class="snap-center shrink-0 w-[85%] sm:w-[70%] lg:w-[60%]">
                                                            <div class="aspect-video overflow-hidden rounded-xl shadow-lg">
                                                                <img src="{{ $media->getUrl() }}" alt="{{ $post->title }}"
                                                                    class="w-full h-full object-cover">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="flex justify-center gap-2 mt-3">
                                                @foreach ($mediaItems as $_)
                                                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                                                @endforeach
                                            </div>

                                            @isset($block['data']['credits'])
                                                <p class="text-sm text-gray-500 text-center italic mt-3 max-w-5xl mx-auto">
                                                    {{ $block['data']['credits'] }}
                                                </p>
                                            @endisset
                                        </section>
                                    @endif
                                @break
                            @endswitch
                        @endforeach

                    </article>

                    @include('novosite.components.related-posts', ['posts' => $relatedPosts])
                </main>

                {{-- ========== ASIDE ========= --}}
                <aside class="hidden lg:block lg:col-span-4">
                    @if ($post->web_menu)
                        <nav class="sticky top-24 lg:pl-8">
                            <div class="flex flex-col mb-4">
                                <span
                                    class="text-[9px] font-black uppercase tracking-[0.2em] text-[#017D49] mb-1">Navegação</span>
                                <div class="h-[2px] w-6 bg-gray-900"></div>
                            </div>

                            <div class="flex flex-col space-y-[1px] max-w-[240px]">
                                @foreach (optional($post->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                                    @php $isActive = request()->url() == $item->url; @endphp

                                    <a href="{{ $item->url }}"
                                        class="group flex items-center justify-between px-3 py-1.5 rounded-md transition-all duration-200
                {{ $isActive ? 'bg-gray-900 text-white shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">

                                        <span class="text-[12.5px] font-bold tracking-tight z-10">
                                            {{ $item->name }}
                                        </span>

                                        @if ($isActive)
                                            <span class="h-1.5 w-1.5 rounded-full bg-ueap-green"></span>
                                        @else
                                            <i
                                                class="fa-solid fa-chevron-right text-[8px] opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 transition-all"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </nav>
                    @else
                        <div class="space-y-8 lg:pl-6">
                            {{-- 1. BUSCA --}}
                            @include('novosite.components.sidebar-search')

                            {{-- 2. MAIS VISUALIZADAS --}}
                            @include('novosite.components.sidebar-news', ['posts' => $latestPosts])

                            {{-- 3. NEWSLETTER --}}
                            @include('novosite.components.sidebar-newsletter')

                            {{-- 4. PÁGINAS FREQUENTES --}}
                            @include('novosite.components.sidebar-pages', ['pages' => $frequentPages])

                            {{-- 5. ASSUNTOS (CATEGORIAS) --}}
                            @include('novosite.components.sidebar-categories', [
                                'categories' => $topCategories,
                            ])
                        </div>
                    @endif
                </aside>

            </div>
        </div>

        {{-- ========== BOTÃO FLUTUANTE MOBILE (Aparece no Scroll) ========= --}}
        <div x-show="true" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" class="fixed bottom-8 right-6 z-50 lg:hidden"
            style="display: none;">
            <button @click="open = true"
                class="flex items-center justify-center w-14 h-14 bg-gray-900 text-white rounded-full shadow-2xl ring-4 ring-white/10 active:scale-95 transition-all">
                <i class="fa-solid fa-bars-staggered text-ueap-green text-xl"></i>
            </button>
        </div>

        {{-- ================= MOBILE ASIDE DRAWER ================= --}}
        <div x-show="open" x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition duration-200 ease-in"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] lg:hidden" style="display: none;">

            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="open = false"></div>

            {{-- Painel do Drawer --}}
            <div x-show="open" x-transition:enter="transition duration-500 cubic-bezier(0.4, 0, 0.2, 1)"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition duration-400 ease-in-out" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="absolute right-0 top-0 h-full w-[85%] max-w-xs bg-white shadow-2xl flex flex-col">

                {{-- Header do Drawer --}}
                <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <div>
                        <h3 class="font-black text-gray-900 uppercase tracking-tighter text-lg">Navegação</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Menu da página</p>
                    </div>
                    <button @click="open = false"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                {{-- Conteúdo do Drawer --}}
                <div class="flex-1 overflow-y-auto p-4">
                    @if ($post->web_menu)
                        <nav class="space-y-1">
                            @foreach (optional($post->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                                <a href="{{ $item->url }}"
                                    class="group flex items-center px-3 py-2 text-sm font-medium
                                text-ueap-green bg-green-50
                                hover:bg-gray-50 hover:text-gray-900
                                border-l-4 border-ueap-green hover:border-gray-300
                                rounded-r-md">
                                    {{ $item->name }}
                                </a>
                            @endforeach
                        </nav>
                    @endif

                    <div class="mt-10 pt-10 border-t border-gray-100">
                        <p class="text-[10px] text-center text-gray-400 font-medium uppercase tracking-widest">
                            Universidade do Estado do Amapá
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
