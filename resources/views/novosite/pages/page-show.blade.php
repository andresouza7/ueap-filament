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
        <section class="w-full py-8 border-b border-gray-200">
            <div class="max-w-[1290px] mx-auto space-y-12 px-4 sm:px-6 lg:px-8 xl:px-0">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                    {{-- ========== MAIN ========= --}}
                    <main class="lg:col-span-9 space-y-16">
                        <article class="article-body prose max-w-none">

                            {{-- Mobile Aside Toggle --}}
                            <div class="mt-6 flex justify-end lg:hidden">
                                <button @click="open = true"
                                    class="
               px-4 py-2
               border border-gray-300
               bg-white
               text-gray-700 text-sm font-medium
               shadow-sm
               hover:bg-gray-50
               active:scale-95
               transition">
                                    Menu da Página
                                </button>
                            </div>

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

                        @endif
                    </aside>

                </div>
            </div>

            {{-- ================= MOBILE ASIDE DRAWER ================= --}}
            <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 lg:hidden">

                {{-- Backdrop --}}
                <div class="absolute inset-0 bg-black/40" @click="open = false">
                </div>

                {{-- Drawer --}}
                <aside x-transition:enter="transform transition ease-out duration-300"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="absolute right-0 top-0 h-full w-[85%] max-w-sm
               bg-white shadow-xl p-6 overflow-y-auto">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-lg">Navegação</h3>
                        <button @click="open = false" class="text-gray-500">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>

                    {{-- Menu --}}
                    @if ($page->web_menu)
                        <nav class="space-y-2">
                            @foreach (optional($page->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                                <a href="{{ $item->url }}"
                                    class="block px-3 py-2 text-sm font-medium
                              text-ueap-green bg-green-50
                              hover:bg-gray-100 border-l-4 border-ueap-green">
                                    {{ $item->name }}
                                </a>
                            @endforeach
                        </nav>
                    @endif

                </aside>
            </div>

        </section>

    </div>
@endsection
