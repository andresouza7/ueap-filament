@extends('novosite.template.master')

@section('title', 'Publicações Oficiais - UEAP')

@section('content')

    <x-novosite.components.page-header
        :title="$title"
        subtitle="Conselho Universitário"
        :breadcrumb="[
            ['label' => 'Institucional', 'url' => '#'],
            ['label' => 'CONSU', 'url' => '#']
        ]"
    >
        <div class="flex items-center gap-2 text-slate-500 text-sm mt-4 font-medium bg-white/50 inline-block px-4 py-2 rounded-lg border border-gray-100">
            <i class="fa-solid fa-database text-ueap-secondary"></i>
            <span>Base de Dados Oficial: <strong>{{ $items->total() }}</strong> documentos disponíveis</span>
        </div>
    </x-novosite.components.page-header>

    <div class="max-w-ueap mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- LIST AREA --}}
            <div class="lg:col-span-8">

                {{-- FILTER BOX --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-10">
                    <h3 class="text-lg font-bold text-ueap-primary mb-6 flex items-center gap-2 pb-4 border-b border-gray-100">
                        <i class="fa-solid fa-filter"></i> Filtros de Pesquisa
                    </h3>

                    <form action="{{ url()->current() }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                            <div class="md:col-span-6">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Palavra-Chave</label>
                                <input type="text" name="name" value="{{ request('name') }}"
                                    placeholder="Ex: Regimento..."
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:border-ueap-primary focus:ring-1 focus:ring-ueap-primary outline-none transition-all">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Número</label>
                                <input type="number" name="number" value="{{ request('number') }}" placeholder="000"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:border-ueap-primary outline-none">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Ano</label>
                                <input type="number" name="year" value="{{ request('year') }}"
                                    placeholder="{{ date('Y') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:border-ueap-primary outline-none">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-gray-50">
                            @if (request()->anyFilled(['name', 'number', 'year']))
                                <a href="{{ url()->current() }}"
                                    class="px-4 py-2.5 rounded-lg text-sm font-bold text-red-500 hover:bg-red-50 transition-colors">
                                    Limpar
                                </a>
                            @endif
                            <button type="submit"
                                class="bg-ueap-primary text-white px-6 py-2.5 rounded-lg text-sm font-bold shadow-sm hover:bg-ueap-primary-hover transition-all">
                                Aplicar Filtros
                            </button>
                        </div>
                    </form>
                </div>

                {{-- RESULTS LIST --}}
                <div class="space-y-4">
                    @forelse ($items as $item)
                        <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-md transition-shadow flex flex-col sm:flex-row gap-5 items-start sm:items-center">

                            {{-- Number Box --}}
                            <div class="bg-gray-50 rounded-lg px-4 py-3 text-center border border-gray-100 min-w-[80px]">
                                <span class="block text-xl font-bold text-ueap-primary leading-none">{{ $item->number }}</span>
                                <span class="block text-xs font-bold text-slate-400 mt-1">{{ $item->year }}</span>
                            </div>

                            {{-- Content --}}
                            <div class="flex-1">
                                <div class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-1">
                                    Publicado em {{ $item->created_at?->format('d/m/Y') }}
                                </div>
                                <h4 class="text-base font-bold text-slate-800 leading-tight mb-2">
                                    {{ $item->name ?? 'Documento Oficial' }}
                                </h4>
                                <p class="text-slate-600 text-sm leading-relaxed line-clamp-2">
                                    {{ $item->description }}
                                </p>
                            </div>

                            {{-- Action --}}
                            <a href="{{ $item->file_url ?? '#' }}" target="_blank"
                                class="shrink-0 flex items-center gap-2 bg-white border border-gray-200 text-slate-700 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide hover:border-ueap-primary hover:text-ueap-primary transition-all">
                                <i class="fa-solid fa-file-pdf text-red-500"></i>
                                Baixar
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-16 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <p class="text-slate-500 font-medium">Nenhum documento encontrado.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-10">
                    {{ $items->links('novosite.components.post-paginator') }}
                </div>
            </div>

            {{-- INFO SIDEBAR --}}
            <aside class="lg:col-span-4 space-y-8">
                <div class="bg-ueap-primary rounded-xl p-8 text-white relative overflow-hidden shadow-lg">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info text-ueap-secondary"></i> Sobre o CONSU
                        </h4>
                        <p class="text-white/80 text-sm leading-relaxed mb-6">
                            O Conselho Universitário é o órgão máximo deliberativo da Universidade, responsável por formular a política universitária.
                        </p>
                        <div class="text-xs font-mono bg-black/20 p-3 rounded text-white/70">
                            Atualizado diariamente.
                        </div>
                    </div>
                </div>

                @include('novosite.components.sidebar-newsletter')
            </aside>

        </div>
    </div>
@endsection
