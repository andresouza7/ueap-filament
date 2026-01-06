@extends('novosite.template.master')

@section('title', 'Notícias - UEAP')

@section('content')
    @php
        $url_atual = urlencode(url()->current());
    @endphp

    {{-- ================= HEADER ================= --}}
    <header class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded uppercase">
                            PESQUISA
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4">
                        Todas as Notícias
                    </h1>

                    <div class="flex gap-10 text-sm text-gray-600">

                        {{-- Metadados --}}
                        <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-tag text-ueap-green"></i>
                                <span class="font-medium">Seção:</span>
                                <span class="text-gray-500">Notícias</span>
                            </div>
                        </div>

                        {{-- Compartilhamento --}}
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-share-nodes text-ueap-green"></i>
                                <span class="text-gray-500">Compartilhar</span>
                            </div>

                            <div class="flex items-center">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center
                      w-9 h-9 rounded-full
                      text-gray-500
                      hover:text-blue-600 hover:bg-gray-100
                      transition"
                                    aria-label="Compartilhar no Facebook">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center
                      w-9 h-9 rounded-full
                      text-gray-500
                      hover:text-green-600 hover:bg-gray-100
                      transition"
                                    aria-label="Compartilhar no WhatsApp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ $url_atual }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center
                      w-9 h-9 rounded-full
                      text-gray-500
                      hover:text-blue-500 hover:bg-gray-100
                      transition"
                                    aria-label="Compartilhar no WhatsApp">
                                    <i class="fa-brands fa-twitter"></i>
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

                {{-- Listagem de Notícias --}}
                <div class="lg:col-span-8 space-y-8">

                    @forelse ($posts as $item)
                        <article
                            class="bg-white rounded-2xl shadow overflow-hidden flex flex-col md:flex-row group hover:shadow-md transition duration-300">
                            {{-- Imagem da Notícia --}}
                            <div class="md:w-1/3 overflow-hidden">
                                <a href="{{ route('novosite.post.show', $item->slug) }}">
                                    <img src="{{ 'https://picsum.photos/seed/' . $item->id . '/600/400' }}"
                                        alt="{{ $item->title }}"
                                        class="w-full h-48 md:h-full object-cover aspect-square group-hover:scale-105 transition duration-500">
                                </a>
                            </div>

                            {{-- Conteúdo resumido --}}
                            <div class="p-6 md:p-8 flex flex-col justify-between md:w-2/3">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <span
                                            class="px-3 py-1 text-xs font-bold uppercase rounded-full bg-green-100 text-green-700">
                                            {{ $item->category->name ?? 'Institucional' }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            <i class="fa-regular fa-calendar-days mr-1"></i>
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </span>
                                    </div>

                                    <a href="{{ route('novosite.post.show', $item->slug) }}">
                                        <h2
                                            class="text-xl md:text-2xl font-bold text-gray-900 group-hover:text-green-600 transition mb-3">
                                            {{ $item->title }}
                                        </h2>
                                    </a>

                                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                        {{ $item->description ?? Str::limit(clean_text(html_entity_decode(strip_tags($item->text))), 150) }}
                                    </p>
                                </div>

                                <a href="{{ route('novosite.post.show', $item->slug) }}"
                                    class="text-green-600 font-bold text-sm inline-flex items-center gap-2 hover:underline">
                                    Ler notícia completa
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
                            <p class="text-gray-500 text-lg">Nenhuma notícia encontrada no momento.</p>
                        </div>
                    @endforelse

                    {{-- Paginação --}}
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>

                </div>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4 space-y-8">

                    {{-- Busca --}}
                    <div class="bg-white p-6 rounded-xl shadow">
                        <h3 class="font-bold mb-4">Filtrar Notícias</h3>
                        <form action="{{ url()->current() }}" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Digite sua busca..."
                                value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                        </form>
                    </div>

                    {{-- Categorias --}}
                    {{-- <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                        <h3 class="font-bold border-l-4 border-green-600 pl-3 mb-6">Categorias</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($categories as $cat)
                                <a href="?category={{ $cat->slug }}" 
                                   class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600 hover:bg-green-600 hover:text-white transition">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div> --}}

                    {{-- Newsletter Widget --}}
                    <div class="bg-gray-900 rounded-xl p-6 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h3 class="font-bold text-xl mb-2">Fique por dentro</h3>
                            <p class="text-gray-300 text-sm mb-4">Receba as principais notícias diretamente no seu e-mail.
                            </p>
                            <form>
                                <input type="email" placeholder="Seu melhor e-mail"
                                    class="w-full px-4 py-2 bg-white rounded-lg text-gray-900 mb-2 focus:outline-none">
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 font-bold py-2 rounded-lg transition text-sm">Inscrever-se</button>
                            </form>
                        </div>
                        <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white opacity-5 rounded-full"></div>
                    </div>

                </aside>
            </div>
        </div>
    </main>

@endsection
