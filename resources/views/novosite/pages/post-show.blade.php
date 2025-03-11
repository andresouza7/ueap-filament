@extends('novosite.template.main')

@section('title', 'Home')

@section('content')
    <div class="w-full bg-blue-800 text-white">
        <div class="mx-auto max-w-screen-xl px-8 py-2">
            <h1 class="text-xl font-medium">/ Postagens</h1>
            <a href="/novo" class="text-sm text-gray-100 mt-2">Voltar ao Início</a>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="relative grid grid-cols-1 md:grid-cols-4 gap-8 mx-auto max-w-screen-xl p-4 sm:p-8">
        <!-- Main Content -->
        <div class="md:col-span-3">
            <article>
                <header class="space-y-4 mb-6">
                    <!-- Author Section -->
                    <div class="w-full pb-4 mb-4 border-b">
                        <address class="flex items-center gap-4">
                            <img class="w-16 h-16 rounded-full border-2 border-blue-500"
                                src="{{ $post->user_created->profile_photo_url }}" alt="Author Profile Photo">
                            <div class="flex flex-col">
                                <a href="#" rel="author"
                                    class="text-xl font-semibold text-gray-900">
                                    {{ $post->user_created->nickname }}
                                </a>
                                <span class="text-sm text-gray-600">
                                    {{ $post->user_created->group->description }}
                                </span>
                                <span class="text-xs text-gray-500 italic mt-1">
                                    {{ $post->created_at->format('F j, Y') }}
                                </span>
                            </div>
                        </address>
                    </div>

                    <!-- Post Title -->
                    <h1 class="text-2xl font-extrabold leading-snug text-gray-900 lg:text-4xl">
                        {{ $post->title }}
                    </h1>

                    <!-- Post Image -->
                    @if ($post->image_url)
                        <img class="w-full  mb-4 lg:mb-6 rounded-lg shadow-sm" src="{{ $post->image_url }}"
                            alt="Post Image">
                    @endif

                </header>

                <!-- Post Content -->
                <div
                    class="text-justify leading-loose text-neutral-500 first-line:uppercase first-line:tracking-widest first-letter:text-7xl first-letter:font-bold first-letter:text-gray-900 first-letter:me-3 first-letter:float-start">
                    {!! clean_text($post->text) !!}
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <aside class="md:col-span-1">
            <!-- Search Bar -->
            <div class="mb-8">
                <h3 class="font-semibold text-lg mb-4 text-gray-800">Pesquisar Notícia</h3>
                <form class="w-full mb-4" action="{{ route('novosite.post.list') }}?">
                    <input type="text" placeholder="processo seletivo..." name="qry"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </form>

            </div>

            <!-- Categories -->
            <div class="mb-8">
                <h3 class="font-semibold text-lg mb-4 text-gray-800">Categorias</h3>
                @php
                    $tags = ['Editais', 'Extensão', 'Pós-Graduação'];
                @endphp
                <ul class="flex gap-2 flex-wrap">
                    @foreach ($tags as $tag)
                        <li>
                            <a href="#"
                                class="flex items-start text-white hover:text-gray-100 transition-colors duration-200 bg-green-600 text-sm px-2 py-1">
                                {{ $tag }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Popular Posts -->
            <div class="mb-8">
                <h3 class="font-semibold text-lg mb-4 text-gray-800">Leia Também</h3>
                <ul class="space-y-3">
                    @foreach ($extra_posts as $post)
                        <li>
                            <a href="{{ route('novosite.post.show', $post->slug) }}"
                                class="flex items-start text-gray-600 hover:text-blue-500 transition-colors duration-200">
                                <span class="mr-2">📌</span>
                                <span class="text-sm">{{ $post->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Newsletter Signup -->
            <div class="mb-8">
                <h3 class="font-semibold text-lg mb-4 text-gray-800">Assine nossa newsletter</h3>
                <p class="text-gray-600 mb-4 text-sm">Receba as notícias diretamente no seu email.</p>
                <input type="email" placeholder="Seu e-mail"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <button
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-200">
                    Assinar
                </button>
            </div>
        </aside>
    </div>
@endsection
