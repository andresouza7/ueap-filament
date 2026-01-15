{{-- SECTION: PROGRAMAS & BOLSAS (ESTILO UEAP 2026) --}}
<section class="relative bg-[#A4ED4A] py-16 md:py-32 overflow-hidden" aria-labelledby="titulo-programas">

    {{-- Background: Halftone azul sutil para profundidade --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.08]" aria-hidden="true"
        style="background-image: radial-gradient(#0055FF 1.5px, transparent 1.5px); background-size: 24px 24px;">
    </div>

    <div class="max-w-[1440px] relative z-10 mx-auto px-4 md:px-12">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end gap-4 mb-12 md:mb-20">
            <h2 id="titulo-programas" class="text-5xl md:text-8xl font-black text-[#0055FF] uppercase tracking-tighter leading-[0.85]">
                Programas <br><span class="text-white">& Bolsas</span>
            </h2>
            <div class="flex-1 h-1 bg-white/30 rounded-full mb-2 hidden md:block" aria-hidden="true"></div>
            <span class="bg-[#0055FF] text-white px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                Oportunidades Acadêmicas
            </span>
        </div>

        @php
            $programas = [
                ['sigla' => 'PIBID', 'desc' => 'Iniciação à Docência', 'url' => '/pagina/pibid.html'],
                ['sigla' => 'PRP', 'desc' => 'Residência Pedagógica', 'url' => '/pagina/prp.html'],
                ['sigla' => 'PROACE', 'desc' => 'Ações Comunitárias', 'url' => '/pagina/proace.html'],
                ['sigla' => 'PROAPE', 'desc' => 'Apoio Pedagógico', 'url' => '/pagina/proape.html'],
                ['sigla' => 'PROBICT', 'desc' => 'Bolsas de C&T', 'url' => '/pagina/probict.html'],
                ['sigla' => 'MONITORIA', 'desc' => 'Apoio Acadêmico', 'url' => '/pagina/promonitoria.html'],
                ['sigla' => 'PIBIC', 'desc' => 'Iniciação Científica', 'url' => '/pagina/pibic.html'],
                ['sigla' => 'PIBT', 'desc' => 'Inovação Tecnológica', 'url' => '/pagina/pibt.html'],
            ];
        @endphp

        {{-- Grid: Cards Arredondados --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" role="list">
            @foreach ($programas as $index => $p)
                <div role="listitem" class="contents">
                    <a href="{{ $p['url'] }}"
                        aria-label="Programa {{ $p['sigla'] }}: {{ $p['desc'] }}"
                        class="group relative block bg-white p-8 rounded-[40px] transition-all duration-500 shadow-lg hover:shadow-2xl hover:-translate-y-2 focus:ring-4 focus:ring-[#0055FF] focus:outline-none">

                        {{-- Número do Card (Acessibilidade: oculto pois a sigla é o título principal) --}}
                        <div aria-hidden="true" 
                             class="text-[10px] font-black text-[#A4ED4A] mb-8 bg-[#0055FF] w-8 h-8 rounded-full flex items-center justify-center">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="flex flex-col h-full">
                            <h3 class="text-3xl md:text-4xl font-black text-[#0055FF] tracking-tighter leading-none uppercase mb-2 group-hover:scale-105 transition-transform origin-left">
                                {{ $p['sigla'] }}
                            </h3>
                            <p class="text-[11px] text-slate-500 font-bold uppercase tracking-widest leading-tight italic">
                                {{ $p['desc'] }}
                            </p>

                            {{-- Botão de Ação Estilizado --}}
                            <div class="mt-8 flex items-center gap-2" aria-hidden="true">
                                <div class="h-1 w-8 bg-[#A4ED4A] group-hover:w-12 transition-all duration-500"></div>
                                <i class="fa-solid fa-circle-plus text-[#0055FF] text-xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </div>
                        </div>

                        {{-- Efeito de Canto Decorativo --}}
                        <div aria-hidden="true" 
                             class="absolute top-0 right-0 w-24 h-24 bg-[#A4ED4A]/10 rounded-bl-[80px] -z-10 group-hover:bg-[#A4ED4A]/30 transition-colors">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Footer da Seção --}}
        <div class="mt-16 flex flex-col md:flex-row justify-between items-center gap-6" aria-hidden="true">
            <div class="flex items-center gap-3">
                <span class="text-[10px] font-black text-[#0055FF] uppercase tracking-[0.3em]">Editais Abertos</span>
                <div class="flex gap-1">
                    <span class="w-2 h-2 rounded-full bg-white animate-bounce"></span>
                    <span class="w-2 h-2 rounded-full bg-white animate-bounce [animation-delay:-0.15s]"></span>
                    <span class="w-2 h-2 rounded-full bg-white animate-bounce [animation-delay:-0.3s]"></span>
                </div>
            </div>
            
            <a href="#" class="text-[10px] font-black text-white bg-[#0055FF] px-8 py-3 rounded-full uppercase tracking-widest hover:bg-white hover:text-[#0055FF] transition-all shadow-md">
                Ver Todos os Programas
            </a>
        </div>
    </div>
</section>