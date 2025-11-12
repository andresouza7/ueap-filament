<section class="p-4 md:p-8">
    <div class="max-w-[1290px] mx-auto">
        <!-- GRID: 1 grande à esquerda + 2 menores à direita -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <!-- CARD GRANDE (ESQUERDA) -->
            <a href="#"
               class="lg:col-span-2 relative rounded-lg overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all duration-300 
                      h-[31rem] lg:h-[31.5rem]">
                <img src="https://picsum.photos/id/1051/1200/600"
                     alt="Notícia principal"
                     class="absolute inset-0 w-full h-full object-cover brightness-90 group-hover:brightness-110 group-hover:contrast-110 transform group-hover:scale-105 transition-all duration-500">
                
                <!-- overlay padrão -->
                <div class="absolute inset-0 bg-black/40 transition-all duration-500"></div>
                
                <!-- overlay de clareamento no hover -->
                <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <!-- faixa de overlay sobre o título (verde musgo) -->
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-green-900/70 via-green-800/50 to-transparent"></div>

                <div class="relative z-10 p-6 flex flex-col justify-end h-full text-white">
                    <h2
                        class="text-2xl font-semibold leading-tight mb-2 drop-shadow-lg transition-all duration-200 
                               group-hover:underline decoration-accent-yellow decoration-2 underline-offset-[3px]">
                        Pesquisa da UEAP Alcança Reconhecimento Internacional na Área de Biotecnologia
                    </h2>
                    <p class="text-sm text-gray-200 mb-2">12 de Novembro, 2025</p>
                </div>
            </a>

            <!-- COLUNA DIREITA -->
            <div class="flex flex-col gap-4">

                <!-- CARD MENOR 1 -->
                <a href="#"
                   class="relative rounded-lg overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all duration-300 h-[15rem] lg:h-[15.25rem]">
                    <img src="https://picsum.photos/id/1049/600/400"
                         alt="Notícia secundária"
                         class="absolute inset-0 w-full h-full object-cover brightness-90 group-hover:brightness-110 group-hover:contrast-110 transform group-hover:scale-110 transition-all duration-500">
                    
                    <div class="absolute inset-0 bg-black/40 transition-all duration-500"></div>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-green-900/70 via-green-800/50 to-transparent"></div>

                    <div class="relative z-10 p-4 text-white flex flex-col justify-end h-full">
                        <h3
                            class="text-lg font-semibold leading-tight drop-shadow-lg transition-all duration-200 
                                   group-hover:underline decoration-accent-yellow decoration-2 underline-offset-[3px]">
                            Docentes da UEAP Promovem Projeto de Inclusão em Escolas Públicas
                        </h3>
                        <p class="text-xs text-gray-200 mt-1">10 de Novembro, 2025</p>
                    </div>
                </a>

                <!-- CARD MENOR 2 -->
                <a href="#"
                   class="relative rounded-lg overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all duration-300 h-[15rem] lg:h-[15.25rem]">
                    <img src="https://picsum.photos/id/1055/600/400"
                         alt="Notícia secundária"
                         class="absolute inset-0 w-full h-full object-cover brightness-90 group-hover:brightness-110 group-hover:contrast-110 transform group-hover:scale-110 transition-all duration-500">
                    
                    <div class="absolute inset-0 bg-black/40 transition-all duration-500"></div>
                    <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-green-900/70 via-green-800/50 to-transparent"></div>

                    <div class="relative z-10 p-4 text-white flex flex-col justify-end h-full">
                        <h3
                            class="text-lg font-semibold leading-tight drop-shadow-lg transition-all duration-200 
                                   group-hover:underline decoration-accent-yellow decoration-2 underline-offset-[3px]">
                            Estudantes Criam Aplicativo que Facilita o Acesso a Dados Científicos
                        </h3>
                        <p class="text-xs text-gray-200 mt-1">9 de Novembro, 2025</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
