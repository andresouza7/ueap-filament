<footer class="bg-ueap-primary text-white pt-16 pb-8" role="contentinfo">
    <div class="max-w-ueap mx-auto px-4 lg:px-8">

        {{-- TOP GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16 border-b border-white/10 pb-16">

            {{-- Brand Column --}}
            <div class="lg:col-span-4 space-y-6">
                <a href="/" class="inline-block">
                    <img src="/img/site/logo.png" alt="UEAP Logo" class="h-16 w-auto brightness-0 invert opacity-90">
                </a>
                <div class="space-y-1">
                    <h3 class="text-2xl font-bold tracking-tight text-white">UEAP</h3>
                    <p class="text-sm text-ueap-secondary font-medium tracking-wide uppercase">Universidade do Estado do Amapá</p>
                </div>
                <p class="text-white/70 text-sm leading-relaxed max-w-sm">
                    Educação pública, gratuita e de qualidade para o desenvolvimento da Amazônia.
                </p>

                <div class="flex gap-4 pt-2">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-ueap-secondary hover:text-ueap-primary transition-all">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-ueap-secondary hover:text-ueap-primary transition-all">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-ueap-secondary hover:text-ueap-primary transition-all">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </div>
            </div>

            {{-- Links Columns --}}
            <div class="lg:col-span-8 grid grid-cols-2 md:grid-cols-4 gap-8">
                @php
                    $footerCols = [
                        ['title' => 'Institucional', 'links' => ['Sobre a UEAP', 'Reitoria', 'Pró-Reitorias', 'Campi e Polos']],
                        ['title' => 'Acadêmico', 'links' => ['Graduação', 'Pós-Graduação', 'Extensão', 'EAD']],
                        ['title' => 'Serviços', 'links' => ['Biblioteca', 'Portal do Aluno', 'Calendário', 'Editais']],
                        ['title' => 'Acesso Rápido', 'links' => ['Notícias', 'Eventos', 'Transparência', 'Ouvidoria']],
                    ];
                @endphp

                @foreach ($footerCols as $col)
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-ueap-secondary mb-6">{{ $col['title'] }}</h4>
                        <ul class="space-y-3">
                            @foreach ($col['links'] as $link)
                                <li>
                                    <a href="#" class="text-sm text-white/70 hover:text-white hover:pl-1 transition-all block">
                                        {{ $link }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- BOTTOM BAR --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-xs text-white/50 text-center md:text-left">
                <p>&copy; {{ date('Y') }} Universidade do Estado do Amapá. Todos os direitos reservados.</p>
                <p class="mt-1">Desenvolvido pelo PRODAP - Centro de Gestão de Tecnologia da Informação.</p>
            </div>

            <a href="https://emec.mec.gov.br" target="_blank" class="flex items-center gap-3 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-lg border border-white/5 transition-colors">
                <img src="/img/site/banner_mec.png" alt="Selo e-MEC" class="h-8 w-auto brightness-0 invert">
                <div class="text-left">
                    <p class="text-[10px] font-bold uppercase text-ueap-secondary">Credenciada</p>
                    <p class="text-[10px] text-white/80">Portal e-MEC</p>
                </div>
            </a>
        </div>
    </div>
</footer>
