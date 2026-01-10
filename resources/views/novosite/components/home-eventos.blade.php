<section
    class="pt-2 pb-2 md:pt-10 md:pb-20 bg-gradient-to-br from-[#013321] via-[#014d2f] to-[#013a24] relative overflow-hidden">
    {{-- Textura e Luzes --}}
    <div class="absolute inset-0 opacity-[0.05] pointer-events-none mix-blend-overlay"
        style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px]"></div>

    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between">
            <div class="max-w-xl">
                <div class="flex items-center mb-3">
                    <span class="flex h-2 w-2 relative mr-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                    </span>
                    <span class="text-[10px] font-bold uppercase tracking-[0.4em] text-emerald-300/80">Agenda
                        Institucional</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-white tracking-tighter uppercase leading-[0.9]">
                    Eventos <span class="text-emerald-400/40 font-light">&</span><br>
                    <span class="text-emerald-400">Programação</span>
                </h2>
            </div>
            <a href="{{ route('site.post.list', ['type' => 'event']) }}"
                class="group mt-8 md:mt-0 inline-flex items-center px-6 py-3 rounded-full bg-white/5 border border-white/10 text-[10px] font-bold uppercase tracking-widest text-white hover:bg-emerald-500 transition-all duration-300 shadow-xl">
                Ver calendário completo <i class="fa-solid fa-calendar-days ml-2 opacity-60"></i>
            </a>
        </div>
    </div>

    {{-- SHAPE DIVIDER --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
        {{-- Versão Mobile (Bandeja / Curva para dentro) --}}
        <svg class="relative block md:hidden w-[calc(100%+1.3px)] h-[40px]" viewBox="0 0 1200 120"
            preserveAspectRatio="none">
            <path d="M0,0 C450,120 750,120 1200,0 L1200,120 L0,120 Z" fill="#f9fafb"></path>
        </svg>

        {{-- Versão Desktop (Original) --}}
        <svg class="relative hidden md:block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120"
            preserveAspectRatio="none">
            <path
                d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C49.1,24.2,105.86,43.4,170.1,51.81,228.62,59.48,280.05,61.76,321.39,56.44Z"
                fill="#f9fafb"></path>
        </svg>
    </div>
</section>

<section class="bg-[#f9fafb] pt-6 pb-10 md:pt-10 md:pb-20 relative z-20" x-data="{
    activeSlide: 0,
    slidesCount: {{ count($events) }},
    timer: null,
    startAutoPlay() {
        this.timer = setInterval(() => {
            this.activeSlide = (this.activeSlide + 1) % this.slidesCount;
            this.scrollToActive();
        }, 5000);
    },
    stopAutoPlay() {
        clearInterval(this.timer);
    },
    scrollToActive() {
        const container = this.$refs.container;
        const cardWidth = container.clientWidth;
        container.scrollTo({
            left: cardWidth * this.activeSlide,
            behavior: 'smooth'
        });
    }
}" x-init="startAutoPlay()"
    @mouseenter="stopAutoPlay()" @mouseleave="startAutoPlay()">

    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Wrapper que trava a visualização em apenas 1 item no mobile --}}
        <div class="overflow-hidden sm:overflow-visible">
            <div x-ref="container"
                class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory hide-scrollbar sm:grid sm:grid-cols-2 lg:grid-cols-4 gap-0 border-l border-emerald-900/10">

                @foreach ($events as $index => $event)
                    {{-- W-FULL e FLEX-SHRINK-0 são cruciais para não vazar o próximo card --}}
                    <article
                        class="group relative bg-white flex flex-col h-[280px] w-full min-w-full flex-shrink-0 sm:min-w-0 sm:w-auto snap-center transition-all duration-500 border-r border-y border-emerald-900/10 hover:z-30 hover:shadow-[0_20px_50px_rgba(1,51,33,0.12)] overflow-hidden">

                        <a href="{{ route('site.post.show', $event->slug) }}" class="absolute inset-0 z-20"></a>

                        <div
                            class="h-1.5 w-full bg-[#013321] group-hover:bg-emerald-500 transition-colors duration-500 relative z-10">
                        </div>

                        <div class="p-6 flex flex-col h-full relative z-10">
                            <div class="flex justify-between items-center mb-4">
                                <span
                                    class="text-[10px] font-bold uppercase tracking-tight text-emerald-600">Evento</span>
                                <div class="text-emerald-900/20 rotate-12">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M16 9V4l1 0c.55 0 1-.45 1-1s-.45-1-1-1H7c-.55 0-1 .45-1 1s.45 1 1 1l1 0v5c0 1.66-1.34 3-3 3v2h5.97v7l1 1 1-1v-7H19v-2c-1.66 0-3-1.34-3-3z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-1">
                                <h3
                                    class="text-base font-bold text-slate-900 leading-[1.4] uppercase tracking-normal line-clamp-5">
                                    <span
                                        class="bg-[left_bottom_2px] bg-gradient-to-r from-emerald-500 to-emerald-500 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-[background-size] duration-500 pb-1">
                                        {{ $event->title }}
                                    </span>
                                </h3>
                            </div>

                            <div
                                class="mt-auto flex items-center justify-between text-[10px] font-bold uppercase tracking-wider text-emerald-900/40 group-hover:text-emerald-600 transition-colors">
                                <span>Ver Detalhes</span>
                                <svg class="w-4 h-4 transform md:-rotate-45 group-hover:rotate-0 transition-all duration-500 text-emerald-500"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="absolute inset-0 bg-emerald-50/30 translate-y-full group-hover:translate-y-0 transition-transform duration-500 z-0">
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- Dots --}}
        <div class="flex justify-center gap-2 mt-8 sm:hidden">
            <template x-for="(i, index) in slidesCount" :key="index">
                <button @click="activeSlide = index; scrollToActive(); stopAutoPlay();"
                    :class="activeSlide === index ? 'bg-emerald-600 w-6' : 'bg-emerald-200 w-2'"
                    class="h-2 rounded-full transition-all duration-300 shadow-sm">
                </button>
            </template>
        </div>
    </div>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</section>
