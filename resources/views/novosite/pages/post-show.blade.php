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

                        @php
                            $url_atual = urlencode(url()->current());
                        @endphp

                        {{-- Autor e data --}}
                        <div class="flex flex-wrap items-center gap-6 border-y border-gray-100 py-4 text-sm">

                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-green-600 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($post->author->name ?? 'UE', 0, 2)) }}
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
                            <div class="hidden md:flex ml-auto space-x-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="p-2 rounded-full hover:bg-gray-100 text-gray-500 transition"
                                    title="Compartilhar no Facebook">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="p-2 rounded-full hover:bg-gray-100 text-gray-500 transition"
                                    title="Compartilhar no WhatsApp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            </div>

                        </div>
                    </header>

                    {{-- Conteúdo --}}
                    <div class="article-body prose max-w-none">

                        @php
                            $mediaItems = $post->getMedia();
                            $mediaCount = $mediaItems->count();
                        @endphp

                        @foreach ($post->content ?? [] as $block)
                            @switch($block['type'])
                                {{-- TEXTO --}}
                                @case('text')
                                    {!! clean_text($block['data']['body'] ?? '') !!}
                                @break

                                {{-- IMAGEM / GALERIA --}}
                                @case('image')
                                @case('gallery')
                                    @if ($mediaCount === 1)
                                        <figure class="my-10 border-gray-100 border-b-1">
                                            <div class="w-full aspect-video overflow-hidden rounded-xl shadow-lg">
                                                <img src="{{ $mediaItems->first()->getUrl() }}" alt="{{ $post->title }}"
                                                    class="w-full h-full object-cover">
                                            </div>

                                            @if (!empty($block['data']['subtitle']))
                                                <figcaption class="text-sm text-gray-500 text-center italic mt-2">
                                                    {{ $block['data']['subtitle'] }}
                                                    @if (!empty($block['data']['credits']))
                                                        — {{ $block['data']['credits'] }}
                                                    @endif
                                                </figcaption>
                                            @endif
                                        </figure>
                                    @elseif ($mediaCount > 1)
                                        <section class="my-12">
                                            <div
                                                class="flex gap-4 overflow-x-auto scroll-smooth snap-x snap-mandatory
                                            pb-4 -mx-2 px-2">

                                                @foreach ($mediaItems as $media)
                                                    <div class="snap-center shrink-0 w-[85%] md:w-[60%] lg:w-[50%]">
                                                        <div class="aspect-video overflow-hidden rounded-xl shadow-lg">
                                                            <img src="{{ $media->getUrl() }}" alt="{{ $post->title }}"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>

                                            <div class="flex justify-center gap-2 mt-3">
                                                @foreach ($mediaItems as $_)
                                                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                                                @endforeach
                                            </div>

                                            @if (!empty($block['data']['credits']))
                                                <p class="text-sm text-gray-500 text-center italic mt-3">
                                                    {{ $block['data']['credits'] }}
                                                </p>
                                            @endif
                                        </section>
                                    @endif
                                @break
                            @endswitch
                        @endforeach

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
                            <a href="{{ route('novosite.post.list') }}" class="text-xs font-semibold text-green-600">
                                Ver todas
                            </a>
                        </div>

                        <div class="space-y-6">
                            @foreach ($latestPosts as $item)
                                <a href="{{ route('novosite.post.show', $post->slug) }}" class="flex gap-4 group">
                                    <img src="{{ $item->getFirstMediaUrl() ?? 'https://picsum.photos/200/150' }}"
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
                                <input type="email" placeholder="Seu e-mail"
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
                        <a href="{{ route('novosite.post.show', $post->slug) }}" class="group block">
                            <div class="aspect-video rounded-xl overflow-hidden mb-4">
                                <img src="{{ $post->getFirstMediaUrl() ?? 'https://picsum.photos/600/400' }}" alt="{{ $post->title }}"
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
