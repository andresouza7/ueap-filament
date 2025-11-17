<section class="p-8">
    <div class="max-w-[1290px] mx-auto my-10">

        <div class="grid grid-cols-1 lg:grid-cols-[2.5fr_1fr] gap-4 min-h-[27rem]">

            <!-- Coluna esquerda: destaque principal -->
            @if (isset($posts[0]))
                <a href="{{ route('novosite.post.show', $posts[0]->slug) }}"
                    class="relative rounded-sm overflow-hidden group cursor-pointer shadow-xl transition-all duration-300 h-full">

                    <img src="{{ $posts[0]->image_url ?? 'https://picsum.photos/id/1057/600/400' }}"
                        class="absolute inset-0 w-full h-full object-cover brightness-95 
                                group-hover:brightness-110 group-hover:contrast-110 group-hover:scale-105 
                                transition-all duration-500">

                    <div class="absolute inset-0 bg-black/30 transition-all duration-500"></div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-28 bg-gradient-to-t from-black/60 via-black/30 to-transparent">
                    </div>

                    <div class="relative z-10 p-4 md:p-6 flex flex-col justify-end h-full text-white">
                        <h2
                            class="text-sm md:text-2xl font-semibold leading-tight mb-2 drop-shadow-lg 
                                   transition-all duration-200 group-hover:underline decoration-accent-yellow decoration-2 underline-offset-[3px]">
                            {{ $posts[0]->title }}
                        </h2>

                        <p class="text-xs md:text-sm text-gray-200 mb-2">
                            {{ \Carbon\Carbon::parse($posts[0]->updated_at)->format('d \d\e F, Y') }}
                        </p>
                    </div>
                </a>
            @endif


            <!-- Coluna direita -->
            <div class="flex flex-col gap-4 h-full">

                <!-- Card 1 -->
                @if (isset($posts[1]))
                    <a href="{{ route('novosite.post.show', $posts[1]->slug) }}"
                        class="relative rounded-sm overflow-hidden group cursor-pointer shadow-xl transition-all duration-300 flex-1">

                        <img src="{{ $posts[1]->image_url ?? 'https://picsum.photos/id/1056/600/400' }}"
                            class="absolute inset-0 w-full h-full object-cover brightness-95 
                                    group-hover:brightness-110 group-hover:contrast-110 group-hover:scale-110 
                                    transition-all duration-500">

                        <div class="absolute inset-0 bg-black/30 transition-all duration-500"></div>
                        <div
                            class="absolute bottom-0 left-0 right-0 h-18 bg-gradient-to-t from-black/60 via-black/30 to-transparent">
                        </div>

                        <div class="relative z-10 p-4 text-white flex flex-col justify-end h-full">
                            <h3
                                class="text-sm md:text-lg font-semibold leading-tight drop-shadow-lg
                                       transition-all duration-200 group-hover:underline decoration-accent-yellow decoration-2 underline-offset-[3px]">
                                {{ $posts[1]->title }}
                            </h3>

                            <p class="text-xs text-gray-200 mt-1">
                                {{ \Carbon\Carbon::parse($posts[1]->updated_at)->format('d \d\e F, Y') }}
                            </p>
                        </div>
                    </a>
                @endif


                <!-- Card 2 -->
                @if (isset($posts[2]))
                    <a href="{{ route('novosite.post.show', $posts[2]->slug) }}"
                        class="relative rounded-sm overflow-hidden group cursor-pointer shadow-xl transition-all duration-300 flex-1">

                        <img src="{{ $posts[2]->image_url ?? 'https://picsum.photos/id/1055/600/400' }}"
                            class="absolute inset-0 w-full h-full object-cover brightness-95 
                                    group-hover:brightness-110 group-hover:contrast-110 group-hover:scale-110 
                                    transition-all duration-500">

                        <div class="absolute inset-0 bg-black/30 transition-all duration-500"></div>
                        <div
                            class="absolute bottom-0 left-0 right-0 h-18 bg-gradient-to-t from-black/60 via-black/30 to-transparent">
                        </div>

                        <div class="relative z-10 p-4 text-white flex flex-col justify-end h-full">
                            <h3
                                class="text-sm md:text-lg font-semibold leading-tight drop-shadow-lg
                                       transition-all duration-200 group-hover:underline decoration-accent-yellow decoration-2 underline-offset-[3px]">
                                {{ $posts[2]->title }}
                            </h3>

                            <p class="text-xs text-gray-200 mt-1">
                                {{ \Carbon\Carbon::parse($posts[2]->updated_at)->format('d \d\e F, Y') }}
                            </p>
                        </div>
                    </a>
                @endif

            </div>
        </div>
    </div>
</section>
