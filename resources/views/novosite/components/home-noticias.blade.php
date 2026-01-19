{{-- SEÇÃO DE NOTÍCIAS --}}
<section class="py-16 lg:py-20 bg-white" aria-label="Notícias e Atualidades">
    <div class="max-w-ueap mx-auto px-4 lg:px-8">

        {{-- Cabeçalho da Seção --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <span class="text-ueap-secondary font-bold text-xs uppercase tracking-widest mb-1 block">Fique Atualizado</span>
                <h2 class="text-3xl md:text-4xl font-bold text-ueap-primary tracking-tight">
                    Notícias Recentes
                </h2>
            </div>

            <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                class="inline-flex items-center gap-2 text-sm font-bold text-ueap-primary hover:text-ueap-secondary transition-colors group">
                Ver todas as notícias
                <i class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        {{-- Grid de Notícias --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach ($posts->take(6) as $post)
                <article class="flex flex-col group h-full border border-gray-100 rounded-lg hover:shadow-lg transition-all duration-300 overflow-hidden bg-white">

                    {{-- Imagem --}}
                    <div class="relative aspect-[16/10] overflow-hidden bg-gray-100">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm text-ueap-primary text-[10px] font-bold px-3 py-1 rounded shadow-sm uppercase tracking-wide">
                                {{ $post->category->name ?? 'Geral' }}
                            </span>
                        </div>
                    </div>

                    {{-- Conteúdo --}}
                    <div class="flex flex-col flex-1 p-6">
                        <time class="text-slate-400 text-xs font-medium mb-3 flex items-center gap-2">
                            <i class="fa-regular fa-calendar"></i>
                            {{ $post->created_at->translatedFormat('d \d\e F, Y') }}
                        </time>

                        <h3 class="text-lg font-bold text-slate-800 leading-snug mb-3 group-hover:text-ueap-primary transition-colors line-clamp-3">
                            <a href="{{ route('site.post.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <div class="mt-auto pt-4 border-t border-gray-50">
                            <a href="{{ route('site.post.show', $post->slug) }}" class="text-sm font-semibold text-ueap-primary flex items-center gap-2 group-hover:gap-3 transition-all">
                                Ler mais
                                <i class="fa-solid fa-arrow-right text-xs text-ueap-secondary"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Newsletter --}}
        <div class="bg-slate-50 border border-slate-100 rounded-2xl p-8 lg:p-12 relative overflow-hidden">
            {{-- Decoration --}}
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-ueap-secondary/10 rounded-full blur-2xl"></div>

            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="max-w-xl">
                    <h5 class="text-2xl font-bold text-ueap-primary mb-2">Assine nossa Newsletter</h5>
                    <p class="text-slate-600">Receba as principais notícias e editais da UEAP diretamente no seu e-mail.</p>
                </div>

                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="w-full lg:max-w-md flex flex-col sm:flex-row gap-3">
                    @csrf
                    <input type="email" name="email" placeholder="Seu e-mail principal" required
                        class="flex-1 bg-white border border-gray-200 focus:border-ueap-secondary focus:ring-1 focus:ring-ueap-secondary rounded-lg px-4 py-3 outline-none text-sm transition-all">
                    <button type="submit"
                        class="bg-ueap-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-ueap-primary/90 transition-colors shadow-sm whitespace-nowrap">
                        Inscrever-se
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>
