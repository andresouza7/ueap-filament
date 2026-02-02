{{-- SECTION: SERVIÇOS & PLATAFORMAS (LAYOUT ORIGINAL ADAPTADO UEAP) --}}
<section aria-label="Canais de Atendimento e Plataformas Digitais"
    class="relative overflow-hidden bg-gradient-to-br from-gray-100 via-white to-gray-100 py-16 md:py-28 border-b border-gray-200">

    {{-- Background Texture --}}
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none" aria-hidden="true"
        style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>

    <div class="max-w-7xl relative z-10 mx-auto px-4 md:px-10">
        <div class="space-y-24 md:space-y-32">

            {{-- SUB-BLOCO 01: SERVIÇOS (ALINHADO À ESQUERDA) --}}
            <div class="flex flex-col md:flex-row items-start justify-start gap-8 lg:gap-16">
                <div class="w-full md:w-1/3 shrink-0">
                    <div class="mb-4 flex items-center gap-2">
                        <div class="h-4 w-1 bg-ueap-green" aria-hidden="true"></div>
                        <span
                            class="font-mono text-[10px] font-black uppercase tracking-[0.4em] text-ueap-blue-dark/50">Utilidade
                            Pública</span>
                    </div>
                    {{-- Título ajustado para não cortar --}}
                    <h2
                        class="text-3xl md:text-5xl font-black text-ueap-blue-dark uppercase tracking-tighter leading-[0.85] mb-6">
                        Canais de <br><span class="text-ueap-green">Atendimento</span>
                    </h2>
                    <div class="h-1 w-20 bg-ueap-blue-dark/20" aria-hidden="true"></div>
                </div>

                {{-- Cards Horizontais Originais --}}
                <div class="grid w-full md:w-1/2 grid-cols-1 gap-px bg-gray-200 shadow-2xl border border-gray-200">
                    <a href="https://cartaservico.portal.ap.gov.br/carta-de-servico-publica/orgao/46/servicos"
                        class="group flex items-center p-8 bg-white/90 backdrop-blur-sm transition-all hover:bg-white">
                        <div class="flex-1">
                            <h4
                                class="text-2xl font-black text-ueap-blue-dark uppercase tracking-tighter group-hover:text-ueap-green transition-colors">
                                Carta de Serviços
                            </h4>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right-long text-gray-300 group-hover:text-ueap-green group-hover:translate-x-2 transition-all"></i>
                    </a>

                    <a href="https://ouvamapa.portal.ap.gov.br/"
                        class="group flex items-center p-8 bg-white/90 backdrop-blur-sm transition-all hover:bg-white">
                        <div class="flex-1">
                            <h4
                                class="text-2xl font-black text-ueap-blue-dark uppercase tracking-tighter group-hover:text-ueap-green transition-colors">
                                Ouvidoria @UEAP
                            </h4>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right-long text-gray-300 group-hover:text-ueap-green group-hover:translate-x-2 transition-all"></i>
                    </a>
                </div>
            </div>

            {{-- SUB-BLOCO 02: PLATAFORMAS (ALINHADO À DIREITA) --}}
            <div class="flex flex-col md:flex-row-reverse items-start justify-start gap-8 lg:gap-16">
                <div class="w-full md:w-1/3 md:text-right flex flex-col md:items-end shrink-0">
                    <div class="mb-4 flex items-center gap-2">
                        <span
                            class="font-mono text-[10px] font-black uppercase tracking-[0.4em] text-ueap-blue-dark/50">Digital</span>
                        <div class="h-4 w-1 bg-ueap-green" aria-hidden="true"></div>
                    </div>
                    <h2
                        class="text-3xl md:text-5xl font-black text-ueap-blue-dark uppercase tracking-tighter leading-[0.85] mb-6">
                        Nossas <br><span class="text-ueap-green">Plataformas</span>
                    </h2>
                    <div class="h-1 w-20 bg-ueap-blue-dark/20" aria-hidden="true"></div>
                </div>

                {{-- Cards de Fundo Escuro Originais --}}
                <div
                    class="grid w-full md:w-1/2 grid-cols-1 md:grid-cols-2 gap-px bg-gray-200 shadow-2xl border border-gray-200">

                    {{-- CARD UEAP TV --}}
                    <a href="http://ueap.edu.br/pagina/ueap_tv.html" target="_blank"
                        class="group relative h-48 overflow-hidden bg-ueap-blue-dark">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-600 via-red-950 to-ueap-blue-dark opacity-40 group-hover:opacity-60 transition-opacity duration-500">
                        </div>

                        {{-- Ícone de Fundo --}}
                        <div
                            class="absolute inset-0 opacity-20 flex justify-end items-center -mr-6 transition-transform duration-700 group-hover:-translate-x-6">
                            <i class="fa-solid fa-play text-[100px] text-white"></i>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

                        <div class="absolute bottom-5 left-5">
                            <div class="flex items-center gap-2">
                                <i class="fa-brands fa-youtube text-red-500 text-sm"></i>
                                <h4 class="text-xl font-black text-white uppercase tracking-tighter">UEAP TV</h4>
                            </div>
                        </div>
                    </a>

                    {{-- CARD INSTAGRAM --}}
                    <a href="https://www.instagram.com/ueapoficial/" target="_blank"
                        class="group relative h-48 overflow-hidden bg-ueap-blue-dark">
                        <div
                            class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-purple-600 via-pink-600 to-orange-500 opacity-30 group-hover:opacity-50 transition-opacity duration-500">
                        </div>

                        {{-- Ícone de Fundo --}}
                        <div
                            class="absolute inset-0 opacity-10 flex justify-end items-center -mr-8 transition-transform duration-700 group-hover:-translate-x-6">
                            <i class="fa-brands fa-instagram text-[120px] text-white"></i>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>

                        <div class="absolute bottom-5 left-5">
                            <div class="flex items-center gap-2">
                                <i class="fa-brands fa-instagram text-pink-500 text-sm"></i>
                                <h4 class="text-xl font-black text-white uppercase tracking-tighter">
                                    Instagram <span class="text-ueap-green">Oficial</span>
                                </h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
