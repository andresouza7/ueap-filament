@extends('novosite.template.master')

@section('title', 'Explorar Publicações - UEAP')

@section('content')
    <x-novosite.components.page-header
        title="Central de Conteúdo"
        subtitle="Notícias e Eventos"
        :breadcrumb="[
            ['label' => 'Publicações', 'url' => route('site.post.list')]
        ]"
    />

    <main class="bg-gray-50 py-12 lg:py-16">
        <div class="max-w-ueap mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- COLUNA DA ESQUERDA --}}
                <div class="lg:col-span-8">

                    {{-- CAIXA DE BUSCA E FILTROS --}}
                    <div class="mb-10">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                            <form action="{{ route('site.post.list') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                                @php $currentType = request('type'); @endphp
                                @if ($currentType) <input type="hidden" name="type" value="{{ $currentType }}"> @endif

                                {{-- Input Search --}}
                                <div class="flex-1 relative">
                                    <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                    <input type="text" name="search" value="{{ $searchString ?? '' }}"
                                        placeholder="Buscar por termo..."
                                        class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-12 pr-4 py-3 text-sm focus:border-ueap-primary focus:ring-1 focus:ring-ueap-primary outline-none transition-all">
                                </div>

                                {{-- Tipos de Filtro --}}
                                <div class="flex gap-2">
                                    @foreach ([['label' => 'Notícias', 'val' => 'news'], ['label' => 'Eventos', 'val' => 'event']] as $t)
                                        <a href="{{ route('site.post.list', ['type' => $t['val']]) }}" 
                                           class="px-5 py-3 rounded-lg text-sm font-bold transition-all border {{ request('type') == $t['val'] ? 'bg-ueap-primary text-white border-ueap-primary' : 'bg-white text-slate-600 border-slate-200 hover:border-ueap-primary hover:text-ueap-primary' }}">
                                            {{ $t['label'] }}
                                        </a>
                                    @endforeach
                                    <button type="submit" class="bg-ueap-secondary text-ueap-primary px-6 py-3 rounded-lg text-sm font-bold hover:bg-ueap-secondary/90 transition-all shadow-sm">
                                        Filtrar
                                    </button>
                                </div>
                            </form>

                            @if(request()->anyFilled(['search', 'type']))
                                <div class="mt-4 flex justify-end">
                                    <a href="{{ route('site.post.list') }}" class="text-xs font-semibold text-red-500 hover:text-red-700 flex items-center gap-1">
                                        <i class="fa-solid fa-times"></i> Limpar Filtros
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- LISTAGEM DE POSTS --}}
                    <div class="space-y-8">
                        @forelse ($posts as $item)
                            <article class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col md:flex-row h-full">
                                {{-- Thumbnail --}}
                                <div class="md:w-64 h-48 md:h-auto shrink-0 bg-gray-100 relative overflow-hidden">
                                    <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-ueap-primary text-xs font-bold px-3 py-1 rounded shadow-sm">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-6 flex-1 flex flex-col justify-between">
                                    <div>
                                        <span class="text-xs font-bold text-ueap-secondary uppercase tracking-wide mb-2 block">
                                            {{ $item->categories->first()->name ?? 'Geral' }}
                                        </span>
                                        <h3 class="text-xl font-bold text-slate-800 leading-tight mb-3 group-hover:text-ueap-primary transition-colors">
                                            <a href="{{ route('site.post.show', $item->slug) }}">
                                                {{ $item->title }}
                                            </a>
                                        </h3>
                                        <p class="text-slate-600 text-sm leading-relaxed line-clamp-2">
                                            {{ $item->resume ?? Str::limit(strip_tags($item->text), 140) }}
                                        </p>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-gray-50 flex justify-end">
                                        <a href="{{ route('site.post.show', $item->slug) }}"
                                            class="text-sm font-semibold text-ueap-primary flex items-center gap-2 group/link">
                                            Ler mais
                                            <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover/link:translate-x-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="py-16 text-center border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                                <i class="fa-regular fa-folder-open text-4xl text-gray-300 mb-4"></i>
                                <p class="text-slate-500 font-medium">Nenhum registro encontrado.</p>
                            </div>
                        @endforelse
                    </div>

                    @if ($posts->hasPages())
                        <div class="pt-12">
                            {{ $posts->links('novosite.components.post-paginator') }}
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-4 space-y-8">
                    @include('novosite.components.sidebar-newsletter')

                    <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                        <h4 class="text-ueap-primary font-bold text-lg mb-4 border-b border-gray-100 pb-2">Categorias</h4>
                        @include('novosite.components.sidebar-categories', ['categories' => $categories])
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
