<section class="py-10 lg:py-16 bg-gray-50 relative overflow-hidden" aria-label="Notícias e Atualidades">
    {{-- EFEITO DE BACKGROUND INSTITUCIONAL --}}
    <div class="absolute inset-0 pointer-events-none z-0" aria-hidden="true">
        {{-- Geometria em Azul UEAP sutil --}}
        <div
            class="absolute -top-[5%] -left-[10%] w-[80%] lg:w-[55%] h-[25%] lg:h-[85%] bg-ueap-blue/5 -skew-x-12 border-r-4 border-ueap-blue/10 shadow-[40px_0_70px_-30px_rgba(0,0,0,0.02)] transition-all duration-500">
            <div class="absolute inset-0 opacity-[0.1]"
                style="background-image: linear-gradient(to right, #00388D 1px, transparent 1px), linear-gradient(to bottom, #00388D 1px, transparent 1px);
                        background-size: 40px 40px;
                        mask-image: linear-gradient(to right, black 10%, transparent 85%), linear-gradient(to bottom, black 10%, transparent 85%);
                        -webkit-mask-image: linear-gradient(to right, black 10%, transparent 85%), linear-gradient(to bottom, black 10%, transparent 85%);">
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-12 relative z-10">

        {{-- Header Editorial --}}
        <div class="relative flex flex-col mb-8 lg:mb-12">
            <div class="flex items-center gap-3 mb-2">
                <span class="h-[3px] w-8 lg:w-12 bg-ueap-green" aria-hidden="true"></span>
                <span
                    class="text-ueap-blue-dark font-sans text-[10px] lg:text-[11px] uppercase tracking-[0.4em] font-black">Destaques
                    Acadêmicos</span>
            </div>

            <div class="flex flex-wrap items-end justify-between pb-4 lg:pb-6 gap-y-4 relative">
                <h2
                    class="text-4xl lg:text-7xl font-display font-black text-ueap-blue-dark tracking-tighter uppercase leading-none italic">
                    Notícias<span class="text-ueap-green not-italic ml-1" aria-hidden="true">_</span>
                </h2>

                <a href="{{ route('site.post.list', ['type' => 'news']) }}" aria-label="Ver todas as notícias"
                    class="group flex items-center gap-3 lg:gap-4 text-ueap-blue-dark font-black hover:text-ueap-green transition-all uppercase text-[10px] lg:text-[11px] tracking-widest shrink-0">
                    <span class="relative">Ver Todo o Acervo
                        <span
                            class="absolute -bottom-1 left-0 w-full h-[2px] bg-ueap-green scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                    </span>
                    <div
                        class="w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center border-2 border-ueap-blue-dark group-hover:border-ueap-green group-hover:bg-ueap-green group-hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor font-bold">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </a>

                {{-- Linha de Divisão --}}
                <div class="absolute bottom-0 right-0 h-[2px] w-[60%] lg:w-[45%] bg-gradient-to-l from-ueap-blue/20 to-transparent"
                    aria-hidden="true"></div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-y-12 lg:gap-x-16">

            {{-- Coluna Esquerda: O Destaque Principal --}}
            <div class="col-span-12 lg:col-span-7 flex flex-col">
                @foreach ($posts->take(1) as $post)
                    <article class="group relative flex flex-col h-full">
                        <div class="relative w-full aspect-[16/9] overflow-hidden bg-ueap-blue-dark shadow-xl">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000">
                            <div class="absolute bottom-0 left-0 bg-ueap-green px-4 py-2 lg:px-6">
                                <span
                                    class="text-ueap-blue-dark text-[10px] lg:text-[11px] font-black uppercase tracking-widest italic">
                                    {{ $post->category->name ?? 'Destaque' }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 lg:mt-8 flex flex-col">
                            <div class="flex items-center gap-3 lg:gap-4 mb-4 text-[11px] font-bold text-gray-400">
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}"
                                    class="text-ueap-blue-dark uppercase tracking-widest">
                                    <span class="text-ueap-green" aria-hidden="true">//</span>
                                    {{ $post->created_at->translatedFormat('d.M.Y') }}
                                </time>
                                <span class="w-8 h-px bg-gray-200" aria-hidden="true"></span>
                                <span class="uppercase tracking-widest font-black text-ueap-blue">Notícia
                                    Principal</span>
                            </div>

                            <a href="{{ route('site.post.show', $post->slug) }}">
                                <h3
                                    class="text-3xl lg:text-5xl font-display font-black text-ueap-blue-dark leading-[0.9] tracking-tighter mb-5 group-hover:text-ueap-green transition-colors uppercase italic">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <p
                                class="text-gray-600 text-sm lg:text-base leading-relaxed max-w-2xl border-l-4 border-ueap-green pl-6 py-1 line-clamp-3">
                                {{ Str::limit(strip_tags($post->text), 220) }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Coluna Direita: Lista de Recentes --}}
            <div class="col-span-12 lg:col-span-5 flex flex-col h-full" role="region" aria-label="Notícias recentes">
                <div class="flex flex-col space-y-2">
                    @foreach ($posts->skip(1)->take(4) as $post)
                        <article
                            class="group flex items-center gap-4 lg:gap-6 py-5 transition-all hover:bg-white hover:shadow-sm px-4 border-b border-gray-100">
                            <span
                                class="font-display text-gray-200 text-xl lg:text-2xl font-black group-hover:text-ueap-green transition-all"
                                aria-hidden="true">
                                {{ str_pad($loop->iteration + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div class="flex-1 min-w-0">
                                <div class="text-[9px] font-black text-ueap-blue uppercase tracking-widest mb-1">
                                    {{ $post->category->name ?? 'Informativo' }}</div>
                                <a href="{{ route('site.post.show', $post->slug) }}">
                                    <h4
                                        class="text-sm lg:text-base font-display font-bold text-ueap-blue-dark leading-tight group-hover:text-ueap-green transition-all uppercase italic tracking-tighter line-clamp-2">
                                        {{ $post->title }}
                                    </h4>
                                </a>
                            </div>
                            <div class="shrink-0 w-14 h-14 lg:w-16 lg:h-16 overflow-hidden bg-gray-100 rounded">
                                <img src="{{ $post->image_url }}" alt=""
                                    class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Newsletter Reformulada --}}
                <div id="newsletter" class="mt-8 lg:mt-auto">
                    <div class="bg-ueap-blue-dark p-6 lg:p-8 relative overflow-hidden shadow-xl rounded-lg">
                        <div class="absolute right-0 top-0 w-24 h-full bg-ueap-green/10 skew-x-[-20deg] translate-x-12"
                            aria-hidden="true"></div>

                        <h5
                            class="text-white text-xl lg:text-2xl font-display font-black uppercase italic tracking-tighter mb-1 relative z-10">
                            Informativo <span class="text-ueap-green">UEAP</span>
                        </h5>
                        <p
                            class="text-blue-200/60 font-sans text-[10px] uppercase tracking-widest mb-6 relative z-10 font-bold">
                            Assine nosso boletim acadêmico</p>

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="relative z-10">
                            @csrf
                            <input type="email" name="email" placeholder="SEU MELHOR E-MAIL" required
                                class="w-full bg-white/10 border border-white/20 text-white text-xs font-bold tracking-widest px-5 py-4 focus:ring-2 focus:ring-ueap-green outline-none transition-all placeholder:text-blue-200/30">

                            <button type="submit"
                                class="absolute right-0 top-0 bottom-0 px-6 bg-ueap-green text-ueap-blue-dark hover:bg-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
