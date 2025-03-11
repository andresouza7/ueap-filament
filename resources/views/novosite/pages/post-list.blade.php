@extends('novosite.template.main')

@section('title', 'Home')

@section('content')
    <!-- Post List View -->
    <div class="max-w-screen-xl mx-auto p-6">
        <!-- Page Heading -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Postagens</h1>

        <!-- Search Bar -->
        <form class="w-full mb-4" action="{{ route('novosite.post.list') }}?">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="qry" value="{{ request()->query('qry') }}"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Pesquisar..." required />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesquisar</button>
            </div>
        </form>

        <!-- Post List -->
        <h3 class="text-blue-600 font-semibold text-xl mb-4">Resultados Encontrados</h3>
        <div class="space-y-6">
            @foreach ($posts as $post)
                <div class="p-6 bg-white shadow-md rounded-lg hover:shadow-xl transition-all duration-300">
                    <!-- Post Title and Info -->
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg md:text-xl font-semibold text-gray-900">{{ $post->title }}</h2>
                        <p class="text-sm text-gray-600">{{ $post->created_at->format('F j, Y') }}</p>
                    </div>

                    <!-- Author -->
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <span class="font-semibold">Publicação:</span>
                        <span class="ml-2">{{ $post->user_created->nickname ?? 'Unknown' }}</span>
                    </div>

                    <!-- Divider -->
                    <div class="w-full h-px bg-gray-200 my-4"></div>

                    <!-- Read More Link -->
                    <a href="{{ route('novosite.post.show', $post->slug) }}"
                        class="text-blue-600 hover:text-blue-800 font-semibold">
                        Saiba mais →
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4"> {{ $posts->links() }}</div>
    </div>

@endsection
