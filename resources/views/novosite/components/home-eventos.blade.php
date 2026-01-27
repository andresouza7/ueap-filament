{{-- SEÇÃO: EVENTOS & PROGRAMAÇÃO - VERSÃO FINAL SÓLIDA --}}
<div class="bg-white relative overflow-hidden border-t border-gray-100" role="region" aria-label="Eventos e Programação">

    {{-- HEADER DA SEÇÃO --}}
    <section class="relative z-10 pt-16 md:pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-col md:flex-row md:items-end justify-between gap-8 border-b-4 border-ueap-blue-dark pb-10">

                <div class="max-w-4xl">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-1.5 w-10 bg-ueap-green" aria-hidden="true"></div>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-ueap-blue-dark/50">
                            Agenda Institucional
                        </span>
                    </div>

                    <h2
                        class="text-5xl md:text-7xl font-black text-ueap-blue-dark leading-none tracking-tighter uppercase">
                        Eventos <span class="text-ueap-green">&</span> Programação
                    </h2>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('site.post.list', ['type' => 'event']) }}"
                        class="group inline-flex items-center gap-3 px-8 py-4 bg-ueap-blue-dark text-white text-xs font-black uppercase tracking-widest transition-all hover:bg-ueap-green hover:text-ueap-blue-dark shadow-xl">
                        Ver todos
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform group-hover:translate-x-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- GRID DE CARDS (BORDAS RETAS) --}}
    <section class="pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($events->take(4) as $event)
                    <article
                        class="group relative aspect-[3/4] bg-ueap-blue-dark border border-gray-200 overflow-hidden">

                        <a href="{{ route('site.post.show', $event->slug) }}" class="absolute inset-0 z-30"></a>

                        {{-- Imagem --}}
                        <div class="absolute inset-0 z-0">
                            <img src="{{ $event->image_url }}" alt=""
                                class="w-full h-full object-cover opacity-50 group-hover:scale-105 group-hover:opacity-30 transition-all duration-700">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-ueap-blue-dark via-ueap-blue-dark/40 to-transparent z-10">
                            </div>
                        </div>

                        {{-- Conteúdo --}}
                        <div class="p-8 flex flex-col h-full relative z-20">
                            <div class="mb-4">
                                <span
                                    class="inline-block text-[9px] font-black text-ueap-blue-dark px-2 py-1 bg-ueap-green uppercase tracking-widest">
                                    {{ $event->category->name ?? 'Geral' }}
                                </span>
                            </div>

                            <div class="mt-auto">
                                {{-- Título menor com mais linhas --}}
                                <h3
                                    class="text-lg font-bold text-white leading-tight tracking-tight group-hover:text-ueap-green transition-colors line-clamp-5 mb-4">
                                    {{ Str::ucfirst(Str::lower($event->title)) }}
                                </h3>

                                {{-- Indicador visual simples --}}
                                <div class="h-1 w-12 bg-ueap-green group-hover:w-full transition-all duration-500">
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</div>
