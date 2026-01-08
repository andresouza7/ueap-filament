<section class="pt-10 pb-20 bg-gradient-to-br from-[#013321] via-[#014d2f] to-[#013a24] relative overflow-hidden">
    {{-- Textura e Luzes --}}
    <div class="absolute inset-0 opacity-[0.05] pointer-events-none mix-blend-overlay"
        style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px]"></div>

    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-10"> {{-- Padding reduzido para compensar o pai --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between">
            <div class="max-w-xl">
                <div class="flex items-center mb-3">
                    <span class="flex h-2 w-2 relative mr-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-emerald-300/80">Agenda
                        Institucional</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter uppercase leading-[0.9]">
                    Eventos <span class="text-emerald-400/40 font-light">&</span><br>
                    <span class="text-emerald-400">Programação</span>
                </h2>
            </div>
            <a href="{{ route('site.post.list', ['type' => 'event']) }}"
                class="group mt-8 md:mt-0 inline-flex items-center px-6 py-3 rounded-full bg-white/5 border border-white/10 text-[10px] font-black uppercase tracking-widest text-white hover:bg-emerald-500 transition-all duration-300 shadow-xl">
                Ver calendário completo <i class="fa-solid fa-calendar-days ml-2 opacity-60"></i>
            </a>
        </div>
    </div>

    {{-- SHAPE DIVIDER --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
        <svg class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C49.1,24.2,105.86,43.4,170.1,51.81,228.62,59.48,280.05,61.76,321.39,56.44Z"
                fill="#f9fafb"></path>
        </svg>
    </div>
</section>

<section class="bg-gray-50 pt-10 pb-20 relative z-20"> {{-- Removido pt-20 e pb-32 --}}
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-0 border-l border-slate-200">
            @foreach ($events as $event)
                <article
                    class="group relative bg-white flex flex-col h-[300px] transition-all duration-500 
                border-r border-y border-slate-200
                hover:z-30 hover:shadow-[0_0_50px_rgba(0,0,0,0.12)] overflow-hidden">

                    {{-- Link invisível que cobre todo o card --}}
                    <a href="{{ route('site.post.show', $event->slug) }}" class="absolute inset-0 z-20"
                        aria-label="{{ $event->title }}"></a>

                    {{-- Acabamento de Topo (Accent) - Ativa com group-hover --}}
                    <div
                        class="h-1.5 w-full bg-slate-900 group-hover:bg-emerald-500 transition-colors duration-500 relative z-10">
                    </div>

                    <div class="p-8 flex flex-col h-full relative z-10">
                        {{-- Badge e Data/Índice --}}
                        <div class="flex justify-between items-baseline mb-6">
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-emerald-600">
                                {{-- {{ $event->category->name ?? 'Agenda' }} --}}
                                Evento
                            </span>
                            <span class="text-xs font-mono text-slate-300 group-hover:text-slate-900 transition-colors">
                                // 0{{ $loop->iteration }}
                            </span>
                        </div>

                        {{-- Título - Agora controlado pelo group-hover do card pai --}}
                        <div class="flex-1">
                            <h3
                                class="text-lg font-black text-slate-900 leading-[1.4] uppercase tracking-normal line-clamp-5">
                                <span
                                    class="bg-[left_bottom_2px] bg-gradient-to-r from-emerald-500 to-emerald-500 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-[background-size] duration-500 pb-1">
                                    {{ $event->title }}
                                </span>
                            </h3>
                        </div>

                        {{-- Footer Minimalista - Agora controlado pelo group-hover do card pai --}}
                        <div
                            class="mt-auto flex items-center justify-between text-[10px] font-black uppercase tracking-[0.2em] text-slate-300 group-hover:text-emerald-600 transition-colors">
                            <span>Ler Mais</span>
                            <svg class="w-4 h-4 transform -rotate-45 group-hover:rotate-0 transition-transform duration-500"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>

                    {{-- Overlay de Fundo no Hover --}}
                    <div
                        class="absolute inset-0 bg-slate-50/50 translate-y-full group-hover:translate-y-0 transition-transform duration-500 z-0">
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
