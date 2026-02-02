@props(['block'])

@php
    use Illuminate\Support\Facades\Storage;
    // Cores oficiais extraídas da imagem para contraste máximo
    $ueapBlue = '#1d4ed8'; // Azul Royal
    $ueapDarkBlue = '#002855'; // Azul Escuro (para leitura)
    $ueapLime = '#a3e635'; // Verde Lima
@endphp

@switch($block['type'])
    {{-- BLOCO DE TEXTO --}}
    @case('text')
        <div class="prose-custom text-[{{ $ueapDarkBlue }}] text-lg leading-relaxed font-medium mb-6 article-body" role="document">
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
            <figure class="w-full flex flex-col my-8" id="{{ $galleryId }}" x-data="{
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

                {{-- Moldura da Imagem --}}
                <div class="relative overflow-hidden aspect-video bg-white rounded-[2rem] border-[6px] border-[{{ $ueapLime }}] shadow-xl group"
                    @if ($count > 1) role="region" aria-roledescription="carrossel" @endif>

                    <div class="flex h-full overflow-x-auto snap-x snap-mandatory hide-scroll scroll-smooth"
                        x-ref="slider"
                        @scroll.debounce.50ms="active = Math.round($event.target.scrollLeft / $event.target.clientWidth)">
                        @foreach ($images as $index => $path)
                            <div class="snap-center shrink-0 w-full h-full overflow-hidden">
                                <img src="{{ Storage::url($path) }}" 
                                     alt="Imagem UEAP"
                                     class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                            </div>
                        @endforeach
                    </div>

                    {{-- Controles da Galeria --}}
                    @if ($count > 1)
                        <div class="absolute inset-0 flex items-center justify-between px-4 pointer-events-none">
                            <button @click="skip(active === 0 ? count - 1 : active - 1)" 
                                    class="pointer-events-auto bg-[{{ $ueapBlue }}] text-white p-2 rounded-full hover:bg-black transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                            <button @click="skip(active === count - 1 ? 0 : active + 1)" 
                                    class="pointer-events-auto bg-[{{ $ueapBlue }}] text-white p-2 rounded-full hover:bg-black transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>

                        {{-- Dots --}}
                        <div class="absolute bottom-4 left-0 w-full flex justify-center gap-2">
                            @foreach ($images as $index => $path)
                                <button @click="skip({{ $index }})" 
                                    class="h-2 rounded-full transition-all"
                                    :class="active === {{ $index }} ? 'w-8 bg-[{{ $ueapLime }}]' : 'w-2 bg-white/60'"></button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Legenda --}}
                @if ($subtitle || !empty($block['data']['credits']))
                    <figcaption class="mt-4 px-2 flex flex-col gap-1">
                        <div class="flex items-center gap-2">
                            <div class="h-4 w-1 bg-[{{ $ueapBlue }}]"></div>
                            <span class="text-[{{ $ueapDarkBlue }}] font-black uppercase text-sm tracking-widest">
                                {{ $subtitle ?? 'Galeria UEAP' }}
                            </span>
                        </div>
                        @if (!empty($block['data']['credits']))
                            <span class="text-xs font-bold text-gray-500 uppercase ml-3">
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
        <div class="my-10 relative">
            <div class="absolute -top-4 -left-2 text-[{{ $ueapLime }}] text-7xl font-serif opacity-50">“</div>
            <blockquote class="bg-white border-l-[12px] border-[{{ $ueapBlue }}] rounded-r-3xl p-8 shadow-md">
                <p class="text-[{{ $ueapDarkBlue }}] text-2xl font-black italic leading-tight">
                    {{ $block['data']['text'] }}
                </p>
            </blockquote>
        </div>
    @break
@endswitch

<style>
    .hide-scroll::-webkit-scrollbar { display: none; }
    .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    
    /* Garante que links e negritos no texto fiquem visíveis */
    .prose-custom b, .prose-custom strong { color: {{ $ueapBlue }}; font-weight: 800; }
    .prose-custom a { color: {{ $ueapBlue }}; text-decoration: underline; font-weight: bold; }
</style>