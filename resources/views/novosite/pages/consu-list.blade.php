@extends('novosite.template.master')

@section('title', 'Publicações Oficiais - UEAP')

@section('content')
    @php
        $searchName = request('name');
        $searchNumber = request('number');
        $searchYear = request('year');

        // Lógica de Título para o Header Estilo Post
        $parts = explode(' ', $title, 2);
        $first = $parts[0] ?? 'Publicações';
        $second = $parts[1] ?? 'Oficiais';
    @endphp

    {{-- ================= HEADER INDUSTRIAL (PADRÃO POST) ================= --}}
    <header class="relative bg-[#001030] py-14 lg:py-20 overflow-hidden border-b-[10px] border-[#a4ed4a]">

        {{-- LAYER DE FUNDO --}}
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute -top-10 -right-20 text-[150px] lg:text-[220px] font-black leading-none select-none opacity-[0.05] uppercase tracking-tighter text-white whitespace-nowrap -rotate-12"
                style="-webkit-text-stroke: 3px white; color: transparent;">
                CONSU
            </div>
            <div
                class="absolute -bottom-24 -left-20 w-[500px] h-[300px] border-[12px] border-[#0055ff]/10 rounded-[120px] -rotate-12">
            </div>
            <div class="absolute inset-0 opacity-20"
                style="background-image: radial-gradient(#a4ed4a 1.5px, transparent 1.5px); background-size: 32px 32px;">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-5xl">
                {{-- Badge --}}
                <div class="flex items-center gap-4 mb-6">
                    <span
                        class="bg-[#a4ed4a] text-[#001030] text-[10px] font-black px-4 py-1 uppercase tracking-widest shadow-[0_10px_30px_rgba(164,237,74,0.4)]">
                        CONSELHO UNIVERSITÁRIO
                    </span>
                    <span class="text-white/20 font-mono text-xs tracking-tighter">// ARQUIVO_DE_RESOLUCOES</span>
                </div>

                {{-- Título --}}
                <h1
                    class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[0.85] tracking-tighter uppercase italic mb-10">
                    {{ $first }}<br>
                    <span class="text-[#a4ed4a]">{{ $second }}</span>_
                </h1>

                {{-- Dashboard Stats --}}
                <div class="flex flex-wrap items-center gap-x-12 gap-y-6 pt-8 border-t border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-[#0055ff]"></div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Base de Dados</span>
                            <span class="text-white text-xl font-black italic">CONSU_V2.0</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-8 bg-[#a4ed4a]"></div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-white/40 uppercase tracking-widest">Documentos</span>
                            <span class="text-white text-xl font-black italic">{{ $items->total() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="bg-[#f8fafc] py-16">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- FILTROS DE BUSCA --}}
                    <div class="mb-12">
                        <form action="{{ url()->current() }}" method="GET"
                            class="bg-white border-[4px] border-[#001030] shadow-[8px_8px_0px_0px_#001030] p-6">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <div class="md:col-span-6">
                                    <label
                                        class="block text-[10px] font-black text-[#001030] uppercase tracking-widest mb-2">Palavra-Chave</label>
                                    <input type="text" name="name" value="{{ $searchName }}"
                                        placeholder="Ex: Regimento Interno..."
                                        class="w-full bg-slate-50 border-2 border-slate-200 p-3 text-sm font-bold text-[#001030] focus:border-[#0055ff] focus:outline-none transition-colors">
                                </div>
                                <div class="md:col-span-3">
                                    <label
                                        class="block text-[10px] font-black text-[#001030] uppercase tracking-widest mb-2">Número</label>
                                    <input type="number" name="number" value="{{ $searchNumber }}" placeholder="000"
                                        class="w-full bg-slate-50 border-2 border-slate-200 p-3 text-sm font-bold text-[#001030] focus:border-[#0055ff] focus:outline-none">
                                </div>
                                <div class="md:col-span-3">
                                    <label
                                        class="block text-[10px] font-black text-[#001030] uppercase tracking-widest mb-2">Ano</label>
                                    <input type="number" name="year" value="{{ $searchYear }}"
                                        placeholder="{{ date('Y') }}"
                                        class="w-full bg-slate-50 border-2 border-slate-200 p-3 text-sm font-bold text-[#001030] focus:border-[#0055ff] focus:outline-none">
                                </div>
                            </div>

                            <div
                                class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-slate-100 pt-6">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">
                                    [ {{ $items->total() }} registros encontrados ]
                                </span>
                                <div class="flex items-center gap-4">
                                    @if ($searchName || $searchNumber || $searchYear)
                                        <a href="{{ url()->current() }}"
                                            class="text-[10px] font-black text-red-500 uppercase hover:underline">Limpar_Busca</a>
                                    @endif
                                    <button type="submit"
                                        class="bg-[#001030] text-[#a4ed4a] px-8 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-[#0055ff] hover:text-white transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,0.1)]">
                                        FILTRAR_RESULTADOS
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM OTIMIZADA --}}
                    <div class="space-y-6">
                        @forelse ($items as $item)
                            <article
                                class="group bg-white border-[3px] border-[#001030] hover:shadow-[12px_12px_0px_0px_#a4ed4a] transition-all duration-300 overflow-hidden">
                                <div class="flex flex-col md:flex-row">
                                    {{-- Info lateral do documento --}}
                                    <div
                                        class="bg-[#001030] md:w-40 p-4 flex flex-row md:flex-col justify-between items-center md:justify-center gap-2 shrink-0">
                                        <span class="text-[#a4ed4a] text-lg font-black italic">№ {{ $item->number }}</span>
                                        <span
                                            class="text-white/40 text-[10px] font-black tracking-tighter italic border-t border-white/10 pt-2 w-full text-center hidden md:block">
                                            ANO_{{ $item->year }}
                                        </span>
                                    </div>

                                    {{-- Conteúdo --}}
                                    <div class="p-6 flex-1 flex flex-col md:flex-row justify-between gap-6">
                                        <div class="max-w-xl">
                                            <div
                                                class="text-[10px] font-black text-[#0055ff] uppercase tracking-widest mb-1">
                                                Publicado em {{ $item->created_at?->format('d/m/Y') }}
                                            </div>
                                            {{-- Nome do documento: Impactante --}}
                                            <h3
                                                class="text-xl font-black text-[#001030] italic leading-none mb-3 group-hover:text-[#0055ff] transition-colors">
                                                {{ $item->name ?? 'Documento Oficial' }}
                                            </h3>
                                            {{-- Descrição: Legível e Minúscula --}}
                                            <p class="text-slate-600 text-sm leading-relaxed normal-case font-medium">
                                                {{ $item->description }}
                                            </p>
                                        </div>

                                        <div class="flex items-center">
                                            <a href="{{ $item->file_url ?? '#' }}" target="_blank"
                                                class="w-full md:w-auto flex items-center justify-center gap-3 bg-white border-2 border-[#001030] text-[#001030] px-6 py-4 text-[10px] font-[1000] uppercase tracking-widest hover:bg-[#001030] hover:text-[#a4ed4a] transition-all group/btn">
                                                <i class="fa-solid fa-file-pdf text-lg"></i>
                                                VER_PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-20 text-center border-[4px] border-dashed border-slate-200 bg-white">
                                <span
                                    class="text-sm font-black text-slate-300 uppercase tracking-widest">Nenhum_Registro_Encontrado</span>
                            </div>
                        @endforelse
                    </div>

                    @if ($items->hasPages())
                        <div class="pt-16">
                            {{ $items->links('novosite.components.post-paginator') }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4">
                    <div class="sticky top-8 space-y-8">
                        @include('novosite.components.sidebar-newsletter')
                        {{-- Widget Extra Industrial --}}
                        <div class="bg-[#001030] p-8 relative overflow-hidden">
                            <div class="relative z-10">
                                <h4 class="text-[#a4ed4a] font-black uppercase italic tracking-tighter mb-4">
                                    Informação_Técnica</h4>
                                <p class="text-white/60 text-[11px] leading-relaxed uppercase font-bold">
                                    Esta seção contém as resoluções e decisões oficiais do Conselho Universitário da UEAP.
                                </p>
                            </div>
                            <div class="absolute -bottom-4 -right-4 text-white/5 text-6xl font-black italic select-none">
                                CONSU</div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
