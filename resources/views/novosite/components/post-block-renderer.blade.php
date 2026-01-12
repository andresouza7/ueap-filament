@props(['block'])

@php
use Illuminate\Support\Facades\Storage;
@endphp

@switch($block['type'])
    @case('text')
        <div class="prose-custom">
            {!! clean_text($block['data']['body'] ?? '') !!}
        </div>
    @break

    @case('image')
    @case('gallery')
        @php
            $images = collect($block['data']['images'] ?? ($block['data']['path'] ?? []))->values();
            $count = $images->count();
        @endphp

        @if ($count)
            <figure class="w-full flex flex-col" 
                    x-data="{ 
                        active: 0,
                        count: {{ $count }},
                        skip(index) {
                            this.active = index;
                            this.$refs.slider.scrollTo({
                                left: this.$refs.slider.clientWidth * index,
                                behavior: 'smooth'
                            });
                        }
                    }">

                {{-- Container Principal - Bordas Retas --}}
                <div class="relative overflow-hidden aspect-video bg-black/20 max-h-[70vh] group">

                    @if ($count === 1)
                        {{-- Imagem Única com Zoom Isolado --}}
                        <div class="w-full h-full overflow-hidden">
                            <img
                                src="{{ Storage::url($images->first()) }}"
                                alt="{{ $block['data']['subtitle'] ?? '' }}"
                                class="w-full h-full object-cover object-center
                                       grayscale-[10%] hover:grayscale-0
                                       hover:scale-[1.05]
                                       transition-all duration-700 ease-out"
                            >
                        </div>
                    @else
                        {{-- Galeria --}}
                        <div class="relative h-full">
                            {{-- Slides --}}
                            <div class="flex h-full overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth"
                                 x-ref="slider"
                                 @scroll.debounce.50ms="active = Math.round($event.target.scrollLeft / $event.target.clientWidth)">
                                @foreach ($images as $path)
                                    <div class="snap-center shrink-0 w-full h-full overflow-hidden">
                                        <img
                                            src="{{ Storage::url($path) }}"
                                            class="w-full h-full object-cover object-center
                                                   grayscale-[15%] hover:grayscale-0
                                                   hover:scale-[1.05]
                                                   transition-all duration-500"
                                        >
                                    </div>
                                @endforeach
                            </div>

                            {{-- Setas de Navegação (Apenas Desktop) --}}
                            <div class="hidden md:flex absolute inset-0 items-center justify-between px-4 pointer-events-none">
                                <button @click="skip(active === 0 ? count - 1 : active - 1)" 
                                        class="pointer-events-auto bg-black/40 hover:bg-emerald-500 p-2 transition-colors text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <button @click="skip(active === count - 1 ? 0 : active + 1)" 
                                        class="pointer-events-auto bg-black/40 hover:bg-emerald-500 p-2 transition-colors text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>

                            {{-- Indicadores --}}
                            <div class="absolute bottom-0 left-0 w-full flex gap-1.5 p-3
                                        bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                @foreach ($images as $index => $path)
                                    <span
                                        class="h-[2px] transition-all duration-300 cursor-pointer"
                                        :class="active === {{ $index }} ? 'w-6 bg-emerald-500' : 'w-2 bg-white/20'"
                                        @click="skip({{ $index }})">
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

               {{-- Caption Refatorada: Estilo Minimalista Industrial --}}
@if (!empty($block['data']['subtitle']) || !empty($block['data']['credits']))
    <figcaption class="mt-3 px-1">
        {{-- Linha de conteúdo: Subtítulo (Esq) | Créditos (Dir) --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-2">
            
            {{-- Subtítulo em Itálico --}}
            @if (!empty($block['data']['subtitle']))
                <span class="text-[11px] sm:text-[12px] italic text-slate-400 font-medium tracking-tight leading-none">
                    {{ $block['data']['subtitle'] }}
                </span>
            @endif

            {{-- Créditos na Direita --}}
            @if (!empty($block['data']['credits']))
                <span class="text-[9px] font-mono uppercase tracking-[0.15em] text-slate-500 whitespace-nowrap">
                    <span class="text-emerald-500/40">//</span> {{ $block['data']['credits'] }}
                </span>
            @endif
        </div>

        {{-- Linha Divisória com Fade (Esquerda para Direita) --}}
        <div class="relative w-full h-[1px] flex items-center">
            <div class="h-full w-4 bg-emerald-500"></div> {{-- Início sólido --}}
            <div class="h-full flex-1 bg-gradient-to-r from-white/10 via-white/5 to-transparent"></div>
        </div>
    </figcaption>
@endif

            </figure>
        @endif
    @break

    @case('quote')
        <blockquote class="border-l-2 border-emerald-500/80 pl-6 py-1 italic text-slate-300 text-lg leading-relaxed bg-white/[0.02]">
            {{ $block['data']['text'] }}
        </blockquote>
    @break
@endswitch

<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
</style>