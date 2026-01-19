<section class="py-16 bg-white">
    <div class="max-w-ueap mx-auto px-4 lg:px-8">

        <div class="flex items-center justify-between mb-10 border-b border-gray-100 pb-4">
            <div>
                <h2 class="text-3xl font-bold text-ueap-primary">Notícias</h2>
                <p class="text-slate-500 text-sm mt-1">Acompanhe as últimas atualizações da universidade.</p>
            </div>
            <a href="{{ route('site.post.list', ['type' => 'news']) }}" class="text-sm font-bold text-ueap-primary hover:text-ueap-primary-hover flex items-center gap-2">
                Ver Todas <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts->take(6) as $post)
                <div class="flex flex-col h-full group">
                    {{-- Image --}}
                    <a href="{{ route('site.post.show', $post->slug) }}" class="block overflow-hidden rounded-xl aspect-[16/10] bg-gray-100 mb-4 relative">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <span class="absolute top-3 left-3 bg-white/95 backdrop-blur text-ueap-primary text-[10px] font-bold px-2 py-1 rounded border border-gray-100 uppercase tracking-wide">
                            {{ $post->category->name ?? 'Geral' }}
                        </span>
                    </a>

                    {{-- Content --}}
                    <div class="flex flex-col flex-1">
                        <time class="text-xs text-slate-500 font-medium mb-2 block">
                            {{ $post->created_at->translatedFormat('d \d\e F, Y') }}
                        </time>
                        <h3 class="text-lg font-bold text-slate-900 leading-snug mb-3 group-hover:text-ueap-primary transition-colors">
                            <a href="{{ route('site.post.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-slate-600 text-sm line-clamp-3 mb-4 leading-relaxed">
                            {{ $post->resume }}
                        </p>

                        <a href="{{ route('site.post.show', $post->slug) }}" class="mt-auto text-sm font-bold text-ueap-primary hover:underline decoration-ueap-secondary underline-offset-4 w-max">
                            Ler mais
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
