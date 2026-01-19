<footer class="bg-ueap-primary text-white pt-16 pb-8 relative" role="contentinfo">
    <div class="max-w-ueap mx-auto px-4 lg:px-8 relative z-10">

        @php
            $footerMenu = [
                ['title' => 'Institucional', 'links' => ['Sobre a UEAP' => '/pagina/historia.html', 'Reitoria' => '/pagina/reitoria.html', 'Pró-Reitorias' => '/pagina/pro_reitorias.html', 'Campi e Polos' => '#']],
                ['title' => 'Acadêmico', 'links' => ['Graduação' => '#', 'Pós-Graduação' => '#', 'Extensão' => '#', 'EAD' => '#']],
                ['title' => 'Serviços', 'links' => ['Biblioteca' => '/pagina/biblioteca.html', 'Portal do Aluno' => 'https://sigaa.ueap.edu.br/sigaa/', 'Calendário' => '/documentos/calendar']],
                ['title' => 'Comunidade', 'links' => ['Notícias' => '/postagens?type=news', 'Editais' => 'https://processoseletivo.ueap.edu.br', 'Eventos' => '/postagens?type=event']],
                ['title' => 'Transparência', 'links' => ['Dados Abertos' => '#', 'Licitações' => '#', 'Ouvidoria' => 'https://ouvamapa.portal.ap.gov.br/']],
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mb-12">
            @foreach ($footerMenu as $section)
                <nav>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-ueap-secondary mb-4 border-b border-white/10 pb-2 inline-block">
                        {{ $section['title'] }}
                    </h4>
                    <ul class="space-y-2">
                        @foreach ($section['links'] as $label => $url)
                            <li>
                                <a href="{{ $url }}" class="text-sm text-white/70 hover:text-white transition-colors block py-0.5">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>

        <div class="flex flex-col lg:flex-row justify-between items-center gap-8 border-t border-white/10 pt-12 pb-12">
            <div class="flex flex-col md:flex-row items-center gap-6">
                 <div class="text-center md:text-left">
                    <h3 class="text-3xl font-bold tracking-tight mb-1">UEAP</h3>
                    <p class="text-sm text-white/60">Universidade do Estado do Amapá</p>
                </div>
                 <div class="hidden md:block h-10 w-px bg-white/10"></div>
                 <p class="text-sm text-white/60 max-w-md text-center md:text-left">
                    Educação que transforma, ciência que desenvolve o nosso Amapá.
                 </p>
            </div>

            <a href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/NTcwMQ=="
                target="_blank" rel="noopener"
                class="bg-white/5 hover:bg-white/10 px-4 py-2 rounded-lg flex items-center gap-3 transition-colors border border-white/10">
                <img src="/img/site/banner_mec.png" alt="Selo e-MEC" class="w-10 h-10 object-contain brightness-0 invert">
                <div class="text-left">
                    <p class="text-[10px] font-bold uppercase text-ueap-secondary">Portal e-MEC</p>
                    <p class="text-xs text-white/80">Instituição Credenciada</p>
                </div>
            </a>
        </div>

        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/40">
            <p>&copy; 2026 UEAP | PRODAP - Centro de Gestão de Tecnologia da Informação</p>
            <div class="flex gap-4">
                <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-youtube text-lg"></i></a>
                <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-instagram text-lg"></i></a>
            </div>
        </div>
    </div>
</footer>
