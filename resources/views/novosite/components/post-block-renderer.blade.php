@props(['block'])

@php
    use Illuminate\Support\Facades\Storage;
    // Cores oficiais
    $ueapBlue = '#00388d';
    $ueapDarkBlue = '#002855';
    // O verde correto deve seguir a classe ueap-green. Em CSS é #84CC16.
@endphp

@switch($block['type'])
    {{-- BLOCO DE TEXTO --}}
    @case('text')
        <div class="prose-custom text-slate-700 text-lg leading-relaxed font-normal mb-8 article-body" role="document">
            {!! clean_text($block['data']['body'] ?? '') !!}
        </div>
    @break

    {{-- BLOCO DE IMAGEM / GALERIA --}}
    @case('image')
    @case('gallery')
        @php
            $images = collect($block['data']['images'] ?? ($block['data']['path'] ?? []))->values();
            $count = $images->count();
            $subtitle = $block['data']['subtitle'] ?? null;
            $galleryId = 'gallery-' . bin2hex(random_bytes(4));
        @endphp

        @if ($count)
            <figure class="w-full flex flex-col my-10" id="{{ $galleryId }}" x-data="{
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

                {{-- Container da Imagem (RETO, SEM ROUNDED) --}}
                <div class="relative overflow-hidden aspect-video bg-gray-100 group border border-slate-200"
                    @if ($count > 1) role="region" aria-roledescription="carrossel" @endif>

                    <div class="flex h-full overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth" x-ref="slider"
                        @scroll.debounce.50ms="active = Math.round($event.target.scrollLeft / $event.target.clientWidth)">
                        @foreach ($images as $index => $path)
                            <div class="snap-center shrink-0 w-full h-full overflow-hidden">
                                <img src="{{ Storage::url($path) }}" alt="Imagem UEAP"
                                    class="w-full h-full object-contain bg-black/5">
                            </div>
                        @endforeach
                    </div>

                    {{-- Controles da Galeria --}}
                    @if ($count > 1)
                        <div
                            class="absolute inset-0 flex items-center justify-between pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="skip(active === 0 ? count - 1 : active - 1)"
                                class="pointer-events-auto bg-[#00388d] text-white p-4 hover:bg-[#002855] transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button @click="skip(active === count - 1 ? 0 : active + 1)"
                                class="pointer-events-auto bg-[#00388d] text-white p-4 hover:bg-[#002855] transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        {{-- Dots --}}
                        <div
                            class="absolute bottom-0 left-0 w-full flex justify-center gap-0 pointer-events-none bg-black/10 backdrop-blur-sm">
                            @foreach ($images as $index => $path)
                                <button @click="skip({{ $index }})" class="h-1 flex-1 transition-all pointer-events-auto"
                                    :class="active === {{ $index }} ? 'bg-ueap-green' :
                                        'bg-transparent hover:bg-white/20'"></button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Legenda --}}
                @if ($subtitle || !empty($block['data']['credits']))
                    <figcaption class="mt-2 flex justify-between items-start gap-4 text-xs">
                        <span class="text-[#00388d] font-bold uppercase tracking-wider">
                            {{ $subtitle }}
                        </span>
                        @if (!empty($block['data']['credits']))
                            <span class="text-slate-400 font-mono text-[10px] uppercase whitespace-nowrap">
                                Foto: {{ $block['data']['credits'] }}
                            </span>
                        @endif
                    </figcaption>
                @endif
            </figure>
        @endif
    @break

    {{-- BLOCO DE CITAÇÃO --}}
    @case('quote')
        <div class="my-12 pl-6 border-l-[6px] border-ueap-green">
            <blockquote class="text-2xl font-black text-[#00388d] uppercase italic leading-tight mb-3">
                "{{ $block['data']['text'] }}"
            </blockquote>
            @if (!empty($block['data']['caption']))
                <cite class="block text-sm font-bold text-slate-500 not-italic uppercase tracking-widest">
                    — {{ $block['data']['caption'] }}
                </cite>
            @endif
        </div>
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

    .prose-custom b,
    .prose-custom strong {
        color: #00388d;
        font-weight: 900;
    }

    .prose-custom a {
        color: #00388d;
        text-decoration: underline;
        font-weight: 700;
        text-decoration-color: #84CC16;
    }

    .prose-custom a:hover {
        color: #84CC16;
        text-decoration-color: #00388d;
    }
</style>
