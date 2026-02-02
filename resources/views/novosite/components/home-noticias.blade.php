{{-- SEÇÃO DE NOTÍCIAS + NEWSLETTER - IDENTIDADE UEAP --}}
<section class="py-16 lg:py-24 bg-gray-100 border-t border-gray-200" aria-label="Notícias e Atualidades">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header da Seção --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 pb-8 border-b-4 border-ueap-blue-dark">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-12 h-1 bg-ueap-green"></span>
                    <span class="text-ueap-blue-dark font-black text-xs uppercase tracking-[0.3em]">Arquivo de
                        Notícias</span>
                </div>
                <h2 class="text-5xl lg:text-7xl font-black text-ueap-blue-dark leading-none tracking-tighter uppercase">
                    Notícias da <span class="text-ueap-green">Ueap</span>
                </h2>
            </div>

            <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                class="mt-8 md:mt-0 inline-flex items-center gap-3 px-8 py-4 bg-ueap-blue-dark text-white font-black hover:bg-ueap-green hover:text-ueap-blue-dark transition-all group text-xs tracking-widest uppercase">
                Ver todo o acervo
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-2"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        {{-- Grid de 6 Notícias --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20 mb-32">
            @foreach ($posts->take(6) as $post)
                <article class="group">
                    <a href="{{ route('site.post.show', $post->slug) }}" class="block">
                        {{-- Imagem Reta --}}
                        <div class="relative aspect-video overflow-hidden bg-gray-200 mb-6 border border-gray-300">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                            <div class="absolute top-0 left-0">
                                <span
                                    class="bg-ueap-blue-dark text-white text-[10px] font-black px-3 py-1.5 uppercase tracking-widest">
                                    {{ $post->category->name ?? 'Geral' }}
                                </span>
                            </div>
                        </div>

                        {{-- Conteúdo Editorial --}}
                        <div class="space-y-4">
                            <time class="text-[10px] text-gray-500 font-black uppercase tracking-widest">
                                {{ $post->created_at->translatedFormat('d \d\e F \d\e Y') }}
                            </time>

                            <h3
                                class="text-2xl font-black text-ueap-blue-dark leading-tight group-hover:text-ueap-green group-hover:underline underline-offset-8 decoration-ueap-green decoration-4 transition-all">
                                {{ Str::ucfirst(Str::lower($post->title)) }}
                            </h3>

                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-2">
                                {{ Str::limit(strip_tags($post->text), 140) }}
                            </p>

                            <div class="pt-2">
                                <span class="text-ueap-green font-black text-xs uppercase tracking-widest">
                                    Ler mais +
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        {{-- NEWSLETTER (O DESIGN QUE PRESTA) --}}
        <div
            class="bg-white border border-gray-200 shadow-[20px_20px_0px_0px_rgba(0,37,94,1)] relative overflow-hidden">
            <div class="absolute left-0 top-0 bottom-0 w-2 bg-ueap-green"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
                {{-- Lado Azul: Texto --}}
                <div class="lg:col-span-7 p-10 md:p-16 bg-ueap-blue-dark text-white">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="text-[10px] font-black uppercase tracking-[0.5em] text-ueap-green">Assinatura
                            Digital</span>
                        <div class="flex-1 h-px bg-white/10"></div>
                    </div>
                    <h4 class="text-5xl md:text-7xl font-black leading-[0.8] uppercase tracking-tighter mb-8">
                        Boletim <br><span class="text-ueap-green">Informativo</span>
                    </h4>
                    <p class="text-blue-100/60 text-sm font-bold uppercase tracking-widest max-w-sm">
                        Editais e notícias acadêmicas entregues no seu e-mail institucional.
                    </p>
                </div>

                {{-- Lado Branco: Form --}}
                <div class="lg:col-span-5 p-10 md:p-16 flex flex-col justify-center bg-white">
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="flex flex-col gap-2">
                            <label
                                class="text-[10px] font-black uppercase text-ueap-blue-dark tracking-[0.2em] ml-1">E-mail
                                Oficial</label>
                            <input type="email" name="email" placeholder="EXEMPLO@UEAP.EDU.BR" required
                                class="w-full bg-gray-50 border-2 border-gray-200 px-6 py-5 text-ueap-blue-dark font-black focus:outline-none focus:border-ueap-blue-dark transition-all placeholder:text-gray-300">
                        </div>

                        <button type="submit"
                            class="w-full bg-ueap-green text-ueap-blue-dark font-black uppercase tracking-[0.3em] py-6 hover:bg-ueap-blue-dark hover:text-white transition-all shadow-lg active:scale-95">
                            Cadastrar e-mail
                        </button>
                    </form>
                    <p class="mt-6 text-[9px] text-gray-400 font-bold uppercase tracking-widest text-center">
                        * Serviço gratuito de comunicação oficial da UEAP.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
