@extends('novosite.template.master')

@section('title', 'Documentos e Publicações - UEAP')

@section('content')
    @php
        $search = request('search');
    @endphp

    {{-- ================= HEADER ================= --}}
    <header class="bg-slate-950 border-b border-white/5 relative overflow-hidden" role="banner">
        <div class="absolute inset-0 opacity-10 pointer-events-none" aria-hidden="true"
            style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <div class="max-w-4xl">
                <div class="flex items-center gap-3 mb-6">
                    <span
                        class="inline-flex items-center bg-emerald-500/10 text-emerald-400 text-[10px] font-black px-3 py-1 border border-emerald-500/20 uppercase tracking-[0.2em]">
                        <span class="w-1.5 h-1.5 bg-emerald-500 animate-pulse mr-2" aria-hidden="true"></span>
                        Comunidade
                    </span>
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest" aria-hidden="true">//
                        INFORMATIVO</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-black text-white leading-none tracking-tighter mb-4 italic uppercase">
                    Calendário<br class="hidden md:block"> <span class="text-emerald-500">Acadêmico</span>
                </h1>
            </div>
        </div>
    </header>

    <main class="bg-white py-12 relative" id="main-content">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA (8 ESPAÇOS) --}}
                <div class="lg:col-span-8">

                    {{-- BARRA DE PESQUISA SIMPLIFICADA --}}
                    <div class="mb-10">
                        <form action="{{ url()->current() }}" method="GET" class="group relative" role="search">
                            <div
                                class="bg-slate-50 border border-slate-200 p-1.5 flex flex-col md:flex-row items-stretch gap-1.5 shadow-sm focus-within:shadow-md transition-all">
                                <div
                                    class="flex-1 flex items-center bg-white border border-slate-100 px-4 py-3 focus-within:border-emerald-500/50 transition-all">
                                    <i class="fa-solid fa-magnifying-glass text-slate-300 mr-3 text-xs"
                                        aria-hidden="true"></i>
                                    <div class="flex-1">
                                        <label for="search-input"
                                            class="block text-[7px] font-mono font-bold text-slate-400 uppercase tracking-[0.2em] mb-0.5">Filtrar_Conteúdo</label>
                                        <input type="text" name="search" id="search-input" value="{{ $search }}"
                                            placeholder="PESQUISAR POR TÍTULO OU PALAVRA-CHAVE..."
                                            class="w-full bg-transparent text-sm font-bold text-slate-800 focus:outline-none uppercase tracking-tight">
                                    </div>
                                    @if ($search)
                                        <a href="{{ url()->current() }}" class="text-slate-300 hover:text-red-500 ml-2"
                                            aria-label="Limpar busca">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                        </a>
                                    @endif
                                </div>
                                <button type="submit"
                                    class="bg-slate-900 text-white px-8 py-3 md:py-0 text-[10px] font-black uppercase tracking-[0.2em] hover:bg-emerald-600 transition-colors shrink-0">
                                    PESQUISAR
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM DE REGISTROS --}}
                    <div class="space-y-4" role="list">
                        @forelse ($items as $item)
                            <article
                                class="group border border-slate-100 p-5 hover:border-emerald-500/30 hover:bg-emerald-50/10 transition-all duration-300"
                                role="listitem">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                                    <div class="flex-1">

                                        <h2
                                            class="text-lg font-black text-slate-900 uppercase italic tracking-tight mb-2 group-hover:text-emerald-600 transition-colors leading-tight">
                                            {{ $item->title }}
                                        </h2>

                                        @if ($item->description)
                                            <p class="text-slate-500 text-sm leading-relaxed font-medium mb-4 line-clamp-2">
                                                {{ clean_text($item->description) }}
                                            </p>
                                        @endif

                                        {{-- DATA POSICIONADA NO TOPO DO CONTEÚDO --}}
                                        <div class="flex items-center gap-2">
                                            <i class="fa-regular fa-calendar text-emerald-500 text-[10px]"
                                                aria-hidden="true"></i>
                                            <span class="text-[10px] font-mono text-slate-400 uppercase tracking-widest">
                                                <span class="sr-only">Publicado em:</span>
                                                {{ $item->created_at?->format('d.m.Y') ?? 'Recente' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="shrink-0 flex items-center">
                                        <a href="{{ $item->file_url }}" target="_blank"
                                            aria-label="Baixar arquivo: {{ $item->title }}"
                                            class="w-full md:w-auto inline-flex items-center justify-center gap-3 bg-slate-900 text-white px-6 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-lg shadow-slate-200 group-hover:shadow-emerald-200">
                                            <i class="fa-solid fa-download" aria-hidden="true"></i>
                                            Download
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-20 text-center border-2 border-dashed border-slate-100 bg-slate-50/30 rounded-lg"
                                role="alert">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4"
                                    aria-hidden="true">
                                    <i class="fa-solid fa-file-circle-exclamation text-slate-300 text-2xl"></i>
                                </div>
                                <p class="text-slate-400 text-xs font-mono uppercase tracking-[0.2em]">Nenhum arquivo
                                    encontrado para esta busca.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- PAGINAÇÃO --}}
                    @if (method_exists($items, 'hasPages') && $items->hasPages())
                        <nav class="pt-10" aria-label="Navegação da página">
                            {{ $items->links() }}
                        </nav>
                    @endif
                </div>

                {{-- COLUNA DA DIREITA --}}
                <aside class="lg:col-span-4" role="complementary">
                    <div class="sticky top-8 space-y-6">
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
