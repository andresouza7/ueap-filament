@extends('novosite.template.master')

@section('title', $page->title ?? (isset($page->slug) ? Str::headline($page->slug) : 'Página'))

@section('content')
    @php
        $url_atual = urlencode(url()->current());
    @endphp

    <div class="flex flex-col" x-data="{ open: false }">

        {{-- ================= HEADER ================= --}}
        <header class="bg-gray-50 border-b border-gray-200">
            <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                    <div class="w-full">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded uppercase">
                                {{ $page->category->name }}
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4">
                            {{ $page->title }}
                        </h1>

                        {{-- Grid de Metadados e Share: Alinhamento preciso --}}
                        <div
                            class="flex flex-col gap-4 text-sm text-gray-600 md:flex-row md:items-center md:justify-between">

                            <div class="flex flex-wrap items-center gap-6">
                                {{-- Data --}}
                                <div class="flex items-center gap-2 group">
                                    <i class="fa-regular fa-clock text-ueap-green"></i>
                                    <span class="text-gray-400">Atualizado:</span>
                                    <span
                                        class="font-semibold text-gray-800">{{ $page->updated_at->format('d/m/Y H:i') }}</span>
                                </div>

                                {{-- Views --}}
                                <div class="flex items-center gap-2 group">
                                    <i class="fa-solid fa-eye text-ueap-green"></i>
                                    <span class="text-gray-400">Leituras:</span>
                                    <span class="font-semibold text-gray-800">{{ $page->hits }}</span>
                                </div>
                            </div>

                            {{-- Compartilhamento: Botões Minimalistas --}}
                            <div class="flex items-center gap-3 pt-4 md:pt-0">
                                <span
                                    class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Compartilhar</span>

                                <div class="flex items-center gap-1">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white border border-gray-200 text-gray-400 hover:text-blue-600 hover:border-blue-600 hover:shadow-sm transition-all"
                                        aria-label="Facebook">
                                        <i class="fa-brands fa-facebook-f text-xs"></i>
                                    </a>

                                    <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white border border-gray-200 text-gray-400 hover:text-green-600 hover:border-green-600 hover:shadow-sm transition-all"
                                        aria-label="WhatsApp">
                                        <i class="fa-brands fa-whatsapp text-xs"></i>
                                    </a>

                                    <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white border border-gray-200 text-gray-400 hover:text-black hover:border-black hover:shadow-sm transition-all"
                                        aria-label="Twitter">
                                        <i class="fa-brands fa-x-twitter text-xs"></i>
                                    </a>
                                </div>
                            </div>

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
                    <main class="lg:col-span-9 space-y-16">
                        <article class="article-body prose max-w-none">

                            @foreach ($page->content ?? [] as $block)
                                @switch($block['type'])
                                    {{-- ===== TEXT ===== --}}
                                    @case('text')
                                        {!! clean_text($block['data']['body'] ?? '') !!}
                                    @break

                                    {{-- ===== IMAGE / GALLERY ===== --}}
                                    @case('image')
                                    @case('gallery')
                                        @php
                                            $mediaItems = $page->getMedia();
                                            $count = $mediaItems->count();
                                        @endphp

                                        @if ($count === 1)
                                            {{-- SINGLE IMAGE --}}
                                            <figure class="my-10">
                                                <div class="w-full max-w-3xl mx-auto">
                                                    <div class="aspect-video overflow-hidden rounded-xl shadow-lg">
                                                        <img src="{{ $mediaItems->first()->getUrl() }}" alt="{{ $page->title }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                </div>

                                                @if (!empty($block['data']['subtitle']))
                                                    <figcaption
                                                        class="text-sm text-gray-500 text-center italic mt-2 max-w-4xl mx-auto">
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
                                                                    <img src="{{ $media->getUrl() }}" alt="{{ $page->title }}"
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
                    </main>

                    {{-- ========== ASIDE ========= --}}
                    <aside class="hidden lg:block lg:col-span-3">
                        @if ($page->web_menu)
                            <nav class="sticky top-24 space-y-1">
                                @foreach (optional($page->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
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
                        @else
                            <div class="space-y-10 lg:pl-6">
                                {{-- 1. BUSCA --}}
                                <section>
                                    <div class="relative group">
                                        <input type="text" placeholder="O que você procura?"
                                            class="w-full bg-gray-50/50 border-b border-gray-200 py-3 px-2
                                    text-gray-800 placeholder:text-gray-400 focus:outline-none 
                                    focus:border-[#017D49] transition-all duration-500 text-base italic">
                                        <button
                                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#017D49] transition-colors">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </section>

                                {{-- 2. PÁGINAS RELACIONADAS --}}
                                <section>
                                    <div class="flex items-center gap-4 mb-6">
                                        <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-400">
                                            Páginas Frequentes
                                        </h3>
                                        <div class="h-[1px] flex-1 bg-gradient-to-r from-gray-100 to-transparent"></div>
                                    </div>

                                    <div class="flex flex-col">
                                        @php
                                            $paginasRelacionadas = [
                                                'Estrutura Organizacional',
                                                'Pró-Reitoria de Graduação',
                                                'Portal do Aluno (SIGAA)',
                                                'Biblioteca Central',
                                                'Núcleo de Acessibilidade',
                                            ];
                                        @endphp

                                        @foreach ($paginasRelacionadas as $pagina)
                                            <a href="#"
                                                class="group flex items-center gap-3 py-3 border-b border-gray-50 last:border-0">
                                                <span
                                                    class="w-1.5 h-1.5 rounded-full bg-gray-200 group-hover:bg-[#017D49] group-hover:scale-125 transition-all duration-300"></span>
                                                <span
                                                    class="text-sm font-semibold text-gray-600 group-hover:text-gray-900 transition-colors flex-1">
                                                    {{ $pagina }}
                                                </span>
                                                <i
                                                    class="fa-solid fa-arrow-right-long text-[10px] opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 group-hover:text-[#017D49] transition-all duration-300"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </section>

                                {{-- 3. CATEGORIAS RELACIONADAS --}}
                                <section>
                                    <div class="flex items-center gap-4 mb-6">
                                        <h3 class="text-[11px] font-black uppercase tracking-[0.2em] text-gray-400">
                                            Assuntos
                                        </h3>
                                        <div class="h-[1px] flex-1 bg-gradient-to-r from-gray-100 to-transparent"></div>
                                    </div>

                                    <div class="flex flex-wrap gap-2">
                                        @php
                                            $categoriasMock = [
                                                'Editais 2024',
                                                'Ensino',
                                                'Extensão',
                                                'Pesquisa',
                                                'Concursos',
                                                'Eventos',
                                                'Administração',
                                                'Projetos',
                                            ];
                                        @endphp
                                        @foreach ($categoriasMock as $categoria)
                                            <a href="#"
                                                class="px-3.5 py-2 bg-white border border-gray-200 rounded-full text-[11px] font-bold text-gray-500 hover:bg-[#017D49] hover:text-white hover:border-[#017D49] hover:shadow-md transition-all duration-300 uppercase tracking-tighter">
                                                {{ $categoria }}
                                            </a>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                        @endif
                    </aside>

                </div>
            </div>

            {{-- ========== BOTÃO FLUTUANTE MOBILE (Aparece no Scroll) ========= --}}
            <div x-show="true" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200" class="fixed bottom-13 right-3 z-50 lg:hidden"
                style="display: none;">
                <button @click="open = true"
                    class="flex items-center justify-center w-14 h-14 bg-gray-900 text-white rounded-full shadow-2xl ring-4 ring-white/10 active:scale-95 transition-all">
                    <i class="fa-solid fa-bars-staggered text-ueap-green text-xl"></i>
                </button>
            </div>

            {{-- ================= MOBILE ASIDE DRAWER ================= --}}
            <div x-show="open" x-transition:enter="transition duration-300 ease-out"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 z-[100] lg:hidden" style="display: none;">

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
                        @if ($page->web_menu)
                            <nav class="space-y-1">
                                @foreach (optional($page->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
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

    </div>
@endsection
