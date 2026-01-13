{{-- CONTAINER UNIFICADO --}}
<div class="bg-[#020618] relative overflow-hidden font-sans">

    {{-- GRADIENTE CIRCULAR NEON (Destaque de Fundo) --}}
    <div
        class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-emerald-500/15 rounded-full blur-[120px] pointer-events-none z-0">
    </div>
    <div
        class="absolute top-[20%] right-[-5%] w-[400px] h-[400px] bg-emerald-900/10 rounded-full blur-[100px] pointer-events-none z-0">
    </div>

    {{-- BACKGROUND GRID --}}
    <div class="absolute inset-0 z-0 opacity-[0.06] pointer-events-none"
        style="background-image: radial-gradient(#34d399 0.5px, transparent 0.5px); background-size: 30px 30px;"></div>

    {{-- SECTION 01: HEADER (Responsivo) --}}
    <section class="relative z-10 pt-12 md:pt-24 pb-12 md:pb-20">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 md:gap-10">

                <div class="max-w-3xl">
                    <div class="flex items-center gap-3 mb-4 md:mb-6">
                        <div class="h-[1px] w-8 md:w-12 bg-emerald-500 shadow-[0_0_10px_#10b981]"></div>
                        <span
                            class="text-[9px] md:text-[11px] font-mono font-bold uppercase tracking-[0.3em] md:tracking-[0.5em] text-emerald-400">
                            System_Identity // 2026_Events
                        </span>
                    </div>

                    <h2
                        class="text-4xl sm:text-6xl md:text-8xl font-black text-white leading-[0.85] tracking-tighter italic">
                        EVENTOS <span
                            class="text-emerald-500/20 not-italic inline-block translate-y-[0.1em] scale-[0.6] md:scale-[0.5] font-black">
                            &
                        </span><br>
                        <span class="text-transparent" style="-webkit-text-stroke: 2px #10b981;">Programação</span>
                    </h2>
                </div>

                <div class="mt-4 md:mt-0">
                    <a href="{{ route('site.post.list', ['type' => 'event']) }}"
                        class="group relative inline-flex items-center w-full md:w-auto justify-center px-8 md:px-10 py-4 bg-emerald-500 text-[#020618] text-[10px] md:text-[11px] font-mono font-black uppercase tracking-[0.2em] transition-all hover:bg-white active:scale-95">
                        Ver_Todos
                        <i class="fa-solid fa-arrow-right-long ml-3 transition-transform group-hover:translate-x-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 02: CARDS QUADRADOS --}}
    <section class="relative z-10 pb-24 md:pb-32">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                @foreach ($events as $index => $event)
                    {{-- aspect-square força o card a ser um quadrado perfeito --}}
                    <article
                        class="group relative aspect-square flex flex-col transition-all duration-500 bg-[#0a101f] border border-white/5 hover:border-emerald-500/50 shadow-2xl overflow-hidden">

                        <a href="{{ route('site.post.show', $event->slug) }}" class="absolute inset-0 z-30"></a>

                        {{-- Imagem de Fundo --}}
                        <div class="absolute inset-0 z-0">
                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                                class="w-full h-full object-cover opacity-40 grayscale group-hover:grayscale-0 group-hover:scale-110 group-hover:opacity-50 transition-all duration-700">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#020618] via-[#020618]/60 to-transparent z-10">
                            </div>
                        </div>

                        {{-- Conteúdo --}}
                        <div class="p-6 md:p-8 flex flex-col h-full relative z-20">
                            <div class="mb-2 md:mb-4 flex items-center justify-between">
                                <span
                                    class="text-[9px] font-mono font-black text-emerald-400 bg-emerald-500/10 px-2 py-1 border border-emerald-500/20">
                                    0{{ $index + 1 }}
                                </span>
                                <div class="h-[1px] flex-1 mx-4 bg-white/5"></div>
                            </div>

                            <div class="flex-1 flex items-center">
                                <h3
                                    class="text-lg md:text-xl font-black text-white leading-tight uppercase italic tracking-tighter group-hover:text-emerald-400 transition-colors line-clamp-4">
                                    {{ $event->title }}
                                </h3>
                            </div>

                            <div class="mt-auto pt-4 border-t border-white/5">
                                <div class="flex flex-col gap-2">
                                    <span
                                        class="text-[9px] font-mono font-bold text-emerald-500 tracking-[0.2em] opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        ACESSAR_CONTEÚDO_
                                    </span>
                                    <div class="h-[2px] w-12 bg-emerald-500 shadow-[0_0_10px_#10b981]"></div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute top-0 left-0 w-full h-[1px] bg-emerald-400/50 z-40 opacity-0 group-hover:opacity-100 group-hover:animate-scan">
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Footer Técnico --}}
            <div class="mt-16 flex justify-between items-center opacity-30 border-t border-emerald-500/10 pt-8">
                <div
                    class="text-[8px] md:text-[9px] font-mono text-emerald-500 uppercase tracking-[0.4em] md:tracking-[0.6em]">
                    Network_Secure</div>
                <div class="text-[8px] md:text-[9px] font-mono text-white uppercase tracking-[0.4em]">UEAP_SYS_2026
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    /* Contorno nítido e responsivo */
    .custom-outline {
        text-shadow:
            -1px -1px 0 #10b981,
            1px -1px 0 #10b981,
            -1px 1px 0 #10b981,
            1px 1px 0 #10b981;
    }

    @keyframes scan {
        0% {
            top: 0;
        }

        100% {
            top: 100%;
        }
    }

    .animate-scan {
        animation: scan 3s linear infinite;
    }

    /* Ajuste para telas pequenas não cortarem o título */
    @media (max-width: 640px) {
        .custom-outline {
            text-shadow: -0.5px -0.5px 0 #10b981, 0.5px -0.5px 0 #10b981, -0.5px 0.5px 0 #10b981, 0.5px 0.5px 0 #10b981;
        }
    }
</style>
