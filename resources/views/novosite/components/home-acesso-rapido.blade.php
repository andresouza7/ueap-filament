{{-- BARRA DE ACESSO RÁPIDO - VERSÃO ULTRA-CONDENSADA --}}
<section class="w-full relative z-40 py-2 px-4 bg-gray-50" role="navigation">
    <div class="max-w-7xl mx-auto">

        {{-- Container Slim --}}
        <div class="bg-white border border-gray-200 shadow-sm overflow-hidden">

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 divide-x divide-gray-100">

                @php
                    $links = [
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

                @foreach ($links as $link)
                    <a href="{{ $link['url'] }}"
                        class="group relative flex items-center gap-3 py-3 px-4 transition-all duration-200 hover:bg-ueap-blue-dark">

                        {{-- Ícone Compacto --}}
                        <div
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded bg-gray-50 group-hover:bg-ueap-green transition-colors">
                            <i class="fa-solid {{ $link['icon'] }} text-sm text-ueap-blue-dark"></i>
                        </div>

                        {{-- Label Direta --}}
                        <span
                            class="text-[11px] font-bold text-ueap-blue-dark group-hover:text-white leading-tight transition-colors">
                            {{ $link['label'] }}
                        </span>

                        {{-- Detalhe lateral de hover --}}
                        <div
                            class="absolute left-0 top-0 bottom-0 w-1 bg-ueap-green opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
</section>
