<section class="py-12 lg:py-24 bg-white">
    <div class="max-w-[1440px] mx-auto px-4 lg:px-12">
        
        {{-- Header Editorial --}}
        <div class="relative flex flex-col mb-10">
            <div class="flex items-center gap-3 mb-2">
                <span class="h-[2px] w-12 bg-emerald-500"></span>
                <span class="text-emerald-600 font-black text-[11px] uppercase tracking-[0.4em]">Fique por dentro</span>
            </div>
            <div class="flex items-baseline justify-between border-b border-slate-900/10 pb-4">
                <h2 class="text-4xl lg:text-6xl font-black text-slate-900 tracking-tighter uppercase leading-none">
                    Notícias<span class="text-emerald-500 italic ml-1">.</span>
                </h2>

                {{-- Botão Ver Acervo (Recuperado) --}}
                <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                    class="group flex items-center gap-3 text-slate-500 font-bold hover:text-emerald-600 transition-all uppercase text-[10px] tracking-widest shrink-0">
                    <span class="block border-b-2 border-transparent group-hover:border-emerald-500 pb-0.5 transition-all">Ver acervo</span>
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-sm ring-1 ring-slate-200 group-hover:ring-emerald-500 group-hover:bg-emerald-50 transition-all">
                        <i class="fa-solid fa-arrow-right-long text-slate-400 group-hover:text-emerald-600 transition-transform group-hover:translate-x-0.5"></i>
                    </div>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-y-10 lg:gap-x-16">
            
            {{-- Coluna Esquerda: O Destaque --}}
            <div class="col-span-12 lg:col-span-7">
                @foreach ($posts->take(1) as $post)
                    <article class="group relative flex flex-col h-full">
                        <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100 rounded-[2px]">
                            <img src="{{ $post->image_url ?: 'https://picsum.photos/seed/'.$post->id.'/1200/800' }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-1000">
                            
                            <div class="absolute top-4 left-4 backdrop-blur-md bg-white/80 border border-white/20 px-3 py-1 shadow-sm">
                                <span class="text-slate-900 text-[9px] font-black uppercase tracking-widest italic">
                                    {{ $post->category->name ?? 'Update' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex flex-col">
                            <div class="flex items-center gap-4 mb-4 text-[10px] font-bold text-slate-400">
                                <time class="flex items-center gap-1.5 uppercase tracking-widest">
                                    <i class="fa-regular fa-calendar-check text-emerald-500"></i>
                                    {{ $post->created_at->translatedFormat('d M Y') }}
                                </time>
                                <span class="w-[1px] h-3 bg-slate-200"></span>
                                <span class="uppercase tracking-widest italic font-black text-slate-900">Destaque</span>
                            </div>
                            
                            <a href="{{ route('site.post.show', $post->slug) }}">
                                <h3 class="text-3xl lg:text-5xl font-black text-slate-900 leading-[0.95] tracking-tighter mb-6 group-hover:text-emerald-600 transition-colors">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            
                            <p class="text-slate-600 text-sm lg:text-base leading-relaxed max-w-2xl font-medium border-l-2 border-slate-100 pl-6">
                                {{ Str::limit(clean_text(html_entity_decode(strip_tags($post->text))), 240) }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Coluna Direita --}}
            <div class="col-span-12 lg:col-span-5 flex flex-col">
                <div class="flex flex-col gap-1 divide-y-2 divide-slate-50">
                    @foreach ($posts->skip(1)->take(4) as $post)
                        <article class="group flex items-start gap-5 py-5 first:pt-0 transition-all">
                            {{-- Numeração Retornada --}}
                            <span class="text-slate-200 font-black text-2xl italic leading-none group-hover:text-emerald-200 transition-colors pt-1">
                                0{{ $loop->iteration + 1 }}
                            </span>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-tighter">{{ $post->category->name ?? 'News' }}</span>
                                    <span class="text-slate-300 text-[10px]">—</span>
                                    <time class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $post->created_at->format('d.m.Y') }}</time>
                                </div>
                                <a href="{{ route('site.post.show', $post->slug) }}">
                                    <h4 class="text-lg lg:text-xl font-extrabold text-slate-800 leading-tight group-hover:text-emerald-600 transition-all line-clamp-2">
                                        {{ $post->title }}
                                    </h4>
                                </a>
                            </div>

                            <div class="shrink-0 w-16 h-16 lg:w-20 lg:h-20 overflow-hidden rounded-sm grayscale hover:grayscale-0 transition-all duration-500 border border-slate-100 shadow-sm">
                                <img src="{{ $post->image_url ?: 'https://picsum.photos/seed/'.$post->id.'/300/300' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            </div>
                        </article>
                    @endforeach
                </div>
                
                {{-- Newsletter Express (Identidade Visual Mantida) --}}
                <div class="mt-auto pt-8 border-t-4 border-slate-900 group">
                    <div class="bg-slate-900 p-6 rounded-[2px] relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl"></div>
                        
                        <h5 class="text-white text-xl font-black uppercase italic tracking-tighter mb-2">
                            <span class="text-emerald-500 italic">UEAP</span>Newsletter 
                        </h5>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-6 leading-tight">
                            As últimas publicações direto no seu email.
                        </p>
                        
                        <form action="#" class="relative">
                            <input type="email" placeholder="SEU E-MAIL" 
                                class="w-full bg-slate-800 border-none text-white text-[10px] font-black tracking-[0.2em] px-4 py-4 focus:ring-1 focus:ring-emerald-500 placeholder:text-slate-600">
                            <button class="absolute right-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-emerald-500 text-white flex items-center justify-center hover:bg-emerald-400 transition-colors">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>