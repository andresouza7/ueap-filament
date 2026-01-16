@extends('novosite.template.master')

@section('title', 'Documentos e Publicações - UEAP')

@section('content')
    @php
        $search = request('search');
    @endphp

    {{-- ================= HEADER INDUSTRIAL (PADRÃO POST) ================= --}}
    <header class="relative bg-[#001030] py-14 lg:py-20 overflow-hidden border-b-[10px] border-[#a4ed4a]">

        {{-- LAYER DE FUNDO: GEOMETRIA ESTRUTURAL --}}
        <div class="absolute inset-0 pointer-events-none z-0">
            {{-- Texto de Fundo (Stroke) --}}
            <div class="absolute -top-10 -right-20 text-[150px] lg:text-[220px] font-black leading-none select-none opacity-[0.05] uppercase tracking-tighter text-white whitespace-nowrap -rotate-12"
                style="-webkit-text-stroke: 3px white; color: transparent;">
                DOCUMENTOS
            </div>

            {{-- Retângulo 12px --}}
            <div class="absolute -bottom-24 -left-20 w-[500px] h-[300px] border-[12px] border-[#0055ff]/10 rounded-[120px] -rotate-12"></div>

            {{-- Pontos Neon --}}
            <div class="absolute inset-0 opacity-20 [mask-image:linear-gradient(to_bottom,white,transparent)]"
                style="background-image: radial-gradient(#a4ed4a 1.5px, transparent 1.5px); background-size: 32px 32px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-5xl">

                {{-- Badge e Seção --}}
                <div class="flex items-center gap-4 mb-6">
                    <span class="bg-[#a4ed4a] text-[#001030] text-[10px] font-black px-4 py-1 uppercase tracking-widest shadow-[0_10px_30px_rgba(164,237,74,0.4)]">
                        REPOSITÓRIO
                    </span>
                    <span class="text-white/20 font-mono text-xs tracking-tighter">// ARQUIVOS_OFICIAIS</span>
                </div>

                {{-- Título Curto e Grosso --}}
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[0.85] tracking-tighter uppercase italic mb-10">
                    Calendário<br>Acadêmico<span class="text-[#a4ed4a]">_</span>
                </h1>

                {{-- Dashboard Stats (Sem Share) --}}
                <div class="flex flex-wrap items-center gap-x-12 gap-y-6 pt-8 border-t border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-[#0055ff]"></div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Sincronização</span>
                            <span class="text-white text-xl font-black italic">DATABASE_LIVE</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-[#a4ed4a]"></div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Total_Arquivos</span>
                            <span class="text-white text-xl font-black italic">{{ $items->total() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- ================= CONTEÚDO DA PÁGINA ================= --}}
    <main class="bg-[#f8fafc] py-16" id="main-content">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- PESQUISA ESTILO "INPUT BOX" --}}
                    <div class="mb-12">
                        <form action="{{ url()->current() }}" method="GET" class="relative" role="search">
                            <div class="bg-white border-[4px] border-[#001030] p-2 flex flex-col md:flex-row items-stretch gap-2 shadow-[8px_8px_0px_0px_#001030] focus-within:shadow-[8px_8px_0px_0px_#A4ED4A] transition-all">
                                <div class="flex-1 flex items-center px-4 py-4">
                                    <div class="flex-1">
                                        <label for="search-input" class="block text-[9px] font-black text-[#001030]/40 uppercase tracking-widest mb-1">Filtrar_Documentos</label>
                                        <input type="text" name="search" id="search-input" value="{{ $search }}"
                                            placeholder="DIGITE O TERMO DE BUSCA..."
                                            class="w-full bg-transparent text-sm font-black text-[#001030] focus:outline-none uppercase tracking-widest placeholder:text-[#001030]/20">
                                    </div>
                                </div>
                                <button type="submit"
                                    class="bg-[#001030] text-[#A4ED4A] px-10 py-4 text-[12px] font-[1000] uppercase tracking-[0.3em] hover:bg-[#002266] transition-colors">
                                    BUSCAR_AGORA
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM DE ARQUIVOS --}}
                    <div class="space-y-6" role="list">
                        @forelse ($items as $item)
                            <article class="group bg-white border-[3px] border-[#001030] p-8 rounded-[2rem] hover:shadow-[10px_10px_0px_0px_#A4ED4A] transition-all duration-300 relative overflow-hidden" role="listitem">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-3">
                                            <span class="text-[10px] font-black text-[#001030] bg-[#A4ED4A] px-2 py-0.5 uppercase tracking-tighter">
                                                DOC_V.01
                                            </span>
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                ID: #{{ $item->id }}
                                            </span>
                                        </div>

                                        <h2 class="text-2xl font-[1000] text-[#001030] uppercase italic tracking-tighter mb-4 group-hover:text-[#0055ff] transition-colors leading-none">
                                            {{ $item->title }}
                                        </h2>

                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 bg-[#A4ED4A] rounded-full"></div>
                                            <span class="text-[10px] font-black text-[#001030] uppercase tracking-[0.2em]">
                                                DATA: {{ $item->created_at?->format('d.m.Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="shrink-0">
                                        <a href="{{ $item->file_url }}" target="_blank"
                                            class="inline-flex items-center justify-center gap-4 bg-[#001030] text-[#A4ED4A] px-8 py-5 text-[11px] font-[1000] uppercase tracking-[0.2em] rounded-full hover:bg-[#0055ff] transition-all shadow-xl">
                                            <i class="fa-solid fa-download text-sm"></i>
                                            BAIXAR_PDF
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-24 text-center border-[4px] border-dashed border-[#001030]/10 bg-white rounded-[3rem]">
                                <p class="text-[#001030] text-xs font-black uppercase tracking-[0.3em]">Nenhum arquivo encontrado.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- PAGINAÇÃO --}}
                    @if (method_exists($items, 'hasPages') && $items->hasPages())
                        <div class="pt-16">
                            {{ $items->links() }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4" role="complementary">
                    <div class="sticky top-8 space-y-10">
                        @include('novosite.components.sidebar-search')
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection