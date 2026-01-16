@extends('novosite.template.master')

@section('title', $post->title ?? 'Notícia')

@section('content')

    @php $url_atual = urlencode(url()->current()); @endphp

    {{-- ================= HEADER CONDENSADO: GEOMETRIA AVANÇADA ================= --}}
    <header class="relative bg-[#001030] py-14 lg:py-20 overflow-hidden border-b-[10px] border-[#a4ed4a]">

        {{-- LAYER DE FUNDO: GEOMETRIA ESTRUTURAL --}}
        <div class="absolute inset-0 pointer-events-none z-0">
            {{-- Texto de Fundo (Stroke) - Posicionado na diagonal --}}
            <div class="absolute -top-10 -right-20 text-[150px] lg:text-[220px] font-black leading-none select-none opacity-[0.05] uppercase tracking-tighter text-white whitespace-nowrap -rotate-12"
                style="-webkit-text-stroke: 3px white; color: transparent;">
                {{ $post->category->name }}
            </div>

            {{-- Retângulo 12px: Cruzando o canto inferior esquerdo --}}
            <div
                class="absolute -bottom-24 -left-20 w-[500px] h-[300px] border-[12px] border-[#0055ff]/10 rounded-[120px] -rotate-12">
            </div>

            {{-- Retângulo 8px: No canto superior direito --}}
            <div
                class="absolute -top-20 right-20 w-[300px] h-[300px] border-[8px] border-[#a4ed4a]/15 rounded-full rotate-45">
            </div>

            {{-- Pontos Neon com gradiente de opacidade --}}
            <div class="absolute inset-0 opacity-20 [mask-image:linear-gradient(to_bottom,white,transparent)]"
                style="background-image: radial-gradient(#a4ed4a 1.5px, transparent 1.5px); background-size: 32px 32px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-5xl">

                {{-- Badge e Categoria --}}
                <div class="flex items-center gap-4 mb-6">
                    <span
                        class="bg-[#a4ed4a] text-[#001030] text-[10px] font-black px-4 py-1 uppercase tracking-widest shadow-[0_10px_30px_rgba(164,237,74,0.4)]">
                        {{ $post->category->name }}
                    </span>
                    <span class="text-white/20 font-mono text-xs tracking-tighter">// {{ strtoupper($post->type) }}</span>
                </div>

                {{-- Título Curto e Grosso --}}
                <h1
                    class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[0.85] tracking-tighter uppercase italic mb-10">
                    {{ $post->title }}<span class="text-[#a4ed4a]">.</span>
                </h1>

                {{-- Dashboard Stats --}}
                <div class="flex flex-wrap items-center gap-x-12 gap-y-6 pt-8 border-t border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-[#0055ff]"></div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Publicado</span>
                            <time
                                class="text-white text-xl font-black italic">{{ $post->created_at->format('d/m/Y') }}</time>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-[#a4ed4a]"></div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Visualizações</span>
                            <span
                                class="text-white text-xl font-black italic">{{ number_format($post->hits, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Share --}}
                    <div class="ml-auto flex items-center gap-3">
                        <a href="https://api.whatsapp.com/send?text={{ $url_atual }}"
                            class="w-12 h-12 flex items-center justify-center bg-[#25D366] text-white rounded-2xl hover:bg-white hover:text-[#25D366] transition-all shadow-xl">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}"
                            class="w-12 h-12 flex items-center justify-center bg-white text-[#001030] rounded-2xl hover:bg-[#001030] hover:text-white transition-all shadow-xl">
                            <i class="fa-brands fa-x-twitter text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ================= CONTEÚDO EDITORIAL ================= --}}
    <section class="bg-white py-16 lg:py-24 relative overflow-hidden">

        {{-- Forma geométrica "fantasma" no fundo da seção branca --}}
        <div
            class="absolute -right-40 top-40 w-[600px] h-[600px] border-[1px] border-slate-100 rounded-full pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">

                {{-- Matéria --}}
                <main class="lg:col-span-8">
                    <article
                        class="prose prose-slate prose-xl max-w-none 
                        prose-headings:text-[#001030] prose-headings:font-black prose-headings:tracking-tighter prose-headings:uppercase prose-headings:italic
                        prose-p:text-slate-600 prose-p:leading-relaxed prose-p:mb-10
                        prose-strong:text-[#0055ff] prose-strong:font-black
                        prose-img:rounded-[60px] prose-img:shadow-[0_40px_80px_-20px_rgba(0,16,48,0.2)] prose-img:p-2 prose-img:bg-white prose-img:border prose-img:border-slate-100">

                        @foreach ($post->content ?? [] as $block)
                            <div class="mb-14">
                                @include('novosite.components.post-block-renderer', ['block' => $block])
                            </div>
                        @endforeach
                    </article>

                    {{-- Linha de Fechamento de 12px --}}
                    <footer class="mt-24 pt-12 border-t-[12px] border-[#001030] flex justify-between items-center">
                        <span class="text-xs font-black uppercase text-[#001030] tracking-[0.4em]">Fim do Informativo</span>
                        <span class="text-[10px] font-bold text-slate-400 italic">Atualizado em
                            {{ $post->updated_at->format('d/m/Y H:i') }}</span>
                    </footer>

                    {{-- SEÇÃO RELACIONADOS INTEGRADA --}}
                    <div class="mt-32">
                        @include('novosite.components.post-relacionados', ['posts' => $relatedPosts])
                    </div>
                </main>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4">
                    <div class="sticky top-10 space-y-16">
                        @if ($post->web_menu)
                            <nav class="space-y-3">
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.5em] mb-8">Nesta
                                    Seção</h4>
                                @foreach (optional($post->web_menu)->items()->where('status', 'published')->orderBy('position')->get() ?? [] as $item)
                                    @php $isActive = request()->url() == $item->url; @endphp
                                    <a href="{{ $item->url }}"
                                        class="group flex items-center justify-between p-6 rounded-[35px] border-2 transition-all
                                       {{ $isActive ? 'bg-[#001030] border-[#001030] text-white shadow-2xl' : 'bg-slate-50 border-transparent text-[#001030] hover:border-[#a4ed4a] hover:bg-white' }}">
                                        <span
                                            class="text-[11px] font-black uppercase tracking-widest">{{ $item->name }}</span>
                                        <div
                                            class="w-10 h-10 rounded-full flex items-center justify-center transition-all {{ $isActive ? 'bg-[#a4ed4a]' : 'bg-white shadow-sm group-hover:bg-[#a4ed4a]' }}">
                                            <i class="fa-solid fa-arrow-up-right text-[10px] text-[#001030]"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </nav>
                        @endif

                        <div class="space-y-12">
                            @include('novosite.components.sidebar-search')
                            @include('novosite.components.sidebar-news', ['posts' => $latestPosts])
                            @include('novosite.components.sidebar-newsletter')
                            @include('novosite.components.sidebar-categories', ['categories' => $categories])
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

@endsection
