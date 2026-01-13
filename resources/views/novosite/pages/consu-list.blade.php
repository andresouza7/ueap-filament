@extends('novosite.template.master')

@section('title', 'Publicações Oficiais - UEAP')

@section('content')
    @php
        $searchName = request('name');
        $searchNumber = request('number');
        $searchYear = request('year');
    @endphp

    {{-- ================= HEADER ================= --}}
    <header class="bg-slate-950 border-b border-white/5 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none"
            style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <div class="max-w-4xl">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex items-center bg-emerald-500/10 text-emerald-400 text-[10px] font-black px-3 py-1 border border-emerald-500/20 uppercase tracking-[0.2em]">
                        <span class="w-1.5 h-1.5 bg-emerald-500 animate-pulse mr-2"></span>
                        Repositório de Documentos
                    </span>
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest">// DB_LEGAL_UEAP</span>
                </div>

                <h1 class="text-4xl md:text-6xl font-black text-white leading-none tracking-tighter mb-4 italic uppercase">
                    Consultar<br class="hidden md:block"> <span class="text-emerald-500">Publicações</span>
                </h1>
            </div>
        </div>
    </header>

    <main class="bg-white py-12 relative">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA (8 ESPAÇOS) --}}
                <div class="lg:col-span-8">
                    
                    {{-- BARRA DE PESQUISA --}}
                    <div class="mb-8">
                        <form action="{{ url()->current() }}" method="GET" class="bg-slate-50 border border-slate-200 p-2 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-2">
                                {{-- Campo Nome/Descrição --}}
                                <div class="md:col-span-6 bg-white border border-slate-200 focus-within:border-emerald-500 transition-all p-2">
                                    <label class="block text-[8px] font-mono font-bold text-slate-400 uppercase tracking-widest mb-1">Palavra-Chave</label>
                                    <input type="text" name="name" value="{{ $searchName }}" placeholder="DESCRIÇÃO OU NOME"
                                        class="w-full bg-transparent text-sm font-bold text-slate-800 focus:outline-none uppercase">
                                </div>

                                {{-- Campo Número --}}
                                <div class="md:col-span-3 bg-white border border-slate-200 focus-within:border-emerald-500 transition-all p-2">
                                    <label class="block text-[8px] font-mono font-bold text-slate-400 uppercase tracking-widest mb-1">Número</label>
                                    <input type="number" name="number" value="{{ $searchNumber }}" placeholder="000"
                                        class="w-full bg-transparent text-sm font-bold text-slate-800 focus:outline-none">
                                </div>

                                {{-- Campo Ano --}}
                                <div class="md:col-span-3 bg-white border border-slate-200 focus-within:border-emerald-500 transition-all p-2">
                                    <label class="block text-[8px] font-mono font-bold text-slate-400 uppercase tracking-widest mb-1">Ano</label>
                                    <input type="number" name="year" value="{{ $searchYear }}" placeholder="{{ date('Y') }}"
                                        class="w-full bg-transparent text-sm font-bold text-slate-800 focus:outline-none">
                                </div>
                            </div>

                            <div class="mt-2 flex items-center justify-between px-1">
                                <div class="text-[9px] font-mono text-slate-400 uppercase tracking-widest">
                                    @if($items->total() > 0)
                                        Total: {{ $items->total() }} registros_encontrados
                                    @endif
                                </div>
                                <div class="flex gap-4 items-center">
                                    @if($searchName || $searchNumber || $searchYear)
                                        <a href="{{ url()->current() }}" class="text-[9px] font-black text-red-500 uppercase tracking-widest hover:underline">
                                            Limpar_Filtros
                                        </a>
                                    @endif
                                    <button type="submit" class="bg-slate-900 text-white px-6 py-2 text-[10px] font-black uppercase tracking-[0.2em] hover:bg-emerald-600 transition-colors">
                                        Executar_Busca
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM DE REGISTROS --}}
                    <div class="space-y-1">
                        @forelse ($items as $item)
                            @php
                                $title = $item->name ?? $item->description;
                                $fileUrl = $item->file_url ?? '#';
                            @endphp

                            <div class="group flex flex-col sm:flex-row sm:items-center gap-4 p-4 border-b border-slate-100 hover:bg-slate-50 transition-all">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                            <span class="text-[10px] font-mono font-bold text-emerald-600 bg-emerald-50 px-2">
                                                Nº {{ $item->number }}/{{ $item->year }}
                                            </span>
                                            <span class="text-[10px] font-mono text-slate-400">
                                                {{ $item->created_at?->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    <h3 class="text-sm font-bold text-slate-800 uppercase leading-snug group-hover:text-emerald-600 transition-colors">
                                        {{ $title }}
                                    </h3>
                                </div>

                                <div class="shrink-0">
                                    <a href="{{ $fileUrl }}" target="_blank" 
                                       class="inline-flex items-center gap-2 bg-slate-100 px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all border border-transparent">
                                        <i class="fa-solid fa-file-lines"></i>
                                        Visualizar
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center border border-dashed border-slate-200 bg-slate-50/50">
                                <i class="fa-solid fa-database text-slate-200 text-4xl mb-4"></i>
                                <p class="text-slate-400 text-xs font-mono uppercase tracking-widest">Nenhum registro encontrado no sistema.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- PAGINAÇÃO --}}
                    @if ($items->hasPages())
                        <div class="pt-8">
                            {{ $items->links('novosite.components.post-paginator') }}
                        </div>
                    @endif
                </div>

                {{-- COLUNA DA DIREITA (4 ESPAÇOS - VAZIA) --}}
                <aside class="lg:col-span-4">
                    <div class="sticky top-8 space-y-4">
                        {{-- Espaço reservado para o seu conteúdo --}}
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection