{{-- SEÇÃO NOTÍCIAS - ARQUITETURA PREMIUM DARK --}}
<section class="py-24 lg:py-48 bg-[#001030] relative overflow-hidden">
    
    {{-- LAYER 0: GEOMETRIA ESTRUTURAL (WIRE FRAME) --}}
    <div class="absolute inset-0 pointer-events-none z-0" aria-hidden="true">
        {{-- Texto Gigante de Fundo com Stroke --}}
        <div class="absolute top-10 left-10 text-[200px] font-black leading-none select-none opacity-[0.03] uppercase tracking-tighter text-white" style="-webkit-text-stroke: 4px white; color: transparent;">
            Notícias
        </div>

        {{-- Retângulos de 8px e 12px posicionados para equilíbrio visual --}}
        <div class="absolute top-[15%] right-[-5%] w-[600px] h-[400px] border-[8px] border-[#A4ED4A]/20 rounded-[100px] rotate-[15deg]"></div>
        <div class="absolute bottom-[5%] left-[-10%] w-[800px] h-[500px] border-[12px] border-[#0055FF]/10 rounded-[150px] -rotate-6"></div>
        
        {{-- Padrão de Pontos Neon --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-20" 
             style="background-image: radial-gradient(#A4ED4A 1px, transparent 1px); background-size: 40px 40px;"></div>

        {{-- Luz de Fundo (Glow) --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[#0055FF]/5 blur-[180px] rounded-full"></div>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 lg:px-12 relative z-10">
        
        {{-- HEADER EDITORIAL --}}
        <div class="relative mb-24 flex flex-col lg:flex-row lg:items-end justify-between gap-10">
            <div class="max-w-3xl">
                <div class="flex items-center gap-4 mb-8">
                    <span class="h-[1px] w-20 bg-[#A4ED4A]"></span>
                    <span class="font-black text-[10px] text-[#A4ED4A] uppercase tracking-[0.5em]">Press Release</span>
                </div>
                <h2 class="text-7xl lg:text-[10rem] font-black text-white tracking-tighter uppercase leading-[0.75]">
                    Mundo <br><span class="text-transparent" style="-webkit-text-stroke: 2px #0055FF;">UEAP</span><span class="text-[#A4ED4A]">.</span>
                </h2>
            </div>
            
            <a href="{{ route('site.post.list', ['type' => 'news']) }}" 
               class="group relative inline-flex items-center gap-6 bg-[#A4ED4A] text-[#001540] px-12 py-6 rounded-2xl font-black hover:bg-white transition-all shadow-[0_20px_60px_rgba(164,237,74,0.3)] uppercase text-xs tracking-widest overflow-hidden">
                <span class="relative z-10">Ver Todas</span>
                <i class="fa-solid fa-arrow-right-long relative z-10 group-hover:translate-x-2 transition-transform"></i>
            </a>
        </div>

        {{-- GRID DE 6 NOTÍCIAS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-16 mb-40">
            @foreach ($posts->take(6) as $post)
                <article class="group relative">
                    {{-- Elemento Geométrico Atrás do Card --}}
                    <div class="absolute -inset-2 border-2 border-[#A4ED4A]/0 group-hover:border-[#A4ED4A]/40 rounded-[60px] transition-all duration-500 scale-95 group-hover:scale-100"></div>
                    
                    <div class="relative bg-white rounded-[55px] p-4 shadow-[0_40px_100px_-20px_rgba(0,0,0,0.4)] flex flex-col h-full transition-transform duration-500 group-hover:-translate-y-4">
                        
                        {{-- Imagem em Moldura --}}
                        <div class="relative aspect-[16/11] overflow-hidden rounded-[45px] mb-8">
                            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#001540]/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            {{-- Category Badge --}}
                            <div class="absolute bottom-6 left-6">
                                <span class="bg-[#001540] text-white font-black text-[8px] uppercase tracking-[0.2em] px-4 py-2 rounded-xl shadow-2xl">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                        </div>

                        <div class="px-6 pb-8 flex-1 flex flex-col">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-[#0055FF] font-black text-[10px] uppercase tracking-widest">
                                    {{ $post->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>
                            
                            <a href="{{ route('site.post.show', $post->slug) }}">
                                <h3 class="text-2xl lg:text-3xl font-black text-[#001540] leading-tight tracking-tighter group-hover:text-[#0055FF] transition-colors mb-6">
                                    {{ $post->title }}
                                </h3>
                            </a>
                            
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-2 mb-8 italic">
                                {{ Str::limit(strip_tags($post->text), 110) }}
                            </p>

                            <div class="mt-auto pt-6 border-t border-slate-50 flex justify-between items-center">
                                <span class="text-[10px] font-black text-[#001540] uppercase tracking-widest opacity-40">Leia Mais</span>
                                <div class="w-12 h-12 rounded-full bg-slate-50 group-hover:bg-[#A4ED4A] flex items-center justify-center transition-all shadow-sm">
                                    <i class="fa-solid fa-arrow-up-right text-xs text-[#001540]"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- NEWSLETTER: O ACABAMENTO FINAL (ULTRA CONTRASTE) --}}
        <div id="newsletter" class="max-w-5xl mx-auto relative">
            {{-- Retângulo Decorativo Pesado (12px) --}}
            <div class="absolute -top-12 -left-12 w-40 h-40 border-[12px] border-[#A4ED4A]/20 rounded-[40px] rotate-12"></div>
            
            <div class="bg-white rounded-[70px] p-10 lg:p-24 relative overflow-hidden shadow-[0_60px_150px_-20px_rgba(0,0,0,0.6)]">
                
                {{-- Círculo Azul (Fiel ao design anterior mas refinado) --}}
                <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-[#0055FF] rounded-full opacity-[0.07]" aria-hidden="true"></div>
                
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h5 class="text-[#001540] text-4xl lg:text-7xl font-black uppercase tracking-tighter leading-[0.85] mb-6">
                            Assine a <br><span class="text-[#0055FF]">Newsletter.</span>
                        </h5>
                        <p class="text-slate-400 font-bold text-sm lg:text-lg uppercase tracking-widest">A UEAP direto na sua caixa de entrada.</p>
                    </div>

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="relative">
                        @csrf
                        <div class="space-y-4">
                            <input 
                                type="email"
                                name="email"
                                placeholder="SEU MELHOR E-MAIL"
                                required
                                class="w-full bg-slate-50 border-2 border-slate-100 focus:border-[#0055FF] focus:bg-white rounded-3xl text-[#001540] text-sm font-bold px-8 py-7 outline-none transition-all shadow-inner"
                            >
                            <button type="submit" class="w-full bg-[#001540] text-white py-7 rounded-3xl font-black uppercase text-xs tracking-[0.3em] hover:bg-[#A4ED4A] hover:text-[#001540] transition-all shadow-2xl">
                                Confirmar Cadastro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>