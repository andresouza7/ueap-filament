{{-- FOOTER COM IDENTIDADE UEAP --}}
<footer class="bg-ueap-blue-dark text-white pt-16 md:pt-20 pb-8 relative overflow-hidden" role="contentinfo">
    {{-- Camada visual decorativa --}}
    <div aria-hidden="true"
        class="hidden 2xl:block absolute top-0 left-0 w-1/4 h-full bg-white/[0.02] -skew-x-12 -translate-x-1/2 pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        @php
            $footerMenu = [
                [
                    'title' => 'Institucional',
                    'links' => [
                        'Sobre a UEAP' => '/pagina/historia.html',
                        'Reitoria' => '/pagina/reitoria.html',
                        'Pró-Reitorias' => '/pagina/pro_reitorias.html',
                        'Conselhos' => '#',
                        'Campi e Polos' => '#',
                    ],
                ],
                [
                    'title' => 'Cursos',
                    'links' => [
                        'Graduação' => '#',
                        'Pós-Graduação' => '#',
                        'Extensão' => '#',
                        'EAD' => '#',
                    ],
                ],
                [
                    'title' => 'Ensino',
                    'links' => [
                        'Biblioteca' => '/pagina/biblioteca.html',
                        'Portal do Aluno' => 'https://sigaa.ueap.edu.br/sigaa/',
                        'Calendário' => '/documentos/calendar',
                    ],
                ],
                [
                    'title' => 'Comunidade',
                    'links' => [
                        'Notícias' => '/postagens?type=news',
                        'Eventos' => '/postagens?type=event',
                        'Editais' => 'https://processoseletivo.ueap.edu.br',
                    ],
                ],
                [
                    'title' => 'Transparência',
                    'links' => [
                        'Dados Abertos' => '#',
                        'Licitações' => 'https://transparencia.ueap.edu.br/licitacoes',
                        'Ouvidoria (e-SIC)' => 'https://ouvamapa.portal.ap.gov.br/',
                    ],
                    'wide' => true,
                ],
            ];
        @endphp

        {{-- GRID DE LINKS --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-8 gap-y-10 mb-12 lg:mb-16">
            @foreach ($footerMenu as $section)
                <nav class="{{ $section['wide'] ?? false ? 'col-span-2 lg:col-span-1' : '' }}"
                    aria-label="Menu {{ $section['title'] }}">
                    <div class="flex items-center gap-2 mb-4" aria-hidden="true">
                        <span class="w-4 h-[2px] bg-ueap-green"></span>
                        <h4 class="text-xs font-bold uppercase tracking-widest text-ueap-green">
                            {{ $section['title'] }}
                        </h4>
                    </div>
                    <h4 class="sr-only">{{ $section['title'] }}</h4>

                    <ul class="space-y-3 text-sm text-blue-100/70 font-medium">
                        @foreach ($section['links'] as $label => $url)
                            <li>
                                <a href="{{ $url }}" class="hover:text-white transition-colors">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>

        {{-- INFO PRINCIPAL --}}
        <div
            class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-12 border-t border-white/5 pt-12 mb-12">

            {{-- Bloco Institucional --}}
            <div class="flex flex-col gap-4 max-w-lg">
                <div class="flex items-center gap-3">
                    <span
                        class="px-2 py-0.5 bg-ueap-green/10 border border-ueap-green/20 text-ueap-green text-[10px] font-bold uppercase tracking-widest rounded-sm">
                        Desde 2006
                    </span>
                    <h2 class="text-3xl lg:text-4xl font-display font-black text-white tracking-tight">UEAP</h2>
                </div>

                <h3 class="text-xl text-white font-medium leading-tight">
                    Universidade do Estado do Amapá
                </h3>

                <p class="text-blue-100/60 text-sm leading-relaxed">
                    Promovendo educação de qualidade e desenvolvimento sustentável para a região amazônica.
                </p>
            </div>

            {{-- Selo MEC --}}
            <a href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/NTcwMQ=="
                target="_blank" rel="noopener noreferrer"
                class="group flex items-center gap-4 bg-white/5 p-4 rounded-lg hover:bg-white/10 transition-colors">

                <div class="text-right">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-ueap-green mb-1">
                        Credenciada
                    </p>
                    <p class="text-xs text-white font-bold">
                        Portal e-MEC
                    </p>
                </div>

                <div class="bg-white p-1 rounded-sm w-12 h-12 flex items-center justify-center">
                    <img class="max-w-full max-h-full" src="/img/site/banner_mec.png" alt="Selo e-MEC">
                </div>
            </a>
        </div>

        {{-- ENDEREÇOS --}}
        <section class="mb-12 border-b border-white/5 pb-12" aria-labelledby="footer-enderecos-title">
            <h5 id="footer-enderecos-title"
                class="text-[10px] font-bold uppercase tracking-widest text-ueap-green/60 mb-6 flex items-center gap-3">
                <span class="w-8 h-[1px] bg-ueap-green/30" aria-hidden="true"></span>
                Nossos endereços
            </h5>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-8">
                @php
                    $enderecos = [
                        [
                            'nome' => 'Campus I',
                            'end' => 'Av. Presidente Vargas, 650 - Centro',
                        ],
                        [
                            'nome' => 'Território dos Lagos',
                            'end' => 'Av. Desidério Antônio, 470 - Amapá-AP',
                        ],
                        [
                            'nome' => 'Administrativo',
                            'end' => 'Rua Tiradentes, 284 - Centro',
                        ],
                        [
                            'nome' => 'Anexo Graziela',
                            'end' => 'Av. Duque de Caxias, 60 - Centro',
                        ],
                        ['nome' => 'NTE', 'end' => 'Av. 13 de Setembro, 2081 - Buritizal'],
                        [
                            'nome' => 'Campus III',
                            'end' => 'Av. Mendonça Furtado - Centro',
                        ],
                    ];
                @endphp

                @foreach ($enderecos as $item)
                    <div class="flex flex-col">
                        <h5 class="text-xs font-bold text-white uppercase tracking-wider mb-1">
                            {{ $item['nome'] }}
                        </h5>
                        <p class="text-xs text-blue-100/50">
                            {{ $item['end'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- BOTTOM --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-blue-100/40 text-[10px] font-bold uppercase tracking-widest">
                © 2026 UEAP — Todos os direitos reservados.
            </p>
            <div class="flex gap-4">
                <a href="https://www.youtube.com/channel/UCB6gc6QS_nJmCP5rNBh0kQQ" target="_blank"
                    class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-ueap-green transition-all text-blue-100/40 hover:text-white">
                    <i class="fa-brands fa-youtube text-sm"></i>
                </a>
                <a href="https://www.instagram.com/ueapoficial/" target="_blank"
                    class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-ueap-green transition-all text-blue-100/40 hover:text-white">
                    <i class="fa-brands fa-instagram text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
