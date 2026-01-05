@extends('novosite.template.master')

@section('title', $page->title ?? (isset($page->slug) ? Str::headline($page->slug) : 'Página'))

@section('content')
    <div class="flex flex-col">

        {{-- ================= HEADER ================= --}}
        <header class="bg-gray-50 border-b border-gray-200">
            <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded uppercase">
                                {{ $page->category->name }}
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4">
                            {{ $page->title }}
                        </h1>

                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fa-solid fa-location-dot w-5 mr-2 text-ueap-green"></i>
                                <span class="font-semibold mr-1">Local:</span>
                                Campus I, Bloco Administrativo, 2º Andar
                            </div>

                            <div class="flex items-center">
                                <i class="fa-solid fa-envelope w-5 mr-2 text-ueap-green"></i>
                                <span class="font-semibold mr-1">Email:</span>
                                proext@ueap.edu.br
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        {{-- ================= CONTENT ================= --}}
        <section class="w-full py-8 border-b border-gray-200">
            <div class="max-w-[1290px] mx-auto space-y-12 p-4 md:p-0">

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
                    </aside>

                </div>
            </div>
        </section>

    </div>
@endsection
