@extends('novosite.template.master')

@section('title', isset($post->title) ? $post->title : (isset($post->slug) ? str_replace('-', ' ', ucfirst($post->slug))
    : 'Notícia'))

@section('content')

    <style>
        /* Tipografia editorial (o que não fica ideal só com Tailwind) */
        .article-body p {
            @apply mb-6 leading-relaxed text-slate-700 text-lg;
            font-family: 'Merriweather', serif !important;
        }

        .article-body h2 {
            @apply mt-10 mb-4 text-3xl font-bold text-gray-900 tracking-tight;
        }

        .article-body ul {
            @apply list-disc ml-6 mb-6 text-slate-700;
            font-family: 'Merriweather', serif;
        }

        .article-body li {
            @apply mb-2;
        }

        .article-body blockquote {
            @apply my-8 p-6 bg-slate-50 border-l-4 border-green-600 italic text-gray-600 text-xl rounded-r-lg;
        }
    </style>

    <main class="bg-gray-50 py-10">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-500 mb-8">
                <ol class="flex flex-wrap items-center gap-2">
                    <li>
                        <a href="{{ url('/') }}" class="hover:text-green-600">Início</a>
                    </li>
                    <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                    <li>
                        <a href="/" class="hover:text-green-600">Notícias</a>
                    </li>
                    <li><i class="fa-solid fa-chevron-right text-xs"></i></li>
                    <li class="font-bold uppercase text-green-600">
                        {{ $post->category->name ?? 'Institucional' }}
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                {{-- Artigo --}}
                <article class="lg:col-span-8 bg-white rounded-2xl shadow-sm p-8 md:p-12">

                    {{-- Cabeçalho --}}
                    <header class="mb-10">
                        <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                            {{ $post->title }}
                        </h1>

                        @if ($post->description)
                            <p class="text-xl text-gray-600 mb-8">
                                {{ $post->description }}
                            </p>
                        @endif

                        {{-- Autor e data --}}
                        <div class="flex flex-wrap items-center gap-6 border-y border-gray-100 py-4 text-sm">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($post->author->name ?? 'UEAP', 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $post->author->name ?? 'Assessoria de Comunicação' }}
                                    </p>
                                    <p class="text-gray-500">
                                        {{ $post->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Compartilhar --}}
                            <div class="flex gap-2 ml-auto">
                                <a href="#" class="p-2 rounded-full hover:bg-gray-100 text-gray-500">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="#" class="p-2 rounded-full hover:bg-gray-100 text-gray-500">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                                <a href="#" class="p-2 rounded-full hover:bg-gray-100 text-gray-500">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </header>

                    {{-- Imagem --}}
                    @if (true)
                        <figure class="mb-10">
                            <img src="https://picsum.photos/1200/630" alt="{{ $post->title }}"
                                class="w-full rounded-xl shadow-lg">
                            @if ($post->image_caption)
                                <figcaption class="text-sm text-gray-500 text-center italic mt-2">
                                    {{ $post->image_caption }}
                                </figcaption>
                            @endif
                        </figure>
                    @endif

                    {{-- Conteúdo --}}
                    <div class="article-body prose max-w-none">
                        {{-- {!! $post->text !!} --}}
                       A Universidade do Estado do Amapá (UEAP) deu um passo importante nesta terça-feira (10) para a consolidação de sua estratégia de internacionalização. Em reunião realizada no Campus I, a Reitoria recebeu representantes diplomáticos e acadêmicos de cinco universidades europeias para discutir a criação de novos acordos de cooperação técnica e mobilidade acadêmica.
                    </div>

                    {{-- Tags --}}
                    @if ($post->tags?->count())
                        <div class="mt-12 pt-8 border-t">
                            <h4 class="text-sm font-bold text-gray-500 uppercase mb-4">
                                Tópicos relacionados
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($post->tags as $tag)
                                    <a href="/"
                                        class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600 hover:bg-green-100 hover:text-green-800 transition">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </article>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4 space-y-8">

                    {{-- Busca --}}
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <h3 class="font-bold mb-4">Buscar Notícias</h3>
                        <div class="relative">
                            <input type="text" placeholder="Digite sua busca..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-ueap-green focus:ring-1 focus:ring-ueap-green">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>

                    {{-- Últimas --}}
                    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold border-l-4 border-green-600 pl-3">
                                Últimas Notícias
                            </h3>
                            <a href="/" class="text-xs font-semibold text-green-600">
                                Ver todas
                            </a>
                        </div>

                        <div class="space-y-6">
                            @foreach ($latestPosts as $item)
                                <a href="/" class="flex gap-4 group">
                                    <img src="https://picsum.photos/200/150"
                                        class="w-20 h-20 rounded-lg object-cover group-hover:scale-105 transition">
                                    <div>
                                        <span class="text-xs font-bold uppercase text-green-600 block">
                                            {{ $item->category->name }}
                                        </span>
                                        <h4 class="text-sm font-semibold text-gray-900 group-hover:text-green-600">
                                            {{ $item->title }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </main>

@endsection
