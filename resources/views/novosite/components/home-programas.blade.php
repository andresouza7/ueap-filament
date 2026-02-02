{{-- SECTION 02: PROGRAMAS & BOLSAS - DESIGN SÓLIDO E RETO --}}
<section class="relative bg-white py-16 md:py-24 border-b border-gray-100 overflow-hidden"
    aria-labelledby="titulo-programas">

    {{-- Background Técnico Sutil --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.03]" aria-hidden="true"
        style="background-image: radial-gradient(#00255E 1px, transparent 1px); background-size: 32px 32px;">
    </div>

    <div class="max-w-7xl relative z-10 mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Sólido --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
            <div class="max-w-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-1.5 w-10 bg-ueap-green" aria-hidden="true"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-ueap-blue-dark/50">
                        Assistência Estudantil
                    </span>
                </div>
                <h3 id="titulo-programas"
                    class="text-4xl md:text-6xl font-black text-ueap-blue-dark tracking-tighter uppercase leading-[0.9]">
                    Programas <span class="text-ueap-green">&</span> Bolsas
                </h3>
            </div>
            <div class="md:text-right border-l-4 md:border-l-0 md:border-r-4 border-ueap-green pl-6 md:pl-0 md:pr-6">
                <p class="text-gray-500 text-sm font-bold leading-tight uppercase tracking-wider max-w-xs">
                    Desenvolvimento acadêmico, científico e apoio à permanência estudantil.
                </p>
            </div>
        </div>

        @php
            $programas = [
                ['sigla' => 'Pibid', 'desc' => 'Iniciação à Docência', 'url' => '/pagina/pibid.html'],
                ['sigla' => 'Prp', 'desc' => 'Residência Pedagógica', 'url' => '/pagina/prp.html'],
                ['sigla' => 'Proace', 'desc' => 'Ações Comunitárias', 'url' => '/pagina/proace.html'],
                ['sigla' => 'Proape', 'desc' => 'Apoio Pedagógico', 'url' => '/pagina/proape.html'],
                ['sigla' => 'Probict', 'desc' => 'Bolsas de C&T', 'url' => '/pagina/probict.html'],
                ['sigla' => 'Monitoria', 'desc' => 'Apoio Acadêmico', 'url' => '/pagina/promonitoria.html'],
                ['sigla' => 'Pibic', 'desc' => 'Iniciação Científica', 'url' => '/pagina/pibic.html'],
                ['sigla' => 'Pibt', 'desc' => 'Inovação Tecnológica', 'url' => '/pagina/pibt.html'],
            ];
        @endphp

        {{-- Grid Brutalista (Bordas Retas e Gap Técnico) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-px bg-gray-200 border border-gray-200 shadow-2xl"
            role="list">
            @foreach ($programas as $index => $p)
                <div role="listitem" class="contents">
                    <a href="{{ $p['url'] }}"
                        class="group relative block bg-white p-8 transition-all duration-300 hover:bg-ueap-blue-dark overflow-hidden">

                        {{-- Detalhe Inferior Verde (Hover) --}}
                        <div
                            class="absolute bottom-0 left-0 h-1 w-0 bg-ueap-green group-hover:w-full transition-all duration-500">
                        </div>

                        <div class="relative z-10 flex flex-col justify-between h-36">
                            <div class="flex justify-between items-start">
                                <span aria-hidden="true"
                                    class="text-[10px] font-mono font-black text-gray-300 group-hover:text-ueap-green transition-colors">
                                    [{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}]
                                </span>
                                <div
                                    class="w-8 h-8 flex items-center justify-center bg-gray-50 group-hover:bg-ueap-green transition-colors">
                                    <i
                                        class="fa-solid fa-arrow-right text-ueap-blue-dark text-xs transition-transform group-hover:-rotate-45"></i>
                                </div>
                            </div>

                            <div class="flex flex-col gap-1">
                                <h4
                                    class="text-3xl font-black text-ueap-blue-dark uppercase tracking-tighter group-hover:text-white transition-colors leading-none">
                                    {{ strtoupper($p['sigla']) }}
                                </h4>
                                <p
                                    class="text-[10px] text-gray-400 font-bold uppercase tracking-widest group-hover:text-ueap-green/80 transition-colors">
                                    {{ $p['desc'] }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>
