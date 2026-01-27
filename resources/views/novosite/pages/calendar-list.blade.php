@extends('novosite.template.master')

@section('title', 'Calendário Acadêmico - UEAP')

@section('content')
    @php
        $search = request('search');
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
                        Repositório
                    </span>

                    <span class="text-[11px] font-mono uppercase tracking-widest text-slate-500">
                        Documentos
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
                    Calendário Acadêmico<span class="text-ueap-green">.</span>
                </h1>

                {{-- Barra final inferior --}}
                <div class="flex items-center justify-between pt-6 border-t border-slate-300">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-mono uppercase tracking-widest text-slate-400">
                            Arquivos Oficiais
                        </span>
                        <div class="h-1 w-12 bg-ueap-green"></div>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="bg-white py-16" id="main-content">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- FILTRO --}}
                    <div class="mb-10 bg-slate-50 p-6 border border-slate-200">
                        <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <label for="search-input"
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Filtrar
                                    Documentos</label>
                                <div
                                    class="flex items-center bg-white border border-slate-300 px-4 py-3 focus-within:border-[#00388d] transition-colors">
                                    <i class="fa-solid fa-search text-slate-400 mr-3"></i>
                                    <input type="text" name="search" id="search-input" value="{{ $search }}"
                                        placeholder="DIGITE O NOME DO ARQUIVO..."
                                        class="w-full bg-transparent text-sm font-bold text-[#00388d] focus:outline-none placeholder:text-slate-400 uppercase tracking-wide">
                                </div>
                            </div>
                            <div class="flex items-end">
                                <button type="submit"
                                    class="w-full md:w-auto px-8 py-3 bg-[#00388d] text-white font-black text-[10px] uppercase tracking-widest hover:bg-ueap-blue transition-colors">
                                    BUSCAR
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM DE ARQUIVOS --}}
                    <div class="space-y-4" role="list">
                        @forelse ($items as $item)
                            <article
                                class="group bg-white border border-slate-200 p-6 hover:border-ueap-green transition-all duration-300 relative"
                                role="listitem">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4">
                                            {{-- Ícone do Arquivo --}}
                                            <div
                                                class="shrink-0 w-12 h-12 bg-slate-50 flex items-center justify-center text-red-600 border border-slate-200">
                                                <i class="fa-solid fa-file-pdf text-2xl"></i>
                                            </div>

                                            <div class="flex flex-col">
                                                <h2
                                                    class="text-lg font-black text-[#00388d] leading-tight group-hover:text-ueap-green transition-colors mb-2 uppercase tracking-tight">
                                                    {{ $item->title }}
                                                </h2>

                                                <div
                                                    class="flex items-center gap-4 text-[10px] text-slate-500 font-bold uppercase tracking-wider">
                                                    <div class="flex items-center gap-1.5">
                                                        <i class="fa-regular fa-calendar"></i>
                                                        {{ $item->created_at?->format('d/m/Y') }}
                                                    </div>
                                                    <span class="w-1 h-1 bg-slate-300"></span>
                                                    <span>ID: #{{ $item->id }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="shrink-0 pl-16 md:pl-0">
                                        <a href="{{ $item->file_url }}" target="_blank"
                                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-50 border border-slate-200 text-[#00388d] font-black text-[10px] uppercase tracking-widest hover:bg-ueap-green hover:text-white hover:border-ueap-green transition-colors">
                                            <span>BAIXAR PDF</span>
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-16 text-center bg-slate-50 border border-slate-200">
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Nenhum arquivo
                                    encontrado.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- PAGINAÇÃO --}}
                    @if (method_exists($items, 'hasPages') && $items->hasPages())
                        <div class="pt-12">
                            {{ $items->links('novosite.components.post-paginator') }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4" role="complementary">
                    <div class="sticky top-28 space-y-12">
                        @include('novosite.components.sidebar-search')
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
