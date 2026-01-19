<section class="py-16 lg:py-24 bg-slate-50 relative overflow-hidden">
    {{-- Background Decoration --}}
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-50 pointer-events-none"></div>

    <div class="max-w-ueap mx-auto px-4 lg:px-8 relative z-10">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 border-b border-gray-200 pb-8">
            <div class="max-w-2xl">
                <span class="text-ueap-primary font-bold text-xs uppercase tracking-[0.2em] mb-3 block">Mural Informativo</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-slate-900 leading-tight">
                    Últimas <span class="text-ueap-primary">Notícias</span>
                </h2>
            </div>

            <div class="mt-6 md:mt-0">
                <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-white border border-gray-200 rounded-full text-sm font-bold text-slate-700 hover:border-ueap-primary hover:text-ueap-primary transition-all shadow-sm">
                    Ver todo o arquivo
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- News Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 mb-20">
            @foreach ($posts->take(6) as $post)
                <article class="group flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 overflow-hidden">

                    {{-- Image Wrapper --}}
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>

                        {{-- Category Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/95 backdrop-blur-md text-ueap-primary text-[10px] font-black px-3 py-1.5 uppercase tracking-wide rounded-md shadow-sm">
                                {{ $post->category->name ?? 'Geral' }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="flex flex-col flex-1 p-8">
                        <time class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-ueap-secondary"></span>
                            {{ $post->created_at->translatedFormat('d M Y') }}
                        </time>

                        <h3 class="text-xl font-serif font-bold text-slate-800 leading-snug mb-4 group-hover:text-ueap-primary transition-colors line-clamp-3">
                            <a href="{{ route('site.post.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                            <a href="{{ route('site.post.show', $post->slug) }}" class="text-xs font-bold text-ueap-primary uppercase tracking-widest group-hover:underline decoration-ueap-secondary underline-offset-4">
                                Ler Matéria
                            </a>
                            <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-slate-300 group-hover:bg-ueap-primary group-hover:text-white transition-all">
                                <i class="fa-solid fa-arrow-right text-xs"></i>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Newsletter Section --}}
        <div class="relative rounded-3xl overflow-hidden bg-ueap-primary shadow-2xl">
            <div class="absolute inset-0 opacity-20"
                 style="background-image: radial-gradient(#facc15 1px, transparent 1px); background-size: 24px 24px;"></div>

            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between p-10 lg:p-16 gap-10">
                <div class="max-w-2xl">
                    <h5 class="text-3xl lg:text-4xl font-serif font-bold text-white mb-4">Newsletter Oficial</h5>
                    <p class="text-white/80 text-lg font-light">
                        Receba os principais comunicados, editais e notícias da Universidade diretamente no seu e-mail.
                    </p>
                </div>

                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="w-full lg:max-w-md bg-white/10 p-2 rounded-full backdrop-blur-sm border border-white/20 flex">
                    @csrf
                    <input type="email" name="email" placeholder="Seu e-mail institucional..." required
                           class="flex-1 bg-transparent border-none text-white placeholder-white/50 px-6 py-3 focus:ring-0 outline-none">
                    <button type="submit"
                            class="bg-ueap-secondary text-ueap-primary font-bold px-8 py-3 rounded-full hover:bg-white transition-colors shadow-lg">
                        Assinar
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>
