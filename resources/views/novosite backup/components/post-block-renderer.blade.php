@props(['block'])

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@switch($block['type'])
    @case('text')
        <div class="prose-custom" role="document">
            {!! clean_text($block['data']['body'] ?? '') !!}
        </div>
    @break

    @case('image')
    @case('gallery')
        @php
            $images = collect($block['data']['images'] ?? ($block['data']['path'] ?? []))->values();
            $count = $images->count();
            $subtitle = $block['data']['subtitle'] ?? null;
            // Gera um ID único seguro para acessibilidade
            $galleryId = 'gallery-' . bin2hex(random_bytes(4));
        @endphp

        @if ($count)
            <figure class="w-full flex flex-col" id="{{ $galleryId }}" x-data="{
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

                {{-- Container Principal --}}
                <div class="relative overflow-hidden aspect-video bg-black/20 max-h-[70vh] group"
                    @if ($count > 1) role="region" aria-roledescription="carrossel" aria-label="Galeria de imagens" @endif>

                    @if ($count === 1)
                        {{-- Imagem Única --}}
                        <div class="w-full h-full overflow-hidden">
                            <img src="{{ Storage::url($images->first()) }}" alt="{{ $subtitle ?? 'Imagem da notícia' }}"
                                class="w-full h-full object-cover object-center
                                       grayscale-[10%] hover:grayscale-0
                                       hover:scale-[1.05]
                                       transition-all duration-700 ease-out">
                        </div>
                    @else
                        {{-- Galeria --}}
                        <div class="relative h-full">
                            {{-- Slides --}}
                            <div class="flex h-full overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth"
                                x-ref="slider" aria-live="polite"
                                @scroll.debounce.50ms="active = Math.round($event.target.scrollLeft / $event.target.clientWidth)">
                                @foreach ($images as $index => $path)
                                    <div class="snap-center shrink-0 w-full h-full overflow-hidden" role="group"
                                        aria-roledescription="slide" aria-label="{{ $index + 1 }} de {{ $count }}">
                                        <img src="{{ Storage::url($path) }}"
                                            alt="{{ $subtitle ? $subtitle . ' - Imagem ' . ($index + 1) : 'Imagem ' . ($index + 1) . ' da galeria' }}"
                                            class="w-full h-full object-cover object-center
                                                   grayscale-[15%] hover:grayscale-0
                                                   hover:scale-[1.05]
                                                   transition-all duration-500">
                                    </div>
                                @endforeach
                            </div>

                            {{-- Setas de Navegação (Apenas Desktop) --}}
                            <div class="hidden md:flex absolute inset-0 items-center justify-between px-4 pointer-events-none">
                                <button type="button" @click="skip(active === 0 ? count - 1 : active - 1)"
                                    aria-label="Imagem anterior"
                                    class="pointer-events-auto bg-black/40 hover:bg-emerald-500 p-2 transition-colors text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button type="button" @click="skip(active === count - 1 ? 0 : active + 1)"
                                    aria-label="Próxima imagem"
                                    class="pointer-events-auto bg-black/40 hover:bg-emerald-500 p-2 transition-colors text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>

                            {{-- Indicadores --}}
                            <div class="absolute bottom-0 left-0 w-full flex gap-1.5 p-3 bg-gradient-to-t from-black/80 via-black/20 to-transparent"
                                role="tablist" aria-label="Selecionar imagem">
                                @foreach ($images as $index => $path)
                                    <button type="button" role="tab" aria-label="Ir para imagem {{ $index + 1 }}"
                                        :aria-selected="active === {{ $index }}"
                                        class="h-[2px] transition-all duration-300 cursor-pointer border-none focus:outline-none"
                                        :class="active === {{ $index }} ? 'w-6 bg-emerald-500' : 'w-2 bg-white/20'"
                                        @click="skip({{ $index }})">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Caption --}}
                @if (!empty($subtitle) || !empty($block['data']['credits']))
                    <figcaption class="mt-3 px-1">
                        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-2">
                            @if (!empty($subtitle))
                                <span
                                    class="text-[11px] sm:text-[12px] italic text-slate-400 font-medium tracking-tight leading-none">
                                    {{ $subtitle }}
                                </span>
                            @endif

                            @if (!empty($block['data']['credits']))
                                <span class="text-[9px] font-mono uppercase tracking-[0.15em] text-slate-500 whitespace-nowrap">
                                    <span class="text-emerald-500/40" aria-hidden="true">//</span>
                                    <span class="sr-only">Créditos:</span> {{ $block['data']['credits'] }}
                                </span>
                            @endif
                        </div>

                        {{-- Linha Divisória --}}
                        <div class="relative w-full h-[1px] flex items-center" aria-hidden="true">
                            <div class="h-full w-4 bg-emerald-500"></div>
                            <div class="h-full flex-1 bg-gradient-to-r from-white/10 via-white/5 to-transparent"></div>
                        </div>
                    </figcaption>
                @endif
            </figure>
        @endif
    @break

    @case('quote')
        <blockquote
            class="border-l-2 border-emerald-500/80 pl-6 py-1 italic text-slate-300 text-lg leading-relaxed bg-white/[0.02]">
            <span class="sr-only">Citação:</span>
            {{ $block['data']['text'] }}
        </blockquote>
    @break

@endswitch

<style>
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }

    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
