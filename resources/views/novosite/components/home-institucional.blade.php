{{-- SECTION: SERVIÇOS & PLATAFORMAS - DESIGN ANTERIOR COM GEOMETRIA PESADA --}}
<section aria-labelledby="services-platforms-title" class="relative overflow-hidden bg-slate-50 py-24 md:py-40">

    {{-- ELEMENTOS GEOMÉTRICOS DE FUNDO (Preservando a grossura e posição solicitada) --}}
    <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden" aria-hidden="true">
        {{-- Retângulo Superior (Verde Heavy) --}}
        <div
            class="absolute top-[5%] -left-20 w-[500px] h-[400px] border-[8px] border-[#A4ED4A] rounded-[80px] -rotate-12 opacity-30">
        </div>

        {{-- Retângulo Central (Estrutural) --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1200px] h-[700px] border-[12px] border-slate-200/50 rounded-[120px] rotate-3">
        </div>

        {{-- Retângulo Inferior (Azul Heavy) --}}
        <div
            class="absolute bottom-[5%] -right-20 w-[600px] h-[300px] border-[8px] border-[#0055FF]/10 rounded-[60px] rotate-12">
        </div>

        {{-- Padrão de Pontos (Halftone) conforme a imagem --}}
        <div class="absolute top-0 left-0 w-64 h-64 opacity-20"
            style="background-image: radial-gradient(#001540 2px, transparent 2px); background-size: 15px 15px;"></div>

        <div class="absolute bottom-0 right-0 w-96 h-96 opacity-10"
            style="background-image: radial-gradient(#0055FF 3px, transparent 3px); background-size: 20px 20px;"></div>
    </div>

    <div class="max-w-[1440px] relative z-10 mx-auto px-4 md:px-12">

        <h2 id="services-platforms-title" class="sr-only">Canais de Atendimento e Plataformas Digitais</h2>

        <div class="space-y-32 md:space-y-52">

            {{-- SUB-BLOCO 01: ATENDIMENTO --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start" role="group"
                aria-labelledby="atendimento-title">

                <div class="w-full lg:col-span-6 relative z-20">
                    <div
                        class="mb-10 inline-flex items-center gap-3 bg-[#A4ED4A] text-[#001540] px-6 py-3 rounded-2xl shadow-sm">
                        <span class="font-black text-[10px] uppercase tracking-[0.2em]">Suporte ao Aluno</span>
                    </div>
                    <h2 id="atendimento-title"
                        class="text-6xl md:text-8xl font-black text-[#001540] uppercase tracking-tighter leading-[0.85] mb-10">
                        Canais de <br><span class="text-[#0055FF]">Atendimento</span><span
                            class="text-[#A4ED4A]">.</span>
                    </h2>
                    <p
                        class="text-slate-500 font-bold max-w-sm text-lg md:text-xl leading-snug border-l-4 border-[#A4ED4A] pl-8">
                        Precisa de ajuda? Utilize nossos canais oficiais para suporte e informações acadêmicas.
                    </p>
                </div>

                <div class="w-full lg:col-span-6 relative z-10 grid grid-cols-1 gap-6">
                    {{-- CARD CARTA DE SERVIÇO --}}
                    <a href="https://cartaservico.portal.ap.gov.br/carta-de-servico-publica/orgao/46/servicos"
                        target="_blank" rel="noopener"
                        class="group flex items-center p-8 md:p-10 bg-white/90 backdrop-blur-sm rounded-[45px] shadow-[0_20px_60px_-15px_rgba(0,21,64,0.08)] hover:shadow-[0_35px_80px_-20px_rgba(0,21,64,0.15)] transition-all border border-white">
                        <div
                            class="w-20 h-20 bg-slate-50 rounded-[28px] flex items-center justify-center mr-8 shrink-0 shadow-inner group-hover:bg-[#A4ED4A] transition-all duration-500">
                            <i class="fa-solid fa-file-invoice text-[#0055FF] text-3xl group-hover:text-[#001540]"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3
                                class="text-3xl md:text-4xl font-black text-[#001540] uppercase tracking-tighter leading-none mb-2">
                                Carta de Serviços</h3>
                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest block">Portal do
                                Governo do Amapá</span>
                        </div>
                        <div
                            class="w-14 h-14 rounded-full border-2 border-slate-100 flex items-center justify-center group-hover:bg-[#001540] group-hover:border-[#001540] transition-all ml-4 shrink-0 shadow-sm">
                            <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-[#A4ED4A]"></i>
                        </div>
                    </a>

                    {{-- CARD OUVIDORIA --}}
                    <a href="https://ouvamapa.portal.ap.gov.br/" target="_blank" rel="noopener"
                        class="group flex items-center p-8 md:p-10 bg-white/90 backdrop-blur-sm rounded-[45px] shadow-[0_20px_60px_-15px_rgba(0,21,64,0.08)] hover:shadow-[0_35px_80px_-20px_rgba(0,21,64,0.15)] transition-all border border-white">
                        <div
                            class="w-20 h-20 bg-[#001540] rounded-[28px] flex items-center justify-center mr-8 shrink-0 shadow-lg group-hover:scale-105 transition-transform duration-500">
                            <i class="fa-solid fa-comments text-[#A4ED4A] text-3xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3
                                class="text-3xl md:text-4xl font-black text-[#001540] uppercase tracking-tighter leading-none mb-2">
                                Ouvidoria UEAP</h3>
                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest block">Canal
                                oficial de Feedback</span>
                        </div>
                        <div
                            class="w-14 h-14 rounded-full border-2 border-slate-100 flex items-center justify-center group-hover:bg-[#001540] group-hover:border-[#001540] transition-all ml-4 shrink-0 shadow-sm">
                            <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-[#A4ED4A]"></i>
                        </div>
                    </a>
                </div>
            </div>

            {{-- SUB-BLOCO 02: REDES SOCIAIS --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start" role="group"
                aria-labelledby="plataformas-title">

                <div class="w-full lg:col-span-5 lg:order-2 lg:text-right relative z-20">
                    <div
                        class="mb-10 inline-flex lg:flex-row-reverse items-center gap-3 bg-[#0055FF] text-white px-6 py-3 rounded-2xl shadow-sm">
                        <span class="font-black text-[10px] uppercase tracking-[0.2em]">Conecte-se</span>
                    </div>
                    <h2 id="plataformas-title"
                        class="text-6xl md:text-8xl font-black text-[#001540] uppercase tracking-tighter leading-[0.85] mb-10">
                        Nossas <br><span class="text-[#0055FF]">Plataformas</span><span class="text-[#A4ED4A]">.</span>
                    </h2>
                    <p
                        class="text-slate-500 font-bold text-lg md:text-xl leading-snug lg:border-r-4 lg:border-[#A4ED4A] lg:pr-8">
                        Acompanhe a rotina acadêmica e conteúdos exclusivos em nossas redes oficiais.
                    </p>
                </div>

                <div class="w-full lg:col-span-7 lg:order-1 relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- CARD UEAP TV --}}
                    <a href="#"
                        class="group relative h-64 md:h-72 overflow-hidden rounded-[50px] bg-[#001540] shadow-2xl transition-all hover:-translate-y-2">
                        <div
                            class="absolute inset-0 bg-red-600 translate-y-full group-hover:translate-y-0 transition-transform duration-700 ease-out">
                        </div>
                        <div class="relative z-10 h-full p-10 flex flex-col justify-between">
                            <div
                                class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-xl group-hover:rotate-[360deg] transition-transform duration-1000">
                                <i class="fa-solid fa-play text-red-600 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-4xl font-black text-white uppercase tracking-tighter leading-none">UEAP
                                    TV</h3>
                                <span
                                    class="text-xs font-black text-[#A4ED4A] group-hover:text-white uppercase tracking-widest mt-3 block">YouTube
                                    Oficial</span>
                            </div>
                        </div>
                    </a>

                    {{-- CARD INSTAGRAM --}}
                    <a href="#"
                        class="group relative h-64 md:h-72 overflow-hidden rounded-[50px] bg-white shadow-xl border border-slate-100 hover:border-transparent transition-all hover:-translate-y-2">
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-purple-600 via-pink-600 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                        </div>
                        <div class="relative z-10 h-full p-10 flex flex-col justify-between">
                            <div
                                class="w-16 h-16 bg-slate-50 group-hover:bg-white rounded-2xl flex items-center justify-center shadow-inner group-hover:shadow-xl transition-all duration-500">
                                <i class="fa-brands fa-instagram text-[#0055FF] group-hover:text-pink-600 text-3xl"></i>
                            </div>
                            <div>
                                <h3
                                    class="text-4xl font-black text-[#001540] group-hover:text-white uppercase tracking-tighter leading-none">
                                    Instagram</h3>
                                <span
                                    class="text-xs font-black text-[#0055FF] group-hover:text-white uppercase tracking-widest mt-3 block">@ueapoficial</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
