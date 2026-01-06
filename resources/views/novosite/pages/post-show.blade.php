@extends('novosite.template.master')

@section('title', isset($post->title) ? $post->title : (isset($post->slug) ? str_replace('-', ' ', ucfirst($post->slug))
    : 'Notícia'))

@section('content')

    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- ================= HEADER ================= --}}
    <header class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <div class="w-full">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded uppercase">
                            {{ $post->category->name }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4">
                        {{ $post->title }}
                    </h1>

                    {{-- Grid de Metadados e Share: Alinhamento preciso --}}
                    <div class="flex flex-col gap-4 text-sm text-gray-600 md:flex-row md:items-center md:justify-between">

                        <div class="flex flex-wrap items-center gap-6">
                            {{-- Data --}}
                            <div class="flex items-center gap-2 group">
                                <i class="fa-regular fa-clock text-ueap-green"></i>
                                <span class="text-gray-400">Atualizado:</span>
                                <span
                                    class="font-semibold text-gray-800">{{ $post->updated_at->format('d/m/Y H:i') }}</span>
                            </div>

                            {{-- Views --}}
                            <div class="flex items-center gap-2 group">
                                <i class="fa-solid fa-eye text-ueap-green"></i>
                                <span class="text-gray-400">Leituras:</span>
                                <span class="font-semibold text-gray-800">{{ $post->hits }}</span>
                            </div>
                        </div>

                        {{-- Compartilhamento: Botões Minimalistas --}}
                        <div class="flex items-center gap-3 pt-4 md:pt-0">
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Compartilhar</span>

                            <div class="flex items-center gap-1">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white border border-gray-200 text-gray-400 hover:text-blue-600 hover:border-blue-600 hover:shadow-sm transition-all"
                                    aria-label="Facebook">
                                    <i class="fa-brands fa-facebook-f text-xs"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white border border-gray-200 text-gray-400 hover:text-green-600 hover:border-green-600 hover:shadow-sm transition-all"
                                    aria-label="WhatsApp">
                                    <i class="fa-brands fa-whatsapp text-xs"></i>
                                </a>

                                <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-white border border-gray-200 text-gray-400 hover:text-black hover:border-black hover:shadow-sm transition-all"
                                    aria-label="Twitter">
                                    <i class="fa-brands fa-x-twitter text-xs"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="bg-white py-10">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Artigo --}}
                <article class="lg:col-span-8 rounded-2xl p-4 md:p-0">

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
                                        <figure class="mb-10 border-gray-100 border-b-1">
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

                    {{-- Autoria --}}
                    <section class="mt-12 mb-10 border-t border-gray-100 pt-8">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-8">

                            {{-- Autor e Info --}}
                            <div class="flex items-center gap-4">
                                {{-- Avatar Minimalista --}}
                                <div class="shrink-0">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-ueap-green text-white flex items-center justify-center font-bold shadow-sm">
                                        {{ strtoupper(substr($post->author->name ?? 'UE', 0, 2)) }}
                                    </div>
                                </div>

                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] font-black uppercase tracking-[0.15em] text-gray-400 leading-none mb-1">
                                        Publicado por
                                    </span>
                                    <p class="font-bold text-gray-900 text-base leading-tight">
                                        {{ $post->author->name ?? 'Assessoria de Comunicação' }}
                                    </p>
                                    <div class="text-gray-500 text-xs mt-1.5 flex items-center gap-2 font-medium">
                                        <i class="fa-regular fa-calendar text-[10px]"></i>
                                        {{ $post->created_at->translatedFormat('d \d\e M, Y \à\s H:i') }}
                                    </div>
                                </div>
                            </div>

                            {{-- Compartilhamento (Mesmo estilo do Header) --}}
                            <div class="flex items-center gap-4 border-t sm:border-t-0 pt-6 sm:pt-0">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-400">Compartilhar</span>

                                <div class="flex items-center gap-1.5">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-blue-600 hover:border-blue-600 hover:shadow-sm transition-all">
                                        <i class="fa-brands fa-facebook-f text-sm"></i>
                                    </a>

                                    <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                        rel="noopener noreferrer"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-green-600 hover:border-green-600 hover:shadow-sm transition-all">
                                        <i class="fa-brands fa-whatsapp text-sm"></i>
                                    </a>

                                    <a href="https://twitter.com/intent/tweet?url={{ $url_atual }}" target="_blank"
                                        rel="noopener noreferrer"
                                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-black hover:border-black hover:shadow-sm transition-all">
                                        <i class="fa-brands fa-x-twitter text-sm"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </section>

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
                <aside class="lg:col-span-4 space-y-12">

                    {{-- Busca - Minimalista --}}
                    <section>
                        <div class="group relative">
                            <input type="text" placeholder="Buscar no portal..."
                                class="w-full bg-transparent border-b-2 border-gray-100 py-2 pl-0 pr-8
                       text-gray-800 placeholder:text-gray-400 focus:outline-none 
                       focus:border-ueap-green transition-all duration-300 text-lg">
                            <button
                                class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-ueap-green">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </section>

                    {{-- Últimas Notícias - Estilo Listagem Premium --}}
                    <section>
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-500">
                                    Mais Visualizadas
                                </h3>
                                <div class="h-px flex-1 bg-gray-100 mx-4"></div>
                                <a href="{{ route('novosite.post.list') }}"
                                    class="text-xs font-bold text-ueap-green hover:opacity-70">
                                    Ver tudo
                                </a>
                            </div>

                            <div class="space-y-6">
                                @foreach ($latestPosts as $item)
                                    <a href="{{ route('novosite.post.show', $item->slug) }}"
                                        class="group flex items-start gap-4">
                                        {{-- Foto à Esquerda --}}
                                        <div class="relative shrink-0">
                                            <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/200' }}"
                                                class="w-24 h-20 object-cover rounded-lg shadow-sm group-hover:shadow-md transition-all duration-300">
                                        </div>

                                        {{-- Texto à Direita --}}
                                        <div class="flex flex-col min-w-0 py-0.5">
                                            <span
                                                class="text-[10px] font-bold text-ueap-green uppercase mb-1 tracking-tight">
                                                {{ $item->category->name }}
                                            </span>
                                            <h4
                                                class="text-sm font-semibold text-gray-900 leading-[1.3] group-hover:text-ueap-green transition-colors line-clamp-2">
                                                {{ $item->title }}
                                            </h4>
                                            <span class="text-[11px] text-gray-400 mt-1">
                                                <i
                                                    class="fa-regular fa-clock mr-1"></i>{{ $item->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    {{-- Newsletter - Minimalist Card --}}
                    <section class="bg-[#f8f9fa] p-8 rounded-sm border-l-4 border-ueap-green">
                        <h3 class="text-xl font-serif font-bold text-gray-900 mb-2">Newsletter</h3>
                        <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                            Receba uma curadoria semanal das atividades acadêmicas.
                        </p>

                        <form class="flex flex-col gap-3">
                            <input type="email" placeholder="E-mail acadêmico ou pessoal"
                                class="w-full bg-white border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 transition">

                            <button type="submit"
                                class="w-full bg-gray-900 text-white py-3 text-xs font-bold uppercase tracking-widest hover:bg-ueap-green transition-colors cursor-pointer">
                                Assinar agora
                            </button>
                        </form>
                    </section>

                </aside>
            </div>

            <!-- Read Also (Bottom Grid) -->
            <section class="mt-8 pt-12">
                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-xl font-black uppercase tracking-tight text-gray-900 flex items-center gap-3">
                        <span class="w-8 h-1 bg-ueap-green"></span>
                        Leia também
                    </h2>
                </div>

                {{-- Grid: Flex-col no mobile, 4 colunas no desktop --}}
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-6">
                    @foreach ($relatedPosts as $post)
                        <article>
                            <a href="{{ route('novosite.post.show', $post->slug) }}"
                                class="group flex flex-row lg:flex-col gap-4 lg:gap-4 items-start">

                                {{-- Container da Imagem: Tamanho fixo no mobile, proporção 4:3 no desktop --}}
                                <div
                                    class="shrink-0 w-28 h-20 sm:w-36 sm:h-28 lg:w-full lg:h-auto lg:aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100 shadow-sm transition-all duration-500 group-hover:shadow-xl group-hover:shadow-ueap-green/10">
                                    <img src="{{ 'https://picsum.photos/seed/' . $post->id . '/600/450' }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110 group-hover:rotate-1">
                                </div>

                                {{-- Conteúdo --}}
                                <div class="flex flex-col min-w-0 py-1">
                                    <div class="flex items-center gap-2 mb-1 lg:mb-2">
                                        <span class="text-[10px] font-bold uppercase tracking-[0.1em] text-ueap-green">
                                            {{ $post->category->name ?? 'Notícia' }}
                                        </span>
                                    </div>

                                    <h3
                                        class="font-bold text-sm sm:text-base text-gray-900 group-hover:text-ueap-green transition-colors leading-snug line-clamp-2 lg:line-clamp-3">
                                        {{ $post->title }}
                                    </h3>

                                    <div
                                        class="mt-2 lg:mt-3 flex items-center text-gray-400 text-[10px] sm:text-[11px] font-medium">
                                        <i class="fa-regular fa-calendar-days mr-1.5"></i>
                                        {{ $post->created_at->translatedFormat('d \d\e M, Y') }}
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>

    </main>

@endsection
