{{-- SEÇÃO DESTAQUES + ACESSO RÁPIDO (LAYOUT UEAP FINAL) --}}
<section class="w-full bg-white py-10 lg:py-16" aria-label="Destaques e Acesso Rápido">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- 01. GRID DE DESTAQUES (ALTURA 500PX - TEXTO DENTRO) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 h-auto lg:h-[500px] mb-16">

            {{-- POST PRINCIPAL (8 COLUNAS) --}}
            @if (isset($featured[0]))
                <article class="lg:col-span-8 h-[400px] lg:h-full relative group overflow-hidden bg-ueap-blue-dark">
                    <a href="{{ route('site.post.show', $featured[0]->slug) }}" class="block h-full w-full">
                        <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-80 group-hover:opacity-100">

                        {{-- Overlay de Proteção do Texto --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00255E] via-[#00255E]/40 to-transparent">
                        </div>

                        <div class="absolute bottom-0 p-8 lg:p-12 w-full">
                            <span
                                class="bg-ueap-green text-ueap-blue-dark font-black text-[10px] uppercase tracking-[0.2em] px-3 py-1 mb-5 inline-block">
                                {{ $featured[0]->category->name ?? 'Destaque' }}
                            </span>
                            <h2
                                class="text-white text-3xl lg:text-5xl font-black leading-[0.9] tracking-tighter mb-5 transition-colors group-hover:text-ueap-green">
                                {{ $featured[0]->title }}
                            </h2>
                            <p class="text-blue-100 text-sm font-bold max-w-2xl line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($featured[0]->text), 160) }}
                            </p>
                        </div>
                    </a>
                </article>
            @endif

            {{-- POSTS SECUNDÁRIOS (4 COLUNAS) --}}
            <div class="lg:col-span-4 flex flex-col gap-2 h-auto lg:h-full">
                @foreach ($featured->slice(1, 2) as $item)
                    <article class="flex-1 relative group overflow-hidden bg-ueap-blue-dark">
                        <a href="{{ route('site.post.show', $item->slug) }}" class="block h-full w-full">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-70 group-hover:opacity-90">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#00255E] via-transparent to-transparent">
                            </div>

                            <div class="absolute bottom-0 p-6 w-full">
                                <span
                                    class="text-ueap-green text-[9px] font-black uppercase tracking-widest mb-2 block">
                                    {{ $item->category->name }}
                                </span>
                                <h3
                                    class="text-white text-xl font-black leading-tight tracking-tighter group-hover:text-ueap-green transition-colors line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>

        {{-- 02. BARRA DE ACESSO RÁPIDO (DISTANCIADA COM PADDING ANTERIOR) --}}
        <div class="relative">
            {{-- Identificador de Seção --}}
            <div class="flex items-center gap-3 mb-6">
                <span class="text-[11px] font-black uppercase tracking-[0.4em] text-ueap-blue-dark/40">Sistemas e
                    serviços</span>
                <div class="flex-1 h-px bg-gray-100"></div>
            </div>

            <nav class="bg-ueap-blue-dark border-t-4 border-ueap-green shadow-xl">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 divide-x divide-white/10">
                    @php
                        $quicklinks = [
                            [
                                'icon' => 'fa-calendar-days',
                                'label' => 'Calendário acadêmico',
                                'url' => route('site.post.list'),
                            ],
                            [
                                'icon' => 'fa-scale-balanced',
                                'label' => 'Legislação e normas',
                                'url' => '/pagina/legislacao.html',
                            ],
                            [
                                'icon' => 'fa-file-invoice',
                                'label' => 'Instruções normativas',
                                'url' => '/pagina/instrucoes_normativas.html',
                            ],
                            ['icon' => 'fa-gavel', 'label' => 'Resoluções consu', 'url' => '/consu/resolucoes'],
                            [
                                'icon' => 'fa-hand-holding-dollar',
                                'label' => 'Portal de licitações',
                                'url' => 'https://transparencia.ueap.edu.br/licitacoes',
                            ],
                            [
                                'icon' => 'fa-users-viewfinder',
                                'label' => 'Processos seletivos',
                                'url' => '/pagina/area-processos-seletivos.html',
                            ],
                        ];
                    @endphp

                    @foreach ($quicklinks as $link)
                        <a href="{{ $link['url'] }}"
                            class="group flex flex-col lg:flex-row items-center gap-4 py-6 px-6 transition-all hover:bg-white/5 border-b lg:border-b-0 border-white/5">

                            {{-- Ícone Quadrado Travado --}}
                            <div
                                class="w-12 h-12 shrink-0 flex items-center justify-center bg-white/5 border border-white/10 group-hover:bg-ueap-green transition-all shadow-inner">
                                <i
                                    class="fa-solid {{ $link['icon'] }} text-blue-200 group-hover:text-ueap-blue-dark text-xl"></i>
                            </div>

                            {{-- Label Sólida --}}
                            <span
                                class="text-[13px] font-black text-blue-100 uppercase tracking-tighter leading-tight text-center lg:text-left transition-colors">
                                {{ $link['label'] }}
                            </span>
                        </a>
                    @endforeach
                </div>
            </nav>
        </div>

    </div>
</section>
