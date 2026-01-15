{{-- FOOTER: IDENTIDADE UEAP 2026 --}}
<footer class="bg-[#002266] text-white pt-16 md:pt-28 pb-10 relative overflow-hidden" role="contentinfo">
    
    {{-- Elementos Decorativos de Fundo --}}
    <div aria-hidden="true" class="absolute inset-0 pointer-events-none opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" 
             style="background-image: radial-gradient(#A4ED4A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#A4ED4A] rounded-full blur-[120px]"></div>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 md:px-12 relative z-10">

        @php
            $footerMenu = [
                ['title' => 'Institucional', 'links' => ['Sobre a UEAP' => '/pagina/historia.html', 'Reitoria' => '/pagina/reitoria.html', 'Pró-Reitorias' => '/pagina/pro_reitorias.html', 'Campi e Polos' => '#']],
                ['title' => 'Acadêmico', 'links' => ['Graduação' => '#', 'Pós-Graduação' => '#', 'Extensão' => '#', 'EAD' => '#']],
                ['title' => 'Serviços', 'links' => ['Biblioteca' => '/pagina/biblioteca.html', 'Portal do Aluno' => 'https://sigaa.ueap.edu.br/sigaa/', 'Calendário' => '/documentos/calendar']],
                ['title' => 'Comunidade', 'links' => ['Notícias' => '/postagens?type=news', 'Editais' => 'https://processoseletivo.ueap.edu.br', 'Eventos' => '/postagens?type=event']],
                ['title' => 'Transparência', 'links' => ['Dados Abertos' => '#', 'Licitações' => '#', 'Ouvidoria' => 'https://ouvamapa.portal.ap.gov.br/'], 'wide' => true],
            ];
        @endphp

        {{-- GRID DE LINKS --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mb-20">
            @foreach ($footerMenu as $section)
                <nav aria-label="Menu {{ $section['title'] }}">
                    <div class="flex items-center gap-2 mb-6" aria-hidden="true">
                        <span class="w-3 h-3 bg-[#A4ED4A] rounded-full"></span>
                        <h4 class="text-[12px] font-black uppercase tracking-[0.2em] text-[#A4ED4A]">
                            {{ $section['title'] }}
                        </h4>
                    </div>
                    <ul class="space-y-3">
                        @foreach ($section['links'] as $label => $url)
                            <li>
                                <a href="{{ $url }}" class="text-sm text-blue-100/70 hover:text-white hover:translate-x-1 inline-block transition-all focus:ring-2 focus:ring-[#A4ED4A] focus:outline-none rounded">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>

        {{-- INFO PRINCIPAL --}}
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-12 border-t border-white/10 pt-16 mb-20">
            
            <div class="relative group">
                <div class="mb-4 inline-flex bg-[#A4ED4A] text-[#002266] px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                    Universidade Pública Estadual
                </div>
                <h3 class="text-7xl md:text-9xl font-black text-white tracking-[ -0.05em] leading-[0.8] mb-4">
                    UE<span class="text-[#A4ED4A]">AP</span>
                </h3>
                <p class="text-blue-100/60 font-bold text-lg max-w-md leading-tight">
                    Educação que transforma, ciência que desenvolve o nosso Amapá.
                </p>
            </div>

            {{-- Selo e-MEC --}}
            <a href="https://emec.mec.gov.br/emec/consulta-cadastro/detalhamento/d96957f455f6405d14c6542552b0f6eb/NTcwMQ=="
                target="_blank" rel="noopener"
                aria-label="Verificar cadastro da UEAP no Portal e-MEC (abre em nova aba)"
                class="group relative bg-white p-4 rounded-[30px] shadow-2xl transition-transform hover:scale-105 focus:ring-4 focus:ring-[#A4ED4A] focus:outline-none">
                <div class="flex items-center gap-4">
                    <img src="/img/site/banner_mec.png" alt="Selo e-MEC" class="w-20 h-20 object-contain">
                    <div class="pr-4">
                        <p class="text-[10px] font-black uppercase text-[#002266]">Portal e-MEC</p>
                        <p class="text-xs text-slate-500 font-bold italic">Instituição Credenciada</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- ENDEREÇOS --}}
        <section class="mb-20" aria-labelledby="footer-campi">
            <h5 id="footer-campi" class="text-[11px] font-black uppercase tracking-[0.3em] text-[#A4ED4A] mb-8 flex items-center gap-3">
                Unidades e Campi
            </h5>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $campi = [
                        ['n' => 'Campus I (Sede)', 'e' => 'Av. Presidente Vargas, 650 - Centro'],
                        ['n' => 'Campus Laranjal do Jari', 'e' => 'Rua Projetada, s/n - Jari'],
                        ['n' => 'Campus Amapá', 'e' => 'Av. Desidério Antônio, 470'],
                    ];
                @endphp
                @foreach ($campi as $c)
                    <div class="p-6 rounded-[24px] bg-white/5 border border-white/10 hover:bg-white/10 transition-colors">
                        <h6 class="text-[#A4ED4A] font-black uppercase text-xs mb-2">{{ $c['n'] }}</h6>
                        <p class="text-blue-100/60 text-xs leading-snug">{{ $c['e'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- BARRA FINAL --}}
        <div class="pt-10 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-blue-100/40">
                    © 2026 UEAP | PRODAP - Centro de Gestão de Tecnologia da Informação
                </p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="#" aria-label="YouTube" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center hover:bg-red-600 transition-all">
                    <i class="fa-brands fa-youtube text-xl"></i>
                </a>
                <a href="#" aria-label="Instagram" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center hover:bg-gradient-to-tr from-purple-500 to-pink-500 transition-all">
                    <i class="fa-brands fa-instagram text-xl"></i>
                </a>
                <a href="#" aria-label="Subir ao topo" class="ml-4 w-12 h-12 rounded-[15px] bg-[#A4ED4A] flex items-center justify-center text-[#002266] hover:-translate-y-2 transition-transform">
                    <i class="fa-solid fa-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>
</footer>