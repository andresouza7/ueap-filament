@extends('novosite.template.master')

@section('title', 'Conselho Universitário - UEAP')

@section('content')
    @php
        $searchName = request('name');
        $searchNumber = request('number');
        $searchYear = request('year');

        $parts = explode(' ', $title, 2);
        $first = $parts[0] ?? 'Publicações';
        $second = $parts[1] ?? 'Oficiais';
    @endphp

    {{-- HEADER PADRÃO (IGUAL POST-SHOW) --}}
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
                    <span class="px-4 py-1.5 bg-[#00388d] text-white text-[11px] font-bold uppercase tracking-wider">
                        CONSU
                    </span>

                    <span class="text-[11px] font-mono uppercase tracking-widest text-slate-500">
                        Atas e Resoluções
                    </span>

                    <div class="flex items-center gap-1.5 text-ueap-green">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full bg-ueap-green opacity-60"></span>
                            <span class="relative inline-flex h-2 w-2 bg-ueap-green"></span>
                        </span>
                    </div>
                </div>

                {{-- título --}}
                <h1
                    class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#00388d] uppercase leading-tight tracking-tight mb-6">
                    {{ $first }} <span class="text-ueap-green">{{ $second }}</span>
                </h1>

                {{-- Barra final inferior --}}
                <div class="flex items-center justify-between pt-6 border-t border-slate-300">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-mono uppercase tracking-widest text-slate-400">
                            Repositório Oficial
                        </span>
                        <div class="h-1 w-12 bg-ueap-green"></div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- FILTROS DE BUSCA --}}
                    <div class="mb-10 bg-slate-50 p-6 border border-slate-200">
                        <form action="{{ url()->current() }}" method="GET" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-6">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Palavra-Chave</label>
                                    <input type="text" name="name" value="{{ $searchName }}"
                                        placeholder="EX: REGIMENTO"
                                        class="w-full bg-white border border-slate-300 px-4 py-3 text-sm font-bold text-[#00388d] focus:border-[#00388d] focus:outline-none transition-all uppercase placeholder:text-slate-400">
                                </div>
                                <div class="md:col-span-3">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Número</label>
                                    <input type="number" name="number" value="{{ $searchNumber }}" placeholder="000"
                                        class="w-full bg-white border border-slate-300 px-4 py-3 text-sm font-bold text-[#00388d] focus:border-[#00388d] focus:outline-none transition-all placeholder:text-slate-400">
                                </div>
                                <div class="md:col-span-3">
                                    <label
                                        class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ano</label>
                                    <input type="number" name="year" value="{{ $searchYear }}"
                                        placeholder="{{ date('Y') }}"
                                        class="w-full bg-white border border-slate-300 px-4 py-3 text-sm font-bold text-[#00388d] focus:border-[#00388d] focus:outline-none transition-all placeholder:text-slate-400">
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    {{ $items->total() }} DOCUMENTOS ENCONTRADOS
                                </span>
                                <div class="flex items-center gap-4 w-full sm:w-auto">
                                    @if ($searchName || $searchNumber || $searchYear)
                                        <a href="{{ url()->current() }}"
                                            class="text-[10px] font-black text-red-500 uppercase hover:underline tracking-widest">LIMPAR</a>
                                    @endif
                                    <button type="submit"
                                        class="flex-1 sm:flex-none px-8 py-3 bg-[#00388d] text-white font-black text-[10px] uppercase tracking-widest hover:bg-ueap-blue transition-colors">
                                        FILTRAR
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM OTIMIZADA --}}
                    <div class="space-y-4">
                        @forelse ($items as $item)
                            <article
                                class="group bg-white border border-slate-200 p-6 hover:border-ueap-green transition-all duration-300">
                                <div class="flex flex-col md:flex-row gap-6">
                                    {{-- Info lateral --}}
                                    <div
                                        class="shrink-0 flex md:flex-col items-center justify-between md:justify-center gap-2 md:w-24 md:bg-slate-50 md:border md:border-slate-100 p-2">
                                        <span class="text-ueap-green text-lg font-black">№ {{ $item->number }}</span>
                                        <span
                                            class="text-slate-400 text-[10px] font-bold uppercase">{{ $item->year }}</span>
                                    </div>

                                    {{-- Conteúdo --}}
                                    <div class="flex-1 flex flex-col md:flex-row justify-between gap-6 items-start">
                                        <div class="max-w-xl">
                                            <div
                                                class="text-[9px] font-bold text-[#00388d] uppercase tracking-widest mb-1 opacity-60">
                                                Publicado em {{ $item->created_at?->format('d/m/Y') }}
                                            </div>
                                            <h3
                                                class="text-lg font-black text-[#00388d] leading-tight mb-2 uppercase tracking-tight group-hover:text-ueap-green transition-colors">
                                                {{ $item->name ?? 'Documento Oficial' }}
                                            </h3>
                                            <p class="text-slate-600 text-sm leading-relaxed font-normal">
                                                {{ $item->description }}
                                            </p>
                                        </div>

                                        <div class="shrink-0">
                                            <a href="{{ $item->file_url ?? '#' }}" target="_blank"
                                                class="inline-flex items-center justify-center w-10 h-10 bg-slate-50 border border-slate-200 text-[#00388d] hover:bg-ueap-green hover:text-white hover:border-ueap-green transition-colors"
                                                title="Baixar PDF">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-16 text-center bg-slate-50 border border-slate-200">
                                <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Nenhum Registro
                                    Encontrado</span>
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
                    <div class="sticky top-28 space-y-12">
                        @include('novosite.components.sidebar-search')
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
