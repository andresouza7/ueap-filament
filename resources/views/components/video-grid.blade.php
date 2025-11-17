@props([
    // videos = [
    //     ['url' => '...', 'description' => '...'],
    // ]
    'videos' => [],
    'title' => 'Título da Seção',
])

<section class="w-full py-16 bg-gray-50">
    <div class="max-w-[1290px] mx-auto px-4 lg:px-8">

        {{-- TÍTULO --}}
        <h2 class="text-3xl font-semibold text-gray-900 mb-8 text-center md:text-left">
            {{ $title }}
        </h2>

        {{-- GRID (aparece somente do md pra cima) --}}
        <div class="hidden md:grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-6">
            @foreach ($videos as $item)
                <div
                    class="bg-white rounded overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">

                    <div class="w-full bg-gray-900 overflow-hidden">
                        <video class="w-full h-full object-cover aspect-[9/16]" controls src="{{ $item['url'] }}">
                        </video>
                    </div>

                    {{-- DESCRIÇÃO E BOTÕES --}}
                    <div class="p-4 flex flex-col flex-1">
                        <p class="text-sm text-gray-600 mb-4 flex-1 leading-relaxed">
                            {{ $item['description'] }}
                        </p>

                        {{-- DIVISOR --}}
                        <hr class="border-gray-200 mb-4">

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="text-xs text-gray-500">Compartilhar</span>
                            </div>

                            <div class="flex space-x-1">
                                {{-- Instagram --}}
                                <a href="https://www.instagram.com/?url={{ urlencode($item['url']) }}"
                                    class="text-pink-500 hover:text-pink-600 transition-colors duration-200"
                                    target="_blank" aria-label="Compartilhar no Instagram">
                                    <i class="fab fa-instagram text-xl"></i>
                                </a>

                                {{-- WhatsApp --}}
                                <a href="https://wa.me/?text={{ urlencode('Confira este vídeo: ' . $item['url']) }}"
                                    class="text-green-500 hover:text-green-600 transition-colors duration-200"
                                    target="_blank" aria-label="Compartilhar no WhatsApp">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- CAROUSEL (somente mobile) --}}
        <div class="md:hidden flex gap-6 overflow-x-auto scrollbar-hide py-4">
            @foreach ($videos as $item)
                <div
                    class="min-w-[280px] max-w-[280px] bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 flex-shrink-0">

                    <div class="w-full bg-gray-900 overflow-hidden">
                        <video class="w-full h-full object-cover aspect-[9/16]" controls src="{{ $item['url'] }}">
                        </video>
                    </div>

                    {{-- DESCRIÇÃO E BOTÕES --}}
                    <div class="p-4">
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                            {{ $item['description'] }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <i class="fa-solid fa-share-alt text-gray-500 text-sm"></i>
                                <span class="text-sm text-gray-500 font-medium">Compartilhar</span>
                            </div>

                            <div class="flex space-x-4">
                                {{-- Instagram --}}
                                <a href="https://www.instagram.com/?url={{ urlencode($item['url']) }}"
                                    class="flex items-center justify-center w-10 h-10 bg-pink-50 rounded-full shadow-sm text-pink-500 hover:bg-pink-100 hover:text-pink-600 transition-all duration-200"
                                    target="_blank" aria-label="Compartilhar no Instagram">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>

                                {{-- WhatsApp --}}
                                <a href="https://wa.me/?text={{ urlencode('Confira este vídeo: ' . $item['url']) }}"
                                    class="flex items-center justify-center w-10 h-10 bg-green-50 rounded-full shadow-sm text-green-500 hover:bg-green-100 hover:text-green-600 transition-all duration-200"
                                    target="_blank" aria-label="Compartilhar no WhatsApp">
                                    <i class="fab fa-whatsapp text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>
