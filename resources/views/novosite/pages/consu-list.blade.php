@extends('novosite.template.master')

@section('title', 'Publicações Oficiais - UEAP')

@section('content')
    @php
        $searchName = request('name');
        $searchNumber = request('number');
        $searchYear = request('year');
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
                        CONSELHO UNIVERSITÁRIO
                    </span>
                    <span class="text-[10px] font-mono text-slate-500 uppercase tracking-widest" aria-hidden="true">//
                        CONSULTA_DOCUMENTOS</span>
                </div>

                @php
                    // Divide o título por espaços
                    $parts = explode(' ', $title, 2);
                    $first = $parts[0] ?? '';
                    $second = $parts[1] ?? '';
                @endphp

                <h1 class="text-4xl md:text-6xl font-black text-white leading-none tracking-tighter mb-4 italic uppercase">
                    {{ $first }}
                    @if ($second)
                        <br class="hidden md:block">
                        <span class="text-emerald-500">{{ $second }}</span>
                    @endif
                </h1>
            </div>
        </div>
    </header>

    <main class="bg-white py-12 relative" id="main-content">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA (8 ESPAÇOS) --}}
                <div class="lg:col-span-8">

                    {{-- BARRA DE PESQUISA - RESPONSIVA + ACESSIBILIDADE --}}
                    <div class="mb-8" aria-label="Filtros de busca">
                        <form action="{{ url()->current() }}" method="GET"
                            class="bg-slate-50 border border-slate-200 p-2 shadow-sm" role="search">
                            {{-- Grid: 1 coluna no mobile para não quebrar, 12 no desktop --}}
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-2">

                                {{-- Campo Nome/Descrição --}}
                                <div
                                    class="md:col-span-6 bg-white border border-slate-200 focus-within:border-emerald-500 transition-all p-2">
                                    <label for="search-name"
                                        class="block text-[8px] font-mono font-bold text-slate-400 uppercase tracking-widest mb-1">Palavra-Chave</label>
                                    <input type="text" name="name" id="search-name" value="{{ $searchName }}"
                                        placeholder="DESCRIÇÃO OU NOME" aria-label="Filtrar por descrição ou nome"
                                        class="w-full bg-transparent text-sm font-bold text-slate-800 focus:outline-none uppercase">
                                </div>

                                {{-- Campo Número --}}
                                <div
                                    class="md:col-span-3 bg-white border border-slate-200 focus-within:border-emerald-500 transition-all p-2">
                                    <label for="search-number"
                                        class="block text-[8px] font-mono font-bold text-slate-400 uppercase tracking-widest mb-1">Número</label>
                                    <input type="number" name="number" id="search-number" value="{{ $searchNumber }}"
                                        placeholder="000" aria-label="Filtrar por número do documento"
                                        class="w-full bg-transparent text-sm font-bold text-slate-800 focus:outline-none">
                                </div>

                                {{-- Campo Ano --}}
                                <div
                                    class="md:col-span-3 bg-white border border-slate-200 focus-within:border-emerald-500 transition-all p-2">
                                    <label for="search-year"
                                        class="block text-[8px] font-mono font-bold text-slate-400 uppercase tracking-widest mb-1">Ano</label>
                                    <input type="number" name="year" id="search-year" value="{{ $searchYear }}"
                                        placeholder="{{ date('Y') }}" aria-label="Filtrar por ano"
                                        class="w-full bg-transparent text-sm font-bold text-slate-800 focus:outline-none">
                                </div>
                            </div>

                            {{-- Footer: flex-col no mobile evita que o texto atropele os botões --}}
                            <div class="mt-2 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between px-1">
                                {{-- Status de resultados para leitor de tela --}}
                                <div class="text-[9px] font-mono text-slate-400 uppercase tracking-widest" role="status"
                                    aria-live="polite">
                                    @if ($items->total() > 0)
                                        Total: <span class="sr-only">Encontrados</span> {{ $items->total() }}
                                        registros_encontrados
                                    @endif
                                </div>

                                <div class="flex gap-4 items-center justify-end">
                                    @if ($searchName || $searchNumber || $searchYear)
                                        <a href="{{ url()->current() }}"
                                            aria-label="Limpar todos os filtros de busca aplicados"
                                            class="text-[9px] font-black text-red-500 uppercase tracking-widest hover:underline whitespace-nowrap">
                                            Limpar_Filtros
                                        </a>
                                    @endif
                                    <button type="submit" aria-label="Clique para pesquisar com os filtros selecionados"
                                        class="bg-slate-900 text-white px-6 py-2 text-[10px] font-black uppercase tracking-[0.2em] hover:bg-emerald-600 transition-colors whitespace-nowrap">
                                        Executar_Busca
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM DE REGISTROS --}}
                    <div class="space-y-1" role="list" aria-label="Lista de publicações">
                        @forelse ($items as $item)
                            @php
                                $title = $item->name ?? $item->description;
                                $fileUrl = $item->file_url ?? '#';
                            @endphp

                            <article
                                class="group flex flex-col sm:flex-row sm:items-center gap-4 p-4 border-b border-slate-100 hover:bg-slate-50 transition-all"
                                role="listitem">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[10px] font-mono font-bold text-emerald-600 bg-emerald-50 px-2">
                                            <span class="sr-only">Número do documento:</span> Nº
                                            {{ $item->number }}/{{ $item->year }}
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-400">
                                            <span class="sr-only">Publicado em:</span>
                                            {{ $item->created_at?->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    <h3
                                        class="text-sm font-bold text-slate-800 leading-snug group-hover:text-emerald-600 transition-colors">
                                        {{ $title }}
                                    </h3>
                                </div>

                                <div class="shrink-0">
                                    <a href="{{ $fileUrl }}" target="_blank"
                                        aria-label="Visualizar documento: {{ $title }} (abre em nova aba)"
                                        class="inline-flex items-center gap-2 bg-slate-100 px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-600 group-hover:bg-slate-900 group-hover:text-white transition-all border border-transparent">
                                        <i class="fa-solid fa-file-lines" aria-hidden="true"></i>
                                        Visualizar
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="py-20 text-center border border-dashed border-slate-200 bg-slate-50/50"
                                role="alert">
                                <i class="fa-solid fa-database text-slate-200 text-4xl mb-4" aria-hidden="true"></i>
                                <p class="text-slate-400 text-xs font-mono uppercase tracking-widest">Nenhum registro
                                    encontrado no sistema.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- PAGINAÇÃO --}}
                    @if ($items->hasPages())
                        <nav class="pt-8" aria-label="Navegação da listagem">
                            {{ $items->links('novosite.components.post-paginator') }}
                        </nav>
                    @endif
                </div>

                {{-- COLUNA DA DIREITA --}}
                <aside class="lg:col-span-4" role="complementary">
                    <div class="sticky top-8 space-y-4">
                        @include('novosite.components.sidebar-newsletter')
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
