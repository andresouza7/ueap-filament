{{-- CONTAINER PRINCIPAL EM FUNDO CLARO --}}
<div class="bg-white relative overflow-hidden font-sans border-t border-gray-100" role="region"
    aria-label="Eventos e Programação">

    {{-- HEADER DA SEÇÃO --}}
    <section class="relative z-10 pt-16 md:pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b-4 border-ueap-blue pb-8">

                <div class="max-w-4xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="h-[2px] w-12 bg-ueap-green" aria-hidden="true"></div>
                        <span class="text-[11px] font-bold uppercase tracking-[0.5em] text-ueap-blue">
                            Calendário Acadêmico // 2026
                        </span>
                    </div>

                    {{-- TIPOGRAFIA DE IMPACTO MANTIDA --}}
                    <h2
                        class="text-5xl sm:text-7xl md:text-9xl font-display font-black text-ueap-blue-dark leading-[0.85] tracking-tighter uppercase italic">
                        Eventos <span class="text-ueap-green/40 not-italic">&</span><br>
                        Programação
                    </h2>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('site.post.list', ['type' => 'event']) }}" aria-label="Ver todos os eventos"
                        class="group inline-flex items-center gap-3 px-10 py-5 bg-ueap-blue text-white text-xs font-black uppercase tracking-widest transition-all hover:bg-ueap-blue-dark shadow-xl">
                        Ver todos
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 transition-transform group-hover:translate-x-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- GRID DE CARDS (SEM DATA) --}}
    <section class="relative z-10 pb-24 md:pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($events as $index => $event)
                    <article
                        class="group relative aspect-square flex flex-col transition-all duration-500 bg-ueap-blue-dark overflow-hidden border border-gray-100 shadow-lg">

                        {{-- ROTA CORRIGIDA PARA 'site' --}}
                        <a href="{{ route('site.post.show', $event->slug) }}" class="absolute inset-0 z-30"
                            aria-label="{{ $event->title }}"></a>

                        {{-- Imagem de Fundo --}}
                        <div class="absolute inset-0 z-0" aria-hidden="true">
                            <img src="{{ $event->image_url }}" alt=""
                                class="w-full h-full object-cover opacity-60 group-hover:scale-110 group-hover:opacity-40 transition-all duration-700">
                            {{-- Gradiente Institucional --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-ueap-blue-dark via-ueap-blue-dark/40 to-transparent z-10">
                            </div>
                        </div>

                        {{-- Conteúdo do Card --}}
                        <div class="p-6 md:p-8 flex flex-col h-full relative z-20">
                            <div class="mb-4 flex items-center justify-between" aria-hidden="true">
                                <span
                                    class="text-[10px] font-black text-ueap-green px-2 py-1 border border-ueap-green/30">
                                    ITEM_0{{ $index + 1 }}
                                </span>
                            </div>

                            <div class="flex-1 flex items-end">
                                {{-- TIPOGRAFIA DE IMPACTO NOS CARDS --}}
                                <h3
                                    class="text-xl md:text-2xl font-display font-black text-white leading-[0.9] uppercase italic tracking-tighter group-hover:text-ueap-green transition-colors line-clamp-4">
                                    {{ $event->title }}
                                </h3>
                            </div>

                            <div class="mt-6 pt-4 border-t border-white/10">
                                <div class="h-[2px] w-12 bg-ueap-green" aria-hidden="true"></div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Rodapé da Seção --}}
            <div class="mt-16 flex justify-between items-center border-t border-gray-100 pt-8">
                <div class="text-[10px] font-bold text-ueap-blue-dark/30 uppercase tracking-[0.4em]">
                    Universidade do Estado do Amapá
                </div>
                <div class="text-[10px] font-bold text-ueap-blue-dark uppercase tracking-widest font-display italic">
                    UEAP_2026
                </div>
            </div>
        </div>
    </section>
</div>
