@extends('novosite.template.master')

@section('title', 'Notícias e Eventos')

@section('content')
    <x-novosite.components.page-header
        title="Central de Conteúdo"
        subtitle="Notícias e Atualizações"
        :breadcrumb="[
            ['label' => 'Notícias', 'url' => route('site.post.list')]
        ]"
    />

    <div class="max-w-ueap mx-auto px-4 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- MAIN LIST --}}
            <div class="lg:col-span-8">

                {{-- Toolbar (Mobile mostly) --}}
                <div class="lg:hidden mb-6">
                    <button @click="$dispatch('toggle-filters')" class="w-full bg-white border border-gray-200 p-3 rounded-lg font-bold text-slate-700 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-filter"></i> Filtrar Conteúdo
                    </button>
                </div>

                <div class="space-y-8">
                    @forelse ($posts as $item)
                        <article class="flex flex-col md:flex-row gap-6 bg-white p-6 rounded-2xl border border-gray-100 hover:border-gray-200 hover:shadow-md transition-all group">
                            {{-- Image --}}
                            <a href="{{ route('site.post.show', $item->slug) }}" class="shrink-0 w-full md:w-64 h-48 rounded-xl overflow-hidden bg-gray-100 relative">
                                <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <span class="absolute top-3 left-3 bg-white/95 text-ueap-primary text-[10px] font-bold px-2 py-1 rounded shadow-sm uppercase">
                                    {{ $item->type == 'event' ? 'Evento' : 'Notícia' }}
                                </span>
                            </a>

                            {{-- Content --}}
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-center gap-3 text-xs font-medium text-slate-400 mb-2">
                                    <span class="text-ueap-secondary font-bold uppercase tracking-wide">
                                        {{ $item->categories->first()->name ?? 'Geral' }}
                                    </span>
                                    <span>&bull;</span>
                                    <time>{{ $item->created_at->format('d/m/Y') }}</time>
                                </div>

                                <h2 class="text-xl font-bold text-slate-800 mb-3 leading-tight group-hover:text-ueap-primary transition-colors">
                                    <a href="{{ route('site.post.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h2>

                                <p class="text-slate-600 text-sm leading-relaxed line-clamp-2 mb-4">
                                    {{ $item->resume ?? Str::limit(strip_tags($item->text), 140) }}
                                </p>

                                <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                                    <a href="{{ route('site.post.show', $item->slug) }}" class="text-sm font-bold text-ueap-primary hover:underline decoration-ueap-secondary underline-offset-4">
                                        Ler Completo
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-20 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-4"></i>
                            <p class="text-slate-500 font-medium">Nenhum conteúdo encontrado para sua busca.</p>
                            <a href="{{ route('site.post.list') }}" class="text-sm text-ueap-primary font-bold mt-2 inline-block">Limpar filtros</a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $posts->links('novosite.components.post-paginator') }}
                </div>
            </div>

            {{-- SIDEBAR --}}
            <aside class="lg:col-span-4 space-y-8">

                {{-- Search Widget --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 pb-2 border-b border-gray-100">Buscar</h3>
                    <form action="{{ route('site.post.list') }}" method="GET" class="space-y-4">
                        <div class="relative">
                            <i class="fa-solid fa-search absolute left-3 top-3.5 text-slate-400 text-sm"></i>
                            <input type="text" name="search" value="{{ $searchString ?? '' }}" placeholder="Palavra-chave..."
                                   class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:border-ueap-primary focus:ring-1 focus:ring-ueap-primary outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Tipo de Conteúdo</label>
                            <div class="flex gap-2">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="type" value="news" class="peer hidden" {{ request('type') == 'news' ? 'checked' : '' }}>
                                    <span class="block text-center px-3 py-2 rounded-lg bg-gray-50 border border-gray-200 text-slate-600 text-xs font-bold peer-checked:bg-ueap-primary peer-checked:text-white peer-checked:border-ueap-primary transition-all">Notícias</span>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="type" value="event" class="peer hidden" {{ request('type') == 'event' ? 'checked' : '' }}>
                                    <span class="block text-center px-3 py-2 rounded-lg bg-gray-50 border border-gray-200 text-slate-600 text-xs font-bold peer-checked:bg-ueap-primary peer-checked:text-white peer-checked:border-ueap-primary transition-all">Eventos</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-ueap-primary text-white font-bold py-2.5 rounded-lg hover:bg-ueap-primary-hover transition-colors shadow-sm text-sm">
                            Filtrar Resultados
                        </button>

                        @if(request()->anyFilled(['search', 'type']))
                            <a href="{{ route('site.post.list') }}" class="block text-center text-xs text-red-500 font-bold hover:underline">Limpar Filtros</a>
                        @endif
                    </form>
                </div>

                {{-- Categories Widget --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 pb-2 border-b border-gray-100">Categorias</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $cat)
                            <a href="{{ route('site.post.list', ['category' => $cat->slug]) }}"
                               class="px-3 py-1.5 rounded-full border border-gray-200 bg-gray-50 text-xs font-medium text-slate-600 hover:bg-ueap-primary hover:text-white hover:border-ueap-primary transition-all">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Newsletter --}}
                @include('novosite.components.sidebar-newsletter')
            </aside>

        </div>
    </div>
@endsection
