{{-- SEÇÃO MURAL DE NOTÍCIAS - 6 CARDS + BACKGROUND BRUTALISTA RESTAURADO --}}
<section class="py-24 lg:py-48 bg-slate-100 relative overflow-hidden" aria-label="Notícias e Atualidades">

    {{-- LAYER 0: GEOMETRIA ESTRUTURAL (Restauração das Formas e Texto Gigante) --}}
    <div class="absolute inset-0 pointer-events-none z-0" aria-hidden="true">
        {{-- Texto Gigante de Fundo --}}
        <div class="absolute top-10 left-10 text-[200px] lg:text-[400px] font-black leading-none select-none opacity-[0.03] uppercase tracking-tighter text-[#001a4d]"
            style="-webkit-text-stroke: 4px #001a4d; color: transparent;">
            Mundo
        </div>

        {{-- Retângulos Decorativos Restaurados --}}
        <div
            class="absolute top-[15%] right-[-5%] w-[600px] h-[400px] border-[8px] border-[#001a4d]/5 rounded-[100px] rotate-[15deg]">
        </div>
        <div
            class="absolute bottom-[10%] left-[-10%] w-[800px] h-[500px] border-[12px] border-[#A4ED4A]/10 rounded-[150px] -rotate-6">
        </div>

        {{-- Padrão de Pontos Halftone --}}
        <div class="absolute inset-0 opacity-[0.1]"
            style="background-image: radial-gradient(#0055FF 1px, transparent 1px); background-size: 40px 40px;">
        </div>

        {{-- Glow de Fundo --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[#A4ED4A]/5 blur-[180px] rounded-full">
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 lg:px-12 relative z-10">

        {{-- HEADER EDITORIAL BRUTALISTA (Restaurado) --}}
        <div class="relative mb-24 flex flex-col lg:flex-row lg:items-end justify-between gap-10">
            <div class="max-w-4xl">
                <div class="flex items-center gap-4 mb-8">
                    <span class="h-[1px] w-20 bg-[#001a4d]"></span>
                    <span class="font-black text-[10px] text-[#001a4d] uppercase tracking-[0.5em]">Informativo
                        Institucional</span>
                </div>
                <h2
                    class="text-7xl lg:text-[10rem] font-black text-[#001a4d] tracking-tighter uppercase leading-[0.75]">
                    Notícias <br><span class="text-transparent"
                        style="-webkit-text-stroke: 2px #001a4d;">UEAP</span><span class="text-[#A4ED4A]">.</span>
                </h2>
            </div>

            <a href="{{ route('site.post.list', ['type' => 'news']) }}"
                class="group relative inline-flex items-center gap-6 bg-[#001a4d] text-white px-12 py-6 rounded-2xl font-black hover:bg-[#A4ED4A] hover:text-[#001a4d] transition-all shadow-[0_20px_60px_rgba(0,26,77,0.2)] uppercase text-xs tracking-widest overflow-hidden">
                <span class="relative z-10">Ver Todas</span>
                <i
                    class="fa-solid fa-arrow-right-long relative z-10 group-hover:translate-x-2 transition-transform"></i>
            </a>
        </div>

        {{-- GRID DE 6 NOTÍCIAS (DESIGN DE CARDS IGUAIS) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-14 mb-32">
            @foreach ($posts->take(6) as $post)
                <article
                    class="group relative flex flex-col bg-white rounded-[55px] p-5 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.08)] border border-slate-100 transition-all duration-500 hover:-translate-y-4 hover:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)]">

                    {{-- Imagem --}}
                    <div class="relative aspect-[16/11] overflow-hidden rounded-[45px] mb-8 shadow-sm">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                        {{-- Badge Categoria --}}
                        <div class="absolute top-6 left-6">
                            <span
                                class="bg-[#001a4d] text-[#A4ED4A] px-5 py-2.5 rounded-xl text-[9px] font-[1000] uppercase tracking-widest shadow-2xl">
                                {{ $post->category->name ?? 'Update' }}
                            </span>
                        </div>
                    </div>

                    {{-- Conteúdo do Card --}}
                    <div class="px-4 pb-6 flex flex-col flex-1">
                        <time
                            class="text-[#0055FF] font-black uppercase tracking-[0.2em] text-[10px] mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 bg-[#A4ED4A] rounded-full"></span>
                            {{ $post->created_at->translatedFormat('d M Y') }}
                        </time>

                        <a href="{{ route('site.post.show', $post->slug) }}" class="flex-1">
                            <h3
                                class="text-2xl lg:text-3xl font-[1000] text-[#001a4d] leading-[1.1] tracking-tighter mb-6 group-hover:text-[#0055FF] transition-colors line-clamp-3 italic">
                                {{ $post->title }}
                            </h3>
                        </a>

                        {{-- Footer do Card --}}
                        <div class="pt-6 border-t border-slate-50 flex justify-between items-center">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ler
                                Reportagem_</span>
                            <div
                                class="w-12 h-12 rounded-full bg-slate-50 group-hover:bg-[#A4ED4A] flex items-center justify-center transition-all">
                                <i class="fa-solid fa-arrow-up-right text-[12px] text-[#001a4d]"></i>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- NEWSLETTER (Harmonizada em Faixa) --}}
        <div id="newsletter" class="relative">
            <div class="bg-[#001a4d] rounded-[60px] lg:rounded-[80px] p-10 lg:p-20 relative overflow-hidden shadow-2xl">
                <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-[#0055FF] rounded-full opacity-10"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12">
                    <div class="max-w-xl">
                        <h5
                            class="text-white text-4xl lg:text-6xl font-black uppercase tracking-tighter leading-[0.85] mb-4">
                            Assine a <br><span class="text-[#A4ED4A]">Newsletter.</span>
                        </h5>
                        <p class="text-blue-200/40 font-bold text-xs uppercase tracking-[0.3em]">A UEAP direto na sua
                            caixa de entrada_</p>
                    </div>

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="w-full lg:max-w-md">
                        @csrf
                        <div class="flex flex-col gap-4">
                            <input type="email" name="email" placeholder="SEU MELHOR E-MAIL" required
                                class="w-full bg-white/5 border-2 border-white/10 focus:border-[#A4ED4A] focus:bg-white/10 rounded-3xl text-white text-sm font-bold px-8 py-6 outline-none transition-all">
                            <button type="submit"
                                class="w-full bg-[#A4ED4A] text-[#001a4d] py-6 rounded-3xl font-black uppercase text-xs tracking-widest hover:brightness-110 transition-all shadow-xl">
                                Confirmar Cadastro_
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
