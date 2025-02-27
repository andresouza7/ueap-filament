@extends('site.template.main')

@section('title', 'Home')

@section('content')
    {{-- Hero Section with Background Image --}}
    <div class="w-full relative min-h-[400px] py-16 bg-cover bg-center" style="background-image: url('https://picsum.photos/1200/800');">
        <div class="absolute inset-0 bg-black opacity-60"></div> {{-- Overlay for better readability --}}
        <div class="container mx-auto w-full max-w-screen-xl px-4 lg:px-8 py-8 relative z-10">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Carousel -->
                <div id="controls-carousel" class="relative col-span-2" data-carousel="static">
                    <div class="relative h-72 md:h-96 overflow-hidden rounded-sm">
                        @php
                            $banners = \App\Models\WebBanner::latest('id')->take(3)->get();
                        @endphp
                        @foreach ($banners as $banner)
                            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                <img src="{{ $banner->image_url }}" class="absolute block w-full h-full object-cover hover:scale-105 transition-transform duration-300" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 start-0 z-30 h-full px-4" data-carousel-prev>
                        <span class="w-10 h-10 bg-white/30 rounded-full flex items-center justify-center">&lt;</span>
                    </button>
                    <button type="button" class="absolute top-0 end-0 z-30 h-full px-4" data-carousel-next>
                        <span class="w-10 h-10 bg-white/30 rounded-full flex items-center justify-center">&gt;</span>
                    </button>
                </div>
                <!-- Notícias principais -->
                <div class="col-span-2 md:col-span-1">
                    {{-- Destaques Heading --}}
                    <h2 class="text-2xl font-semibold text-white mb-4">Destaques</h2>
                    <div class="w-full h-px bg-white/50 mb-6"></div> {{-- White Divider --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @php
                            $posts = \App\Models\WebPost::latest('id')
                                ->whereHas('category', function ($query) {
                                    $query->whereHas('section', function ($query) {
                                        $query->where('slug', 'news');
                                    });
                                })
                                ->take(4)
                                ->get();
                        @endphp
                        @foreach ($posts as $post)
                            <div class="relative overflow-hidden rounded-sm shadow-md hover:scale-105 transition-transform duration-300">
                                <div class="w-full h-32 bg-gray-300 bg-cover bg-center" style="background-image: url('{{ $post->image_url ?? '' }}');">
                                    {{-- Dark Overlay at the Bottom --}}
                                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-3">
                                        <a href="/web/post/{{ $post->id }}" class="text-xs font-semibold text-white line-clamp-2">
                                            {{ $post->title }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Próximos Eventos -->
    <div class="container mx-auto w-full max-w-screen-xl px-4 lg:px-8 py-12">
        <h2 class="text-3xl font-bold mb-6">Eventos</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @php
                $events = \App\Models\WebPost::latest('id')
                    ->whereHas('category', function ($query) {
                        $query->whereHas('section', function ($query) {
                            $query->where('slug', 'events');
                        });
                    })
                    ->take(3)
                    ->get();
            @endphp
            @foreach ($events as $event)
                <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-900">Evento</h3>
                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $event->title }}</p>
                    <a href="#" class="text-blue-600 hover:underline mt-3 inline-block text-sm">Saiba mais</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection