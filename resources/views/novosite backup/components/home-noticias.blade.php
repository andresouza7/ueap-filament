<section class="py-10 lg:py-16 bg-white relative overflow-hidden" aria-label="Notícias e Atualidades">
    {{-- EFEITO DE BACKGROUND --}}
    <div class="absolute inset-0 pointer-events-none z-0" aria-hidden="true">
        {{-- O Skew: h-[25%] no mobile e h-[85%] no desktop --}}
        <div class="absolute -top-[5%] -left-[10%] w-[80%] lg:w-[55%] h-[25%] lg:h-[85%] bg-slate-50 -skew-x-12 border-r-4 border-slate-200/40 shadow-[40px_0_70px_-30px_rgba(0,0,0,0.03)] transition-all duration-500">
            <div class="absolute inset-0 opacity-[0.18]" 
                 style="background-image: linear-gradient(to right, #cbd5e1 1px, transparent 1px), linear-gradient(to bottom, #cbd5e1 1px, transparent 1px);
                        background-size: 40px 40px;
                        mask-image: linear-gradient(to right, black 10%, transparent 85%), linear-gradient(to bottom, black 10%, transparent 85%);
                        -webkit-mask-image: linear-gradient(to right, black 10%, transparent 85%), linear-gradient(to bottom, black 10%, transparent 85%);">
            </div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-[#020617]/[0.03] via-emerald-500/[0.01] to-transparent"></div>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 lg:px-12 relative z-10">

        {{-- Header Editorial --}}
        <div class="relative flex flex-col mb-8 lg:mb-10">
            <div class="flex items-center gap-3 mb-1">
                <span class="h-[2px] w-8 lg:w-12 bg-emerald-500" aria-hidden="true"></span>
                <span class="text-emerald-600 font-mono text-[9px] lg:text-[10px] uppercase tracking-[0.5em] font-bold">CORE_STREAM_v.04</span>
            </div>

            <div class="flex flex-wrap items-end justify-between pb-4 lg:pb-6 gap-y-4 relative">
                <h2 class="text-3xl lg:text-7xl font-[1000] text-slate-900 tracking-tighter uppercase leading-none italic">
                    Notícias<span class="text-emerald-500 not-italic ml-1" aria-hidden="true">_</span>
                </h2>

                <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                    aria-label="Ver acervo completo de notícias"
                    class="group flex items-center gap-3 lg:gap-4 text-slate-900 font-black hover:text-emerald-600 transition-all uppercase text-[9px] lg:text-[10px] tracking-[0.2em] shrink-0">
                    <span class="relative">Ver Acervo
                        <span class="absolute -bottom-1 left-0 w-full h-[2px] bg-emerald-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></span>
                    </span>
                    <div class="w-8 h-8 lg:w-10 lg:h-10 flex items-center justify-center border-2 border-slate-900 group-hover:border-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-arrow-right text-xs lg:text-sm" aria-hidden="true"></i>
                    </div>
                </a>
                
                {{-- Linha com Fade da Direita para Esquerda --}}
                <div class="absolute bottom-0 right-0 h-[1px] w-[60%] lg:w-[45%] bg-gradient-to-l from-slate-900/20 to-transparent" aria-hidden="true"></div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-y-10 lg:gap-x-20">

            {{-- Coluna Esquerda: O Destaque --}}
            <div class="col-span-12 lg:col-span-7 flex flex-col">
                @foreach ($posts->take(1) as $post)
                    <article class="group relative flex flex-col h-full">
                        <div class="relative w-full aspect-[16/9] overflow-hidden bg-slate-900 shadow-xl lg:shadow-2xl">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-[1.05] transition-all duration-1000 grayscale-[0.3] group-hover:grayscale-0">
                            <div class="absolute bottom-0 left-0 bg-emerald-600 px-4 py-1.5 lg:px-6 lg:py-2">
                                <span class="text-white text-[9px] lg:text-[10px] font-black uppercase tracking-[0.2em] italic">
                                    {{ $post->category->name ?? 'Update' }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 lg:mt-8 flex flex-col">
                            <div class="flex items-center gap-3 lg:gap-4 mb-3 lg:mb-4 text-[10px] lg:text-[11px] font-mono text-slate-400">
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}" class="font-bold text-slate-900 uppercase tracking-widest">
                                    <span class="text-emerald-500" aria-hidden="true">//</span> {{ $post->created_at->translatedFormat('d.M.Y') }}
                                </time>
                                <span class="w-8 lg:w-12 h-px bg-slate-200" aria-hidden="true"></span>
                                <span class="uppercase tracking-widest font-black text-emerald-600">LEAD_POST</span>
                            </div>

                            <a href="{{ route('site.post.show', $post->slug) }}">
                                <h3 class="text-3xl lg:text-5xl font-[1000] text-slate-900 leading-[0.9] tracking-tighter mb-4 lg:mb-6 group-hover:text-emerald-600 transition-colors uppercase italic">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            <p class="text-slate-600 text-sm lg:text-base leading-relaxed max-w-2xl font-medium border-l-[3px] lg:border-l-[4px] border-emerald-500 pl-6 lg:pl-8 py-1 lg:py-2 line-clamp-3 lg:line-clamp-none">
                                {{ Str::limit(clean_text(html_entity_decode(strip_tags($post->text))), 220) }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Coluna Direita: Linhas unificadas --}}
            <div class="col-span-12 lg:col-span-5 flex flex-col h-full relative z-20" role="region" aria-label="Notícias recentes">
                <div class="flex flex-col">
                    @foreach ($posts->skip(1)->take(4) as $post)
                        <article class="group flex items-center gap-4 lg:gap-6 py-4 transition-all hover:bg-emerald-50/40 px-2 lg:px-4 border-b border-slate-900/10">
                            <span class="font-mono text-slate-200 text-lg lg:text-xl font-bold group-hover:text-emerald-500 transition-all" aria-hidden="true">[0{{ $loop->iteration + 1 }}]</span>
                            <div class="flex-1 min-w-0">
                                <div class="text-[8px] lg:text-[9px] font-black text-emerald-600 uppercase tracking-widest mb-0.5 lg:mb-1">{{ $post->category->name ?? 'News' }}</div>
                                <a href="{{ route('site.post.show', $post->slug) }}">
                                    <h4 class="text-sm lg:text-base font-[1000] text-slate-800 leading-tight group-hover:text-emerald-600 transition-all uppercase italic tracking-tighter line-clamp-2">
                                        {{ $post->title }}
                                    </h4>
                                </a>
                            </div>
                            <div class="shrink-0 w-12 h-12 lg:w-16 lg:h-16 overflow-hidden border border-slate-200 grayscale group-hover:grayscale-0 transition-all duration-500 shadow-sm">
                                <img src="{{ $post->image_url }}" alt="" class="w-full h-full object-cover" aria-hidden="true">
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Newsletter Original --}}
                <div id="newsletter" class="mt-8 lg:mt-auto pt-6 lg:pt-8">
                    <div class="bg-slate-950 p-6 lg:p-8 relative overflow-hidden shadow-2xl border-t border-slate-800">
                        <div class="absolute right-0 top-0 w-24 h-full bg-emerald-500/10 skew-x-[-20deg] translate-x-12" aria-hidden="true"></div>
                        <h5 class="text-white text-xl lg:text-2xl font-[1000] uppercase italic tracking-tighter mb-1 relative z-10">
                            <span class="text-emerald-500">UEAP</span>_NEWSLETTER
                        </h5>
                        <p class="text-slate-500 font-mono text-[9px] uppercase tracking-[0.3em] mb-6 relative z-10">Sincronizar boletim informativo</p>
                        
                        {{-- Newsletter, com método --}}
                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="relative z-10">
                            @csrf

                            <input 
                                type="email"
                                name="email"
                                aria-label="Endereço de e-mail para newsletter"
                                placeholder="ENDEREÇO_DE_EMAIL"
                                required
                                class="w-full bg-slate-900 border border-slate-800 text-white text-[10px] font-mono tracking-[0.2em] px-5 py-3 lg:py-4 focus:ring-1 focus:ring-emerald-500 outline-none transition-all placeholder:text-slate-700"
                            >

                            <button type="submit" aria-label="Inscrever-se na newsletter" class="absolute right-0 top-0 bottom-0 px-4 lg:px-6 bg-emerald-500 text-slate-950 hover:bg-emerald-400 transition-colors">
                                <i class="fa-solid fa-arrow-right text-sm" aria-hidden="true"></i>
                            </button>
                        </form>


                        @if(session('success'))
                            <p class="text-emerald-500 text-xs mt-3 font-mono" role="alert">
                                {{ session('success') }}
                            </p>
                        @endif

                        @if($errors->any())
                            <p class="text-red-500 text-xs mt-3 font-mono" role="alert">
                                {{ $errors->first('email') }}
                            </p>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>