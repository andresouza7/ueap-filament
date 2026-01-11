@props(['block'])

@switch($block['type'])
    {{-- Bloco de Texto --}}
    @case('text')
        <div class="mb-8 last:mb-0">
            {!! clean_text($block['data']['body'] ?? '') !!}
        </div>
        @break

    {{-- Bloco de Imagem ou Galeria --}}
    @case('image')
    @case('gallery')
        @php
            // Se o seu modelo Post usa Spatie Media Library ou similar
            $mediaItems = $post->getMedia(); 
            $count = $mediaItems->count();
        @endphp

        <figure class="my-12 group">
            @if ($count === 1)
                {{-- Imagem Única com Moldura Industrial --}}
                <div class="relative overflow-hidden border border-slate-100 p-1 bg-white shadow-sm">
                    <img src="{{ $mediaItems->first()->getUrl() }}" 
                         alt="{{ $post->title }}"
                         class="w-full h-auto grayscale-[20%] group-hover:grayscale-0 transition-all duration-700">
                </div>
            @elseif ($count > 1)
                {{-- Galeria / Carousel Condensado --}}
                <div class="relative">
                    <div class="flex gap-2 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-2">
                        @foreach ($mediaItems as $media)
                            <div class="snap-center shrink-0 w-[90%] sm:w-[75%] lg:w-[80%] border border-slate-100 p-1">
                                <img src="{{ $media->getUrl() }}" 
                                     class="w-full h-full object-cover aspect-video">
                            </div>
                        @endforeach
                    </div>
                    
                    {{-- Indicadores de Traço (mesma identidade do Acesso Rápido) --}}
                    <div class="flex gap-1 mt-4">
                        @foreach ($mediaItems as $media)
                            <span class="h-[2px] w-4 bg-slate-200 {{ $loop->first ? 'bg-emerald-500 w-8' : '' }} transition-all"></span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Legenda Refinada --}}
            @if (!empty($block['data']['subtitle']) || !empty($block['data']['credits']))
                <figcaption class="flex items-start gap-3 mt-4 px-2">
                    <span class="w-1 h-4 bg-emerald-500 mt-0.5"></span>
                    <div class="text-[11px] font-bold uppercase tracking-tight text-slate-400 italic leading-tight">
                        @if(!empty($block['data']['subtitle']))
                            {{ $block['data']['subtitle'] }}
                        @endif
                        
                        @if(!empty($block['data']['credits']))
                            <span class="text-slate-900 not-italic ml-1 border-l border-slate-200 pl-2">
                                Créditos: {{ $block['data']['credits'] }}
                            </span>
                        @endif
                    </div>
                </figcaption>
            @endif
        </figure>
        @break

    {{-- Outros blocos (Citações, Vídeos, etc) podem ser adicionados aqui --}}
    @case('quote')
        <blockquote class="border-l-4 border-emerald-500 pl-6 py-2 my-10 bg-slate-50 italic font-medium text-slate-700 text-lg">
            {{ $block['data']['text'] }}
        </blockquote>
        @break

@endswitch