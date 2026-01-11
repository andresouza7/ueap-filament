@extends('novosite.template.master')

@section('title', $post->title ?? 'Notícia')

@section('content')

    @php $url_atual = urlencode(url()->current()); @endphp

    {{-- ================= HEADER INDUSTRIAL ================= --}}
    <header class="bg-white border-b border-slate-100 overflow-hidden">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-14 relative">
            <div class="hidden lg:block absolute right-0 top-0 w-1/3 h-full bg-slate-50 skew-x-[-12deg] translate-x-20 z-0"></div>

            <div class="max-w-4xl relative z-10">
                {{-- Categoria & Tipo --}}
                <div class="flex items-center gap-3 mb-4 lg:mb-8">
                    <span class="text-[10px] lg:text-[11px] font-[1000] text-emerald-600 uppercase tracking-[0.2em]">
                        {{ $post->category->name }}
                    </span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <span class="text-[10px] lg:text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] italic">
                        {{ $post->type }}
                    </span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-6xl font-[1000] text-slate-900 leading-[1.1] lg:leading-[0.95] tracking-tighter uppercase italic mb-8">
                    {{ $post->title }}<span class="text-emerald-500 not-italic">.</span>
                </h1>

                <div class="pt-6 lg:pt-10 mt-6 lg:mt-10 border-t border-slate-100 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    {{-- Metadados --}}
                    <div class="flex items-center gap-8 md:gap-12">
                        <div class="flex flex-col gap-1.5">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none">Publicado</span>
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-calendar-check text-emerald-600 text-[10px]"></i>
                                <span class="text-[13px] font-[1000] text-slate-900 uppercase italic tracking-tight">{{ $post->created_at->translatedFormat('d M, Y') }}</span>
                            </div>
                        </div>
                        <div class="h-8 w-px bg-slate-100"></div>
                        <div class="flex flex-col gap-1.5">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none">Acessos</span>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-chart-line text-slate-300 text-[10px]"></i>
                                <span class="text-[13px] font-[1000] text-slate-900 uppercase italic tracking-tight">{{ number_format($post->hits, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Share --}}
                    <div class="flex items-center justify-between md:justify-end gap-6 bg-slate-50/50 p-2 md:p-0 border border-slate-100 md:border-0">
                        <span class="text-[9px] font-black text-slate-300 uppercase tracking-[0.3em] pl-2 md:ml-2">Compartilhar</span>
                        <div class="flex items-center bg-white border border-slate-200 md:border-slate-100 overflow-hidden">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}" target="_blank" class="group/social relative w-10 h-10 flex items-center justify-center text-[#1877F2] md:text-slate-400 transition-all">
                                <span class="hidden md:block absolute inset-0 bg-[#1877F2] translate-y-full group-hover/social:translate-y-0 transition-transform duration-300"></span>
                                <i class="fa-brands fa-facebook-f text-xs relative z-10 md:group-hover/social:text-white"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank" class="group/social relative w-10 h-10 flex items-center justify-center text-[#25D366] md:text-slate-400 border-x border-slate-100 transition-all">
                                <span class="hidden md:block absolute inset-0 bg-[#25D366] translate-y-full group-hover/social:translate-y-0 transition-transform duration-300"></span>
                                <i class="fa-brands fa-whatsapp text-sm relative z-10 md:group-hover/social:text-white"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" target="_blank" class="group/social relative w-10 h-10 flex items-center justify-center text-black md:text-slate-400 transition-all">
                                <span class="hidden md:block absolute inset-0 bg-black translate-y-full group-hover/social:translate-y-0 transition-transform duration-300"></span>
                                <i class="fa-brands fa-x-twitter text-xs relative z-10 md:group-hover/social:text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ================= CONTENT AREA ================= --}}
    <section x-data="{ open: false }" class="w-full py-16 relative">
        
       {{-- BOTÃO MOBILE --}}
    @if ($post->web_menu)
        <div class="lg:hidden fixed bottom-6 right-6 z-[60]">
            <button @click="open = true" 
                    class="bg-slate-900 text-white w-12 h-12 flex items-center justify-center border border-slate-700 active:scale-90 transition-all">
                <i class="fa-solid fa-bars-staggered text-lg"></i>
            </button>
        </div>

        {{-- DRAWER OVERLAY --}}
        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             @click="open = false" 
             class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[70] lg:hidden">
        </div>

        {{-- DRAWER PANEL --}}
        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
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
                            
                            <span class="text-[11px] font-bold uppercase tracking-wider {{ $isActive ? 'italic font-[1000]' : '' }}">
                                {{ $item->name }}
                            </span>

                            @if($isActive)
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
                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">UEAP © {{ date('Y') }}</span>
            </div>
        </div>
    @endif

        <div class="max-w-[1290px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                {{-- MAIN CONTENT --}}
                <main class="lg:col-span-8">
                    <article class="article-body prose prose-slate max-w-none 
                        prose-headings:uppercase prose-headings:italic prose-headings:font-[1000] prose-headings:tracking-tighter
                        prose-p:text-slate-600 prose-p:leading-relaxed prose-strong:text-slate-900">
                        @foreach ($post->content ?? [] as $block)
                            @include('novosite.components.post-block-renderer', ['block' => $block])
                        @endforeach
                    </article>

                    <div class="mt-20 pt-10 border-t-4 border-slate-900">
                        @include('novosite.components.related-posts', ['posts' => $relatedPosts])
                    </div>
                </main>

                {{-- SIDEBAR --}}
                <aside class="hidden lg:block lg:col-span-4">
                    @if ($post->web_menu)
                        @include('novosite.components.page-navigation', ['menu' => $post->web_menu])
                    @else
                        <div class="space-y-12 lg:pl-6">
                            @include('novosite.components.sidebar-search')
                            @include('novosite.components.sidebar-news', ['posts' => $latestPosts])
                            @include('novosite.components.sidebar-newsletter')
                            @include('novosite.components.sidebar-categories', ['categories' => $topCategories])
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>

@endsection