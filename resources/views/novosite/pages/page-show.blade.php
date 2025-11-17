@extends('novosite.template.master')

@section('title', isset($page->title) ? $page->title : (isset($page->slug) ? str_replace('-', ' ', ucfirst($page->slug))
    : 'Página'))

@section('content')
    <div class="flex flex-col">
        {{-- Recomendo mover estas tags para <head> do master para evitar repetição --}}
        <link
            href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;700;1,400&family=Inter:400,600,700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">

        {{-- Topo branco: somente breadcrumb --}}
        <section class="w-full py-8 border-b border-gray-200">
            <div class="max-w-[1290px] mx-auto px-4">
                <nav class="text-sm mb-3 overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
                    <a href="{{ url('/') }}" class="hover:underline">Início</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('novosite.home') }}" class="hover:underline">Página</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-600">{{ $page->slug }}</span>
                </nav>

                <header class="mb-4">
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight">
                        {{ isset($page->title) ? $page->title : (isset($page->slug) ? str_replace('-', ' ', ucfirst($page->slug)) : 'Página') }}
                    </h1>

                    <div class="mt-3 text-sm text-gray-500 flex flex-wrap gap-4 items-center">
                        <span>Autor: <strong
                                class="text-gray-700">{{ $page->user_created->login ?? 'Desconhecido' }}</strong></span>
                        <span>•</span>
                        <span>Última modificação: <strong
                                class="text-gray-700">{{ optional($page->updated_at)->format('d/m/Y H:i') ?? '—' }}</strong></span>
                        <span>•</span>
                        <span>Visualizações: <strong
                                class="text-gray-700">{{ number_format($page->hits ?? 0, 0, ',', '.') }}</strong></span>
                        <span class="hidden sm:inline">•</span>
                        <span class="text-gray-400">slug: <code
                                class="bg-gray-100 px-2 py-0.5 rounded">{{ $page->slug }}</code></span>
                    </div>
                </header>

                <div class="flex items-center gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-slate-100 bg-white shadow-md text-slate-900 no-underline"
                        target="_blank" rel="noopener" aria-label="Compartilhar no Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($page->title ?? $page->slug) }}"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-slate-100 bg-white shadow-md text-slate-900 no-underline"
                        target="_blank" rel="noopener" aria-label="Compartilhar no Twitter">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode(($page->title ?? $page->slug) . ' ' . request()->fullUrl()) }}"
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-slate-100 bg-white shadow-md text-slate-900 no-underline md:hidden"
                        target="_blank" rel="noopener" aria-label="Compartilhar no WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>


                </div>
            </div>
        </section>

        {{-- Conteúdo: artigo --}}
        <section class="relative w-full py-10">
            <div class="pointer-events-none absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-green-50 to-white z-10">
            </div>

            <div class="relative z-10 max-w-[1290px] mx-auto px-4 font-inter text-slate-900 @if ($page->web_menu) grid lg:grid-cols-3 gap-8 @endif">
                {{-- Artigo --}}
                <article class="@if ($page->web_menu) lg:col-span-2 @endif font-merriweather leading-loose text-[1.03rem] text-slate-900 bg-white p-2 md:p-0 overflow-hidden">
                    <div class="p-2">
                        @if ($page->image_url)
                            <div class="flex justify-center">
                                <img src="{{ $page->image_url }}" class="w-full h-auto" alt="{{ $page->title }}">
                            </div>
                            <hr />
                        @endif

                        {!! clean_text($page->text) !!}
                    </div>

                    <hr />

                    <div>
                        Última Modificação em :
                        @if ($page->updated_at)
                            {{ $page->updated_at->format('d/m/Y H:i:s') }}
                        @else
                            {{ $page->created_at->format('d/m/Y H:i:s') }}
                        @endif
                    </div>
                </article>

                @if ($page->web_menu)
                    {{-- Menu lateral --}}
                    <aside class="lg:col-span-1">
                        <div class="top-4 bg-white p-5 shadow-sm rounded-none border border-transparent">
                            {{-- título com micro-accento --}}
                            <div class="mb-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="h-1 w-10 bg-emerald-600 rounded-sm" aria-hidden="true"></div>
                                    <span class="uppercase tracking-wide text-xs text-slate-600 font-semibold">
                                        {{ $page->web_menu->name }}
                                    </span>
                                </div>
                            </div>

                            {{-- nav --}}
                            <nav aria-label="Menu lateral" class="w-full">
                                <ul class="flex flex-col gap-1">
                                    @foreach ($page->web_menu->items->where('menu_parent_id', null)->where('status', 'published')->sortBy('position') as $item)
                                        @php
                                            $isActive = url()->current() === url($item->url);
                                        @endphp
                                        <li>
                                            <a
                                                href="{{ $item->url }}"
                                                class="group flex items-center justify-between w-full px-3 py-2 text-sm transition 
                                                    {{ $isActive ? 'bg-gray-100 text-slate-900 font-semibold' : 'text-slate-700 hover:bg-gray-50 hover:text-slate-900' }}
                                                    rounded-none"
                                                aria-current="{{ $isActive ? 'page' : '' }}">
                                                <span class="truncate">{{ $item->name }}</span>
                                                <i class="fa-solid fa-chevron-right text-xs text-slate-400 group-hover:text-slate-500" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </aside>
                @endif

                {{-- Ações secundárias (mobile) --}}
                <div class="mt-6
                    flex items-center justify-between gap-4 @if ($page->web_menu) lg:col-span-3 @endif">
                    <a href="{{ route('novosite.home') }}"
                        class="inline-flex items-center gap-3 bg-gradient-to-b from-slate-50 to-slate-100 border border-gray-300 px-3 py-2 rounded-lg font-semibold text-slate-900 no-underline md:hidden"
                        aria-label="Voltar às páginas">
                        <i class="fa-solid fa-arrow-left w-4 text-center"></i>
                        <span>Voltar</span>
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-slate-100 bg-white shadow-md text-slate-900 no-underline md:hidden"
                            target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($page->title ?? $page->slug) }}"
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-slate-100 bg-white shadow-md text-slate-900 no-underline md:hidden"
                            target="_blank" rel="noopener" aria-label="Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    {{-- div do container principal --}}
    </div>
@endsection
