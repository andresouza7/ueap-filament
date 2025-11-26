@extends('novosite.template.master')

@section('title', 'Notícias')

@section('content')

<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Título --}}
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Notícias</h1>
            <div class="h-1 w-24 bg-ueap-green mt-3 rounded-full"></div>
        </div>

        {{-- Busca --}}
        <form method="GET" class="mb-10">
            <div class="flex gap-3">
                <input 
                    type="text" 
                    name="qry" 
                    value="{{ $searchString }}"
                    placeholder="Buscar notícias..."
                    class="w-full rounded-xl border-gray-300 px-4 py-3 
                           shadow-sm bg-white focus:ring-ueap-green focus:border-ueap-green"
                />

                <button 
                    class="px-6 py-3 rounded-xl bg-ueap-green text-white font-semibold cursor-pointer 
                           shadow hover:bg-green-700 transition">
                    Buscar
                </button>
            </div>
        </form>

        {{-- Lista de notícias --}}
        <div class="space-y-10">

            @forelse ($posts as $post)

                <article 
                    class="flex flex-col md:flex-row bg-white rounded-2xl shadow 
                           hover:shadow-lg transition overflow-hidden border border-gray-100">

                    {{-- Imagem grande --}}
                    <div class="md:w-80 h-56 md:h-auto overflow-hidden">
                        <img 
                            src="{{ $post->image_url ?: 'https://picsum.photos/600/400?random=' . $post->id }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-700"
                        >
                    </div>

                    {{-- Conteúdo --}}
                    <div class="flex flex-col p-6 flex-1">

                        {{-- Categoria + Data --}}
                        <div class="flex items-center gap-4 mb-2">
                            <span class="text-xs font-bold uppercase text-ueap-green tracking-wide">
                                {{ $post->category->description ?? 'Notícia' }}
                            </span>

                            <span class="text-xs text-gray-500 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $post->created_at->format('d/m/Y') }}
                            </span>
                        </div>

                        {{-- Título --}}
                        <a href="{{ route('novosite.post.show', $post->slug) }}">
                            <h2 class="text-xl font-bold text-gray-900 leading-snug hover:text-ueap-green transition">
                                {{ $post->title }}
                            </h2>
                        </a>

                        {{-- Preview --}}
                        <p class="text-gray-700 text-sm mt-3 line-clamp-3">
                            {{ clean_text(strip_tags($post->text)) }}
                        </p>

                        {{-- Botão --}}
                        <div class="mt-4">
                            <a href="{{ route('novosite.post.show', $post->slug) }}"
                                class="inline-block text-sm font-semibold text-ueap-green hover:underline">
                                Ler mais →
                            </a>
                        </div>

                    </div>

                </article>

            @empty

                <p class="text-gray-500 text-center py-20 text-lg">
                    Nenhuma notícia encontrada.
                </p>

            @endforelse

        </div>

        {{-- Paginação --}}
        <div class="mt-12">
            {{ $posts->links() }}
        </div>

    </div>
</section>

@endsection
