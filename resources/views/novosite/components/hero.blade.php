<div class="w-full bg-[#017D49] bg-cover bg-center pt-12 pb-12 relative overflow-hidden"
    style="background-image: url('/img/site/hero-bg.svg');">

    <section class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Ajustado para grid 8 e 4 --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- POST PRINCIPAL (ESQUERDA - MAIOR) --}}
            @if (isset($posts[0]))
                <div class="lg:col-span-8">
                    {{-- Card principal agora é um link --}}
                    <a href="{{ route('novosite.post.show', $posts[0]->slug) }}"
                        class="bg-black/30 backdrop-blur-sm border border-white/10 rounded-3xl overflow-hidden group h-[520px] flex flex-col relative shadow-2xl transition-all block">
                        <div class="absolute inset-0">
                            {{-- Filtro de harmonia verde na imagem --}}
                            <img src="{{ $posts[0]->image_url }}"
                                class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-90">
                            {{-- Blend de cor verde para harmonizar com o BG --}}
                            <div class="absolute inset-0 bg-[#017D49]/20 mix-blend-multiply"></div>
                            {{-- Gradiente mais profundo --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/30 to-transparent">
                            </div>
                        </div>

                        <div class="relative flex flex-col justify-end h-full p-10">
                            <div class="mb-4">
                                <span
                                    class="bg-emerald-500/90 text-white text-[10px] font-black px-4 py-2 uppercase tracking-[0.2em] rounded-lg shadow-xl backdrop-blur-md">
                                    {{ $posts[0]->category->name ?? 'Destaque' }}
                                </span>
                            </div>

                            {{-- Data com texto em cinza e ícone acompanhando a sobriedade --}}
                            <span
                                class="text-gray-400 text-[11px] font-bold uppercase tracking-widest flex items-center mb-3">
                                <i class="fa-regular fa-calendar mr-2 text-gray-500"></i>
                                {{ $posts[0]->created_at->translatedFormat('d M Y') }}
                            </span>

                            <h2
                                class="text-white text-3xl lg:text-4xl font-bold leading-[1.05] group-hover:text-emerald-300 transition-colors drop-shadow-2xl">
                                {{ $posts[0]->title }}
                            </h2>
                        </div>
                    </a>
                </div>
            @endif

            {{-- COLUNA DA DIREITA (2 POSTS - MENORES) --}}
            <div class="lg:col-span-4 flex flex-col gap-6">
                @foreach ($posts->slice(1, 2) as $index => $item)
                    <a href="{{ route('novosite.post.show', $item->slug) }}"
                        class="flex-1 h-[248px] bg-black/30 backdrop-blur-sm border border-white/5 rounded-3xl overflow-hidden group flex flex-col relative shadow-xl">
                        <div class="absolute inset-0">
                            <img src="{{ $item->image_url }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-80">
                            <div class="absolute inset-0 bg-[#017D49]/10 mix-blend-color"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent">
                            </div>
                        </div>

                        <div class="relative flex flex-col justify-end h-full p-6">
                            <span class="text-emerald-400 text-[10px] font-black uppercase tracking-widest mb-2 block">
                                {{ $item->category->name }}
                            </span>
                            <h3
                                class="text-white text-lg lg:text-xl font-bold leading-tight group-hover:text-emerald-300 transition-colors line-clamp-2">
                                {{ $item->title }}
                            </h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- EFEITO FADE --}}
    <div
        class="absolute bottom-0 left-0 w-full h-30 bg-gradient-to-t from-[#121212] to-transparent pointer-events-none">
    </div>
</div>

{{-- BARRA DE ACESSO RÁPIDO - ITENS SOLTOS E RESPONSIVOS --}}
<section class="w-full bg-[#121212] py-8 border-t border-white/5 relative z-20">
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 lg:gap-4">

            @php
                $links = [
                    ['icon' => 'fa-calendar-days', 'label' => 'Calendário Acadêmico', 'color' => 'text-emerald-400'],
                    ['icon' => 'fa-scale-balanced', 'label' => 'Legislação Ueap', 'color' => 'text-teal-400'],
                    ['icon' => 'fa-file-lines', 'label' => 'Instruções Normativas', 'color' => 'text-emerald-400'],
                    ['icon' => 'fa-gavel', 'label' => 'Resoluções CONSU', 'color' => 'text-teal-400'],
                    ['icon' => 'fa-handshake', 'label' => 'Licitações', 'color' => 'text-emerald-400'],
                    ['icon' => 'fa-user-tie', 'label' => 'Processos Seletivos', 'color' => 'text-teal-400'],
                ];
            @endphp

            @foreach ($links as $link)
                <a href="#" class="flex flex-col items-center group transition-all duration-300">
                    {{-- Ícone (Tamanho 20x20 mantido) --}}
                    <div
                        class="w-20 h-20 bg-white/5 border border-white/10 {{ $link['color'] }} rounded-2xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white group-hover:-translate-y-2 group-hover:shadow-[0_20px_40px_-10px_rgba(5,150,105,0.4)] transition-all duration-500">
                        <i class="fa-solid {{ $link['icon'] }} text-3xl"></i>
                    </div>

                    {{-- Label (Tamanho 11px mantido) --}}
                    <span
                        class="text-[11px] font-black text-gray-400 uppercase tracking-widest text-center leading-tight group-hover:text-white transition-colors duration-300">
                        {!! str_replace(' ', '<br class="hidden lg:block">', $link['label']) !!}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
