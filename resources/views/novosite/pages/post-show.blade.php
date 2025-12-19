@extends('novosite.template.master')

@section('title', isset($post->title) ? $post->title : (isset($post->slug) ? str_replace('-', ' ', ucfirst($post->slug))
    : 'Notícia'))

@section('content')

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
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-none mb-4">
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
                            <?php
                            // Captura a URL atual de forma dinâmica
                            $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
                            $url_atual = urlencode($protocolo . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                            ?>

                            <div class="hidden md:flex ml-auto space-x-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url_atual ?>" target="_blank"
                                    rel="noopener noreferrer"
                                    class="p-2 rounded-full hover:bg-gray-100 text-gray-500 transition"
                                    title="Compartilhar no Facebook">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>

                                {{-- <a href="https://www.instagram.com/SEU_USUARIO" target="_blank" rel="noopener noreferrer"
                                    class="p-2 rounded-full hover:bg-gray-100 text-gray-500 transition"
                                    title="Ver no Instagram">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07M12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                    </svg>
                                </a> --}}

                                <a href="https://api.whatsapp.com/send?text=Confira%20isso:%20<?= $url_atual ?>"
                                    target="_blank" rel="noopener noreferrer"
                                    class="p-2 rounded-full hover:bg-gray-100 text-gray-500 transition"
                                    title="Compartilhar no WhatsApp">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
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
                        {!! $post->text !!}
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

                    <!-- Newsletter Widget -->
                    <div class="bg-ueap-dark rounded-xl p-6 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="font-bold text-xl mb-2">Fique por dentro</h3>
                            <p class="text-gray-300 text-sm mb-4">Receba as principais notícias da UEAP diretamente no
                                seu e-mail.</p>
                            <form>
                                <input type="email" placeholder="Seu melhor e-mail"
                                    class="w-full px-4 py-2 bg-white rounded-lg text-gray-900 mb-2 focus:outline-none focus:ring-2 focus:ring-ueap-green">
                                <button type="submit"
                                    class="w-full bg-ueap-green hover:bg-green-600 hover:cursor-pointer font-bold py-2 rounded-lg transition text-sm">Inscrever-se</button>
                            </form>
                        </div>
                        <!-- Decorative circle -->
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white opacity-5 rounded-full"></div>
                    </div>

                </aside>
            </div>

            <!-- Read Also (Bottom Grid) -->
            <section class="mt-16 pt-12 border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Veja também</h2>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach ($relatedPosts as $post)
                        <a href="/" class="group block">
                            <div class="aspect-video rounded-xl overflow-hidden mb-4">
                                <img src="{{ $post->image ?? 'https://picsum.photos/600/400' }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            </div>

                            <h3
                                class="font-bold text-lg text-gray-900 group-hover:text-ueap-green transition leading-tight mb-2">
                                {{ $post->title }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </section>


        </div>
    </main>

@endsection
