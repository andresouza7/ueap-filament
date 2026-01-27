{{-- SEÇÃO DE NOTÍCIAS + NEWSLETTER - IDENTIDADE UEAP --}}
<section class="py-16 lg:py-24 bg-white border-t border-gray-100" aria-label="Notícias e Atualidades">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header da Seção --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 pb-8 border-b border-gray-200">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-1 bg-ueap-green"></span>
                    <span class="text-ueap-blue-dark font-bold text-xs uppercase tracking-[0.3em]">Fique por
                        dentro</span>
                </div>
                <h2 class="text-4xl lg:text-6xl font-black text-ueap-blue-dark leading-none tracking-tighter uppercase">
                    Notícias
                </h2>
            </div>

            <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                class="mt-8 md:mt-0 inline-flex items-center gap-3 px-6 py-3 bg-ueap-blue-dark text-white font-bold hover:bg-ueap-green hover:text-ueap-blue-dark transition-all group text-xs tracking-widest uppercase rounded-none">
                Ver acervo completo
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        {{-- Grid de 6 Notícias --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-16 mb-24">
            @foreach ($posts->take(6) as $post)
                <article class="group">
                    <a href="{{ route('site.post.show', $post->slug) }}" class="block">
                        {{-- Imagem --}}
                        <div class="relative aspect-[16/10] overflow-hidden bg-gray-100 mb-6 shadow-sm">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-ueap-blue-dark/90 backdrop-blur-sm text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest rounded-xs">
                                    {{ $post->category->name ?? 'Geral' }}
                                </span>
                            </div>
                        </div>

                        {{-- Conteúdo --}}
                        <div class="space-y-3">
                            <time
                                class="text-[10px] text-gray-400 font-bold uppercase tracking-widest flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-gray-200"></span>
                                {{ $post->created_at->translatedFormat('d \d\e F \d\e Y') }}
                            </time>

                            {{-- Link com underline "limpo" --}}
                            <h3 class="text-xl font-extrabold text-ueap-blue-dark leading-tight">
                                <span
                                    class="bg-left-bottom bg-gradient-to-r from-ueap-green to-ueap-green bg-[length:0%_3px] bg-no-repeat group-hover:bg-[length:100%_3px] transition-[background-size] duration-500 pb-0">
                                    {{ Str::ucfirst(Str::lower($post->title)) }}
                                </span>
                            </h3>

                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 font-medium">
                                {{ Str::limit(strip_tags($post->text), 130) }}
                            </p>

                            <div
                                class="pt-2 flex items-center gap-2 text-ueap-green font-bold text-[11px] uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
                                Ler artigo completo <span>→</span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        {{-- NEWSLETTER REFORMULADA --}}
        {{-- SEÇÃO NEWSLETTER - DESIGN FORMAL E CONDENSADO --}}
        <div class="bg-ueap-blue-dark border-l-[10px] border-ueap-green relative overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-stretch">

                {{-- Lado Esquerdo: Identidade --}}
                <div class="p-8 md:p-12 flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="text-ueap-green font-bold text-[10px] uppercase tracking-[0.3em]">Informativo</span>
                        <div class="h-px w-8 bg-white/20"></div>
                    </div>

                    <h4 class="text-4xl md:text-5xl font-bold text-white leading-tight uppercase tracking-tighter mb-4">
                        Newsletter <span class="text-ueap-green">Ueap</span>
                    </h4>

                    <p class="text-blue-100/60 text-sm font-normal max-w-sm leading-relaxed">
                        Receba as últimas publicações periodicamente diretamente no seu e-mail.
                    </p>
                </div>

                {{-- Lado Direito: Formulário --}}
                <div class="bg-white/5 border-l border-white/10 p-8 md:p-12 flex flex-col justify-center">
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <div class="flex flex-col">
                            <label class="text-[10px] font-semibold uppercase text-gray-400 tracking-widest mb-2 ml-1">
                                Seu melhor E-mail
                            </label>
                            <input type="email" name="email" placeholder="exemplo@ueap.edu.br" required
                                class="w-full bg-transparent border border-white/20 px-4 py-3 text-white font-normal focus:outline-none focus:border-ueap-green transition-all placeholder:text-white/20 rounded-none">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-10 py-3 bg-ueap-green text-ueap-blue-dark font-bold uppercase text-xs tracking-widest hover:bg-white transition-all rounded-none shadow-lg">
                                Inscrever-se
                            </button>
                        </div>
                    </form>

                    <p class="mt-4 text-[9px] text-white/20 font-medium uppercase tracking-tight text-right">
                        Privacidade Garantida. Você pode cancelar a inscrição a qualquer momento.
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>
