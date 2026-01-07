<section class="py-20 bg-gradient-to-br from-[#013a24] via-[#015c38] to-[#013d29] relative overflow-hidden">
    {{-- Textura sutil --}}
    <div class="absolute inset-0 opacity-15 pointer-events-none mix-blend-overlay"
        style="background-image: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png');">
    </div>

    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 border-b border-white/10 pb-8">
            <div class="max-w-xl">
                <div class="flex items-center mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2"></span>
                    <span class="text-[10px] font-extrabold uppercase tracking-[0.3em] text-emerald-300">
                        Agenda Institucional
                    </span>
                </div>
                <h2 class="text-3xl font-black text-white tracking-tight uppercase leading-none">
                    Eventos <span class="text-emerald-300/70">&</span> Programação
                </h2>
            </div>

            <a href="#"
                class="group mt-6 md:mt-0 inline-flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-emerald-200 hover:text-white transition">
                Ver calendário completo
                <svg class="ml-2 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        {{-- Grid --}}
        {{-- Grid de Banners de Eventos - Layout Consolidado --}}
        {{-- Grid de Banners de Eventos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($events as $event)
                <article
                    class="group relative h-[450px] w-full overflow-hidden rounded-2xl bg-[#012a1a] border border-white/10 shadow-2xl transition-all duration-500 hover:border-emerald-400/40 flex flex-col">

                    {{-- Camada de Design de Fundo --}}
                    <div
                        class="absolute inset-0 opacity-20 group-hover:opacity-40 transition-opacity duration-700 pointer-events-none">
                        <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-500 rounded-full blur-[100px]">
                        </div>
                        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-900 rounded-full blur-[80px]">
                        </div>
                    </div>

                    {{-- Conteúdo do Banner --}}
                    <div class="relative h-full p-8 flex flex-col justify-between z-10">

                        {{-- Topo: Categoria --}}
                        <div class="flex justify-between items-start">
                            <span
                                class="text-[10px] font-black uppercase tracking-[0.3em] px-3 py-1 bg-white text-emerald-950 rounded-sm shrink-0">
                                {{ $event->category->description ?? 'Evento' }}
                            </span>
                            <div class="w-2 h-2 rounded-full bg-emerald-500 group-hover:animate-ping shrink-0"></div>
                        </div>

                        {{-- Meio: Título e Descrição (Container com overflow controlado) --}}
                        <div class="flex-1 flex flex-col justify-center min-h-0 py-4">
                            <h3
                                class="text-2xl font-bold text-white leading-[1.1] uppercase tracking-tight group-hover:text-emerald-300 transition-colors duration-300 line-clamp-6">
                                {{ $event->title }}
                            </h3>

                            {{-- Divisor --}}
                            <div
                                class="w-12 h-1 bg-emerald-500 my-4 shrink-0 transition-all duration-500 group-hover:w-full">
                            </div>

                            {{-- Descrição --}}
                            <p class="text-sm text-emerald-50/70 leading-relaxed line-clamp-3 font-medium italic">
                                {{ Str::limit(clean_text(html_entity_decode(strip_tags($event->text))), 110) }}
                            </p>
                        </div>

                        {{-- Base: Botão Estilo Chamada --}}
                        <div class="pt-2">
                            <a href="{{ route('novosite.post.show', $event->slug) }}"
                                class="flex items-center justify-between w-full py-4 px-6 bg-white/[0.05] border border-white/10 text-white text-[11px] font-black uppercase tracking-widest group-hover:bg-white group-hover:text-emerald-950 transition-all duration-500 rounded-xl whitespace-nowrap">
                                <span>Acessar Evento</span>
                                <svg class="w-4 h-4 shrink-0 ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Overlay de Interação --}}
                    <div
                        class="absolute inset-0 border-[6px] border-emerald-500/0 group-hover:border-emerald-500/10 transition-all duration-500 pointer-events-none rounded-2xl">
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
