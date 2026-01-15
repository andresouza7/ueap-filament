@extends('novosite.template.master')

@section('title', $post->title ?? 'Notícia')

@section('content')

    @php $url_atual = urlencode(url()->current()); @endphp

    {{-- ================= HEADER INDUSTRIAL HYBRID PREMIUM ================= --}}
    <header class="relative overflow-hidden border-b border-slate-200 bg-[#f1f5f9]">

        {{-- EFEITO PONTILHADO (Adicionado) --}}
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 24px 24px;"></div>

        {{-- Background Skew (Desktop Only) --}}
        <div
            class="hidden lg:block absolute right-0 top-0 w-1/3 h-full bg-slate-300/40 skew-x-[-12deg] translate-x-20 z-0 border-l-4 border-emerald-500/20 shadow-[-10px_0_30px_rgba(0,0,0,0.03)]">
            <span
                class="absolute left-4 top-10 -rotate-90 text-[8px] font-mono text-slate-400 tracking-[0.5em] uppercase whitespace-nowrap">
                System_Ref: {{ rand(1000, 9999) }}
            </span>
        </div>

        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-14 relative z-10">
            <div class="max-w-4xl relative">

                {{-- Categoria & Tipo + Badge de Status (Badge Adicionada) --}}
                <div class="flex flex-wrap items-center gap-3 mb-4 lg:mb-8">
                    <a href="{{ route('site.post.list', ['category' => $post->category->slug]) }}"
                        class="flex items-center bg-slate-900 px-3 py-1 ring-1 ring-emerald-500/30 hover:ring-emerald-500 transition-all group">
                        <span
                            class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.15em] group-hover:text-emerald-400">
                            {{ $post->category->name }}
                        </span>
                    </a>

                    {{-- Status de Conexão (Novo detalhe para alinhar com a listagem) --}}
                    <div class="flex items-center gap-1.5 bg-emerald-500/10 px-2 py-1 border border-emerald-500/20">
                        <span class="relative flex h-1.5 w-1.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                        </span>
                        <span
                            class="text-[8px] font-mono text-emerald-600 font-bold tracking-widest uppercase">Live_Post</span>
                    </div>

                    <span class="hidden sm:block w-1 h-1 bg-slate-300 rounded-full"></span>

                    <span
                        class="text-[10px] lg:text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] italic font-mono">
                        {{ $post->type }}
                    </span>
                </div>

                {{-- Título --}}
                <h1
                    class="text-3xl sm:text-4xl lg:text-6xl font-[1000] text-slate-900 leading-[1.1] lg:leading-[0.95] tracking-tighter uppercase italic mb-8">
                    {{ $post->title }}<span class="text-emerald-500 not-italic">.</span>
                </h1>

                {{-- Barra Inferior (Metadados + Share) --}}
                <div
                    class="pt-6 lg:pt-10 mt-6 lg:mt-10 border-t border-slate-200 flex flex-col lg:flex-row lg:items-center justify-between gap-6 lg:gap-8">

                    {{-- Bloco de Metadados (Data Panel) --}}
                    <div
                        class="flex items-stretch gap-0 bg-slate-200/40 border border-slate-300 overflow-hidden w-full lg:w-fit shadow-sm">
                        {{-- Módulo 01: Timestamp --}}
                        <div
                            class="relative flex-1 lg:flex-none flex flex-col justify-between p-3 border-r border-slate-300 lg:min-w-[130px] bg-white/20">
                            <div class="absolute top-0 left-0 w-4 h-[2px] bg-emerald-500"></div>
                            <span
                                class="text-[7px] font-black text-slate-500 uppercase tracking-[0.4em] font-mono mb-2">Publicado</span>
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-3 bg-slate-900"></div>
                                <span
                                    class="text-[12px] sm:text-[13px] font-[1000] text-slate-900 uppercase font-mono tracking-tighter leading-none">
                                    {{ $post->created_at->format('d.M.y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Módulo 02: Acessos --}}
                        <div
                            class="relative flex-1 lg:flex-none flex flex-col justify-between p-3 bg-white/40 lg:min-w-[120px]">
                            <div class="absolute top-0 right-0 w-6 h-6 overflow-hidden text-slate-300">
                                <div
                                    class="absolute top-0 right-0 w-full h-[1px] bg-current rotate-45 translate-x-3 translate-y-1">
                                </div>
                            </div>
                            <span
                                class="text-[7px] font-black text-slate-500 uppercase tracking-[0.4em] font-mono mb-2">Acessos</span>
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-[12px] sm:text-[13px] font-[1000] text-slate-900 uppercase font-mono tracking-tighter leading-none">
                                    {{ number_format($post->hits, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        {{-- Módulo 03: Status Tag --}}
                        <div class="bg-slate-900 flex items-center justify-center px-2 border-l border-slate-900">
                            <span
                                class="text-[7px] font-bold text-white uppercase [writing-mode:vertical-lr] rotate-180 tracking-[0.2em] font-mono">
                                LOG
                            </span>
                        </div>
                    </div>

                    {{-- Bloco de Share --}}
                    <div
                        class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto bg-slate-200/20 lg:bg-transparent p-2 lg:p-0 border border-slate-200 lg:border-0">
                        <span
                            class="text-[8px] font-black text-slate-500 uppercase tracking-[0.4em] font-mono pl-2 lg:pl-0">
                            COMPARTILHAR
                        </span>

                        <div
                            class="flex items-center bg-slate-900 border border-slate-900 overflow-hidden shadow-lg ring-1 ring-white/10 flex-none">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}" target="_blank"
                                class="w-10 h-10 flex items-center justify-center text-white/70 hover:bg-white hover:text-black transition-colors border-r border-white/5">
                                <i class="fa-brands fa-facebook-f text-xs"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                class="w-10 h-10 flex items-center justify-center text-white/70 hover:bg-white hover:text-black transition-colors border-r border-white/5">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" target="_blank"
                                class="w-10 h-10 flex items-center justify-center text-white/70 hover:bg-white hover:text-black transition-colors">
                                <i class="fa-brands fa-x-twitter text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ================= CONTENT AREA ================= --}}
    <section x-data="{ open: false }" class="w-full py-16 lg:py-24 relative">

        {{-- BOTÃO MOBILE --}}
        @if ($post->web_menu)
            <div class="lg:hidden fixed bottom-5 right-5 z-[60]">
                <button @click="open = true"
                    class="bg-slate-900 text-white w-12 h-12 flex items-center justify-center border border-slate-700 active:scale-90 transition-all">
                    <i class="fa-solid fa-bars-staggered text-lg"></i>
                </button>
            </div>

            {{-- DRAWER OVERLAY --}}
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" @click="open = false"
                class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[70] lg:hidden">
            </div>

            {{-- DRAWER PANEL --}}
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed top-0 right-0 w-[260px] h-full bg-white z-[80] lg:hidden flex flex-col border-l border-slate-200">

                {{-- Header do Drawer: Super Condensado --}}
                <div class="flex items-center justify-between p-4 border-b border-slate-900 bg-slate-50">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-900">Índice</span>
                    <button @click="open = false" class="text-slate-900 hover:text-emerald-600 transition-colors p-2">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                {{-- Área de Links com Scroll Próprio --}}
                <div class="flex-1 overflow-y-auto bg-white custom-scrollbar">
                    <nav class="flex flex-col">
                        @foreach (optional($post->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                            @php $isActive = request()->url() == $item->url; @endphp
                            <a href="{{ $item->url }}"
                                class="flex items-center justify-between px-6 py-3.5 border-b border-slate-50 transition-colors
                           {{ $isActive ? 'bg-slate-50 text-emerald-600' : 'text-slate-900 active:bg-slate-50' }}">

                                <span
                                    class="text-[11px] font-bold uppercase tracking-wider {{ $isActive ? 'italic font-[1000]' : '' }}">
                                    {{ $item->name }}
                                </span>

                                @if ($isActive)
                                    <div class="w-1.5 h-1.5 bg-emerald-500 rotate-45"></div>
                                @else
                                    <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                                @endif
                            </a>
                        @endforeach
                    </nav>
                </div>

                {{-- Footer do Drawer (Opcional) --}}
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">UEAP ©
                        {{ date('Y') }}</span>
                </div>
            </div>
        @endif

        <div class="max-w-[1290px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                {{-- MAIN CONTENT --}}
                <main class="lg:col-span-8">
                    {{-- Conteúdo da Notícia --}}
                    <article
                        class="article-body prose prose-slate max-w-none 
        prose-headings:uppercase prose-headings:italic prose-headings:font-[1000] prose-headings:tracking-tighter
        prose-p:text-slate-600 prose-p:leading-relaxed prose-strong:text-slate-900 flex flex-col gap-10">

                        @foreach ($post->content ?? [] as $block)
                            @include('novosite.components.post-block-renderer', ['block' => $block])
                        @endforeach
                    </article>

                    {{-- Divisor e Data de Atualização --}}
                    <div class="mt-16">
                        {{-- Linha de Separação H1 --}}
                        <div class="h-1 w-full bg-slate-900"></div>

                        <div class="flex items-center justify-between py-4">
                            <div class="flex items-center gap-3">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-900">
                                    Última Atualização
                                </span>
                                <span class="h-[1px] w-8 bg-slate-200"></span>
                                <time class="text-[13px] font-bold text-slate-500 italic tracking-tight">
                                    {{ $post->updated_at->format('d') }} de {{ $post->updated_at->translatedFormat('F') }}
                                    de {{ $post->updated_at->format('Y') }} — {{ $post->updated_at->format('H:i') }}
                                </time>
                            </div>
                        </div>
                    </div>

                    {{-- Seção Related Posts --}}
                    <div class="mt-10">
                        @include('novosite.components.post-relacionados', ['posts' => $relatedPosts])
                    </div>
                </main>

                {{-- SIDEBAR --}}
                <aside class="hidden lg:block lg:col-span-4 relative h-full">
                    @if ($post->web_menu)
                        @include('novosite.components.post-navigation', ['menu' => $post->web_menu])
                    @else
                        <div class="space-y-12">
                            @include('novosite.components.sidebar-search')
                            @include('novosite.components.sidebar-news', ['posts' => $latestPosts])
                            @include('novosite.components.sidebar-newsletter')
                            @include('novosite.components.sidebar-categories', [
                                'categories' => $categories,
                            ])
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>

@endsection
