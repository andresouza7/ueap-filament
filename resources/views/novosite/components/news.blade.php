<!-- News Section -->
<section class="py-16 bg-white">
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Últimas Notícias</h2>
                <div class="h-1 w-20 bg-ueap-green mt-2 rounded-full"></div>
            </div>
            <a href="#" class="text-ueap-green font-semibold hover:text-green-800 transition flex items-center">
                Todas as notícias
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach ($posts as $post)
                <article
                    class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">

                    <div class="h-48 overflow-hidden">
                        <img src="{{ $post->image_url ?: 'https://picsum.photos/600/400?random=' . $post->id }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover hover:scale-110 transition duration-500">
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs font-bold text-ueap-green uppercase">
                                {{ $post->category->description ?? 'NOTÍCIA' }}
                            </span>

                            <span class="text-xs text-gray-400 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $post->created_at->format('d M') }}
                            </span>
                        </div>

                        <a href="{{ route('novosite.post.show', $post->slug) }}">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 leading-tight line-clamp-3 hover:text-ueap-green transition cursor-pointer">
                                {{ $post->title }}
                            </h3>
                        </a>

                        <p class="text-sm text-gray-600 mb-4 line-clamp-3 flex-1">
                            {{ strip_tags($post->text) }}
                        </p>

                        <a href="{{ route('novosite.post.show', $post->slug) }}"
                            class="text-sm font-semibold text-ueap-green hover:underline mt-auto">Ler mais →</a>
                    </div>

                </article>
            @endforeach

        </div>
    </div>
</section>
