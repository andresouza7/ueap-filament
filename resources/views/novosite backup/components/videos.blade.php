@php
    $videos = [
        'https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4',
        'https://storage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
        'https://storage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
        'https://storage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
        'https://storage.googleapis.com/gtv-videos-bucket/sample/Sintel.mp4',
        'https://storage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4',
    ];
@endphp


<section class="py-12 bg-blue-50 border-t border-gray-200">
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Nossas Redes</h2>
                <div class="h-1 w-20 bg-ueap-green mt-2 rounded-full"></div>
            </div>

            <div class="flex space-x-3 text-xl">
                <a href="#" class="text-gray-400 hover:text-ueap-green transition" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>

                <a href="#" class="text-gray-400 hover:text-ueap-green transition" aria-label="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>

        <div
            class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 scrollbar-hide md:grid md:grid-cols-3 lg:grid-cols-6 md:pb-0 md:overflow-visible">

            @foreach ($videos as $video)
                <div
                    class="flex-none w-48 md:w-auto aspect-[9/16] snap-center relative group overflow-hidden rounded-xl shadow-md cursor-pointer bg-gray-200">

                    <video src="{{ $video }}"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" muted
                        loop autoplay playsinline></video>

                    <div
                        class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                        <div
                            class="w-12 h-12 rounded-full bg-white/80 flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-play text-ueap-green ml-1 text-xl"></i>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
