@extends('novosite.template.master')

@section('title', 'Publicações Oficiais - UEAP')

@section('content')
    @php
        $searchName = request('name');
        $searchNumber = request('number');
        $searchYear = request('year');

        // Split title safely
        $parts = explode(' ', $title, 2);
        $first = $parts[0] ?? 'Publicações';
        $second = $parts[1] ?? 'Oficiais';
    @endphp

    <x-novosite.components.page-header
        :title="$title"
        subtitle="Conselho Universitário"
        :breadcrumb="[
            ['label' => 'Institucional', 'url' => '#'],
            ['label' => 'CONSU', 'url' => '#']
        ]"
    >
        <div class="flex items-center gap-2 text-white/60 text-sm mt-4 font-medium">
            <i class="fa-solid fa-database"></i>
            <span>Base de Dados Oficial: {{ $items->total() }} documentos disponíveis</span>
        </div>
    </x-novosite.components.page-header>

    <main class="bg-gray-50 py-12 lg:py-16">
        <div class="max-w-ueap mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- FILTROS DE BUSCA --}}
                    <div class="mb-10">
                        <form action="{{ url()->current() }}" method="GET"
                            class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">

                            <h3 class="text-ueap-primary font-bold mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-filter"></i> Filtrar Documentos
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-6">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Palavra-Chave</label>
                                    <input type="text" name="name" value="{{ $searchName }}"
                                        placeholder="Ex: Regimento Interno..."
                                        class="w-full bg-slate-50 border border-slate-200 rounded px-3 py-2 text-sm focus:border-ueap-primary focus:outline-none transition-colors">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Número</label>
                                    <input type="number" name="number" value="{{ $searchNumber }}" placeholder="000"
                                        class="w-full bg-slate-50 border border-slate-200 rounded px-3 py-2 text-sm focus:border-ueap-primary focus:outline-none">
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Ano</label>
                                    <input type="number" name="year" value="{{ $searchYear }}"
                                        placeholder="{{ date('Y') }}"
                                        class="w-full bg-slate-50 border border-slate-200 rounded px-3 py-2 text-sm focus:border-ueap-primary focus:outline-none">
                                </div>
                            </div>

                            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-gray-50">
                                <span class="text-xs font-semibold text-slate-400">
                                    {{ $items->total() }} registros encontrados
                                </span>
                                <div class="flex items-center gap-3">
                                    @if ($searchName || $searchNumber || $searchYear)
                                        <a href="{{ url()->current() }}"
                                            class="text-xs font-bold text-red-500 hover:text-red-700 uppercase">Limpar Busca</a>
                                    @endif
                                    <button type="submit"
                                        class="bg-ueap-primary text-white px-6 py-2 rounded text-xs font-bold uppercase tracking-wider hover:bg-ueap-primary/90 transition-all shadow-sm">
                                        Filtrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- LISTAGEM OTIMIZADA --}}
                    <div class="space-y-4">
                        @forelse ($items as $item)
                            <article class="group bg-white rounded-lg border border-gray-100 hover:shadow-md transition-all duration-200 overflow-hidden flex flex-col sm:flex-row">
                                {{-- Info Lateral --}}
                                <div class="bg-gray-50 sm:w-32 p-4 flex flex-row sm:flex-col justify-between items-center sm:justify-center gap-2 border-b sm:border-b-0 sm:border-r border-gray-100 shrink-0">
                                    <span class="text-ueap-primary text-lg font-bold">№ {{ $item->number }}</span>
                                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider sm:border-t sm:border-gray-200 sm:pt-2 w-full text-center">
                                        {{ $item->year }}
                                    </span>
                                </div>

                                {{-- Conteúdo --}}
                                <div class="p-5 flex-1 flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
                                    <div class="flex-1">
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1">
                                            Publicado em {{ $item->created_at?->format('d/m/Y') }}
                                        </div>
                                        <h3 class="text-base font-bold text-slate-800 leading-tight mb-2 group-hover:text-ueap-primary transition-colors">
                                            {{ $item->name ?? 'Documento Oficial' }}
                                        </h3>
                                        <p class="text-slate-600 text-sm leading-relaxed">
                                            {{ $item->description }}
                                        </p>
                                    </div>

                                    <a href="{{ $item->file_url ?? '#' }}" target="_blank"
                                        class="shrink-0 flex items-center gap-2 bg-white border border-gray-200 text-slate-700 px-4 py-2 rounded text-xs font-bold uppercase tracking-wide hover:border-ueap-primary hover:text-ueap-primary transition-all">
                                        <i class="fa-solid fa-file-pdf"></i>
                                        PDF
                                    </a>
                                </div>
                            </article>
                        @empty
                            <div class="py-16 text-center border-2 border-dashed border-gray-200 rounded-lg bg-gray-50">
                                <i class="fa-regular fa-folder-open text-4xl text-gray-300 mb-4"></i>
                                <span class="block text-sm font-bold text-slate-500">Nenhum registro encontrado</span>
                            </div>
                        @endforelse
                    </div>

                    @if ($items->hasPages())
                        <div class="pt-12">
                            {{ $items->links('novosite.components.post-paginator') }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4 space-y-8">
                    @include('novosite.components.sidebar-newsletter')

                    <div class="bg-ueap-primary rounded-xl p-8 text-white relative overflow-hidden">
                         <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                        <div class="relative z-10">
                            <h4 class="text-ueap-secondary font-bold uppercase text-sm tracking-wider mb-2">Informação Técnica</h4>
                            <p class="text-white/80 text-sm leading-relaxed">
                                Esta seção contém as resoluções e decisões oficiais do Conselho Universitário da UEAP, disponíveis para consulta pública.
                            </p>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>
@endsection
