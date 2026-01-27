@extends('novosite.template.master')

@section('title', $post->title ?? 'Notícia')

@section('content')

    @php $url_atual = urlencode(url()->current()); @endphp

    <header class="relative overflow-hidden bg-slate-50 border-b border-slate-300">

        {{-- textura --}}
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
            style="background-image: radial-gradient(#000 1px, transparent 1px); background-size: 30px 30px;"></div>

        {{-- skew decorativo --}}
        <div aria-hidden="true"
            class="hidden lg:block absolute right-0 top-0 w-[32%] h-full bg-slate-200/70 
               skew-x-[-12deg] translate-x-24 border-l border-ueap-green/30">
            <span class="absolute left-6 top-10 -rotate-90 text-[9px] font-mono tracking-[0.4em] text-slate-400 uppercase">
                UEAP_DOC
            </span>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
            <div class="max-w-4xl">

                {{-- categoria / tipo / status --}}
                <div class="flex flex-wrap items-center gap-4 mb-4">
                    <a href="{{ route('site.post.list', ['category' => $post->category->slug]) }}"
                        class="px-4 py-1.5 bg-[#00388d] text-white text-[11px] font-bold uppercase tracking-wider">
                        {{ $post->category->name }}
                    </a>

                    <span class="text-[11px] font-mono uppercase tracking-widest text-slate-500">
                        {{ $post->type }}
                    </span>

                    <div class="flex items-center gap-1.5 text-ueap-green">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full bg-ueap-green opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 bg-ueap-green"></span>
                        </span>
                        {{-- <span class="text-[10px] font-mono uppercase tracking-widest">live</span> --}}
                    </div>
                </div>

                {{-- título --}}
                <h1
                    class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00388d] uppercase leading-tight tracking-tight mb-6">
                    {{ $post->title }}<span class="text-ueap-green">.</span>
                </h1>

                {{-- metadados + share --}}
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pt-6 border-t border-slate-300">

                    {{-- bloco de dados (Ajustado para não quebrar no mobile) --}}
                    <div
                        class="flex items-stretch border border-slate-300 bg-white divide-x divide-slate-300 font-mono text-[#00388d] w-full lg:w-fit">

                        {{-- data --}}
                        <div class="flex-1 lg:flex-none px-4 py-2 lg:min-w-[140px]">
                            <span class="block text-[9px] uppercase tracking-widest text-slate-400 mb-1">
                                Publicação
                            </span>
                            <time class="text-xs lg:text-sm font-bold tracking-tight">
                                {{ $post->created_at->format('d.m.Y') }}
                            </time>
                        </div>

                        {{-- hits --}}
                        <div class="flex-1 lg:flex-none px-4 py-2 lg:min-w-[120px] bg-slate-50">
                            <span class="block text-[9px] uppercase tracking-widest text-slate-400 mb-1">
                                Acessos
                            </span>
                            <span class="text-xs lg:text-sm font-bold tracking-tight">
                                {{ number_format($post->hits, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- tag lateral --}}
                        <div class="bg-[#00388d] px-2.5 flex items-center justify-center shrink-0">
                            <span
                                class="text-[9px] font-bold text-white uppercase tracking-[0.3em] [writing-mode:vertical-lr] rotate-180">
                                UEAP
                            </span>
                        </div>
                    </div>

                    {{-- share (Ajustado alinhamento mobile) --}}
                    <nav class="flex items-center justify-between lg:justify-end gap-4 w-full lg:w-auto">
                        <span class="text-[10px] font-mono uppercase tracking-widest text-slate-400">
                            Compartilhar
                        </span>

                        <div class="flex border border-[#00388d] shrink-0">
                            <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                class="w-10 h-10 flex items-center justify-center text-[#00388d] hover:bg-ueap-green hover:text-white transition-colors">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" target="_blank"
                                class="w-10 h-10 flex items-center justify-center text-[#00388d] hover:bg-ueap-green hover:text-white transition-colors border-l border-[#00388d]">
                                <i class="fa-brands fa-x-twitter text-[11px]"></i>
                            </a>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </header>


    {{-- ================= ÁREA DE CONTEÚDO ================= --}}
    <section x-data="{ open: false }" class="w-full py-16 lg:py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                {{-- MAIN CONTENT --}}
                <main class="lg:col-span-8">
                    <article
                        class="article-body prose prose-slate max-w-none 
                        prose-headings:uppercase prose-headings:font-black prose-headings:text-[#00388d] prose-headings:tracking-tighter
                        prose-p:text-slate-600 prose-p:leading-relaxed prose-strong:text-[#00388d]
                        prose-img:rounded-none prose-img:border-l-[6px] prose-img:border-ueap-green">

                        @foreach ($post->content ?? [] as $block)
                            <div class="mb-10">
                                @include('novosite.components.post-block-renderer', ['block' => $block])
                            </div>
                        @endforeach
                    </article>

                    {{-- Rodapé Industrial --}}
                    <footer class="mt-20">
                        <div class="h-1 w-full bg-[#00388d]"></div>
                        <div class="flex items-center justify-between py-6">
                            <span
                                class="text-[10px] font-black uppercase tracking-[0.3em] text-[#00388d]">Informativo_Finalizado</span>
                            <time class="text-[11px] font-bold text-slate-400 italic">
                                Atualizado: {{ $post->updated_at->format('d/m/Y H:i') }}
                            </time>
                        </div>
                    </footer>

                    {{-- Relacionados --}}
                    <div class="mt-20 pt-16 border-t border-slate-100">
                        @include('novosite.components.post-relacionados', ['posts' => $relatedPosts])
                    </div>
                </main>

                {{-- SIDEBAR FORMAL --}}
                <aside class="hidden lg:block lg:col-span-4 relative">
                    <div class="sticky top-28 space-y-12">
                        @if ($post->web_menu)
                            <nav class="flex flex-col border-l-4 border-[#00388d] bg-slate-50 p-6">
                                <h4 class="text-[10px] font-black text-[#00388d] uppercase tracking-[0.4em] mb-6">Índice de
                                    Seção</h4>
                                <div class="flex flex-col gap-1">
                                    @foreach (optional($post->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                                        @php $isActive = request()->url() == $item->url; @endphp
                                        <a href="{{ $item->url }}"
                                            class="p-3 text-[11px] font-bold uppercase transition-all {{ $isActive ? 'bg-[#00388d] text-white' : 'text-slate-600 hover:bg-white hover:text-[#00388d]' }}">
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </nav>
                        @endif

                        <div class="space-y-10">
                            @include('novosite.components.sidebar-search')
                            @include('novosite.components.sidebar-news', ['posts' => $latestPosts])
                            @include('novosite.components.sidebar-newsletter')
                            @include('novosite.components.sidebar-categories', [
                                'categories' => $categories,
                            ])

                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

@endsection
