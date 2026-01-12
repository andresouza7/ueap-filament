{{-- SECTION 02: PROGRAMAS & BOLSAS (GRID PROFISSIONAL + LISTA MOBILE ALINHADA) --}}
<section class="relative bg-white py-12 md:py-32 overflow-hidden">

    {{-- Background: Pontilhado com Fade --}}
    <div class="absolute inset-0 pointer-events-none opacity-[0.1]"
        style="background-image: radial-gradient(#000 1px, transparent 1px); 
                background-size: 24px 24px;
                mask-image: linear-gradient(to bottom, transparent, black 80%);
                -webkit-mask-image: linear-gradient(to bottom, transparent, black 80%);">
    </div>

    <div class="max-w-ueap relative z-10 mx-auto px-4 md:px-10">

        {{-- Header --}}
        <div class="flex items-center gap-4 md:gap-8 mb-8 md:mb-16">
            <h3 class="text-3xl md:text-6xl font-[1000] text-slate-900 uppercase tracking-tighter leading-none italic">
                Programas <span class="text-emerald-500 not-italic">&</span> Bolsas
            </h3>
            <div class="flex-1 h-px bg-slate-100 relative hidden md:block">
                <span
                    class="absolute right-0 -top-3 font-mono text-[9px] text-slate-300 tracking-[0.5em] uppercase">Setor_Academico</span>
            </div>
        </div>

        @php
            $programas = [
                ['sigla' => 'PIBID', 'desc' => 'Iniciação à Docência'],
                ['sigla' => 'PRP', 'desc' => 'Residência Pedagógica'],
                ['sigla' => 'PROACE', 'desc' => 'Ações Comunitárias'],
                ['sigla' => 'PROAPE', 'desc' => 'Apoio Pedagógico'],
                ['sigla' => 'PROBICT', 'desc' => 'Bolsas de C&T'],
                ['sigla' => 'MONITORIA', 'desc' => 'Apoio Acadêmico'],
                ['sigla' => 'PIBIC', 'desc' => 'Iniciação Científica'],
                ['sigla' => 'PIBT', 'desc' => 'Inovação Tecnológica'],
            ];
        @endphp

        {{-- Grid: Mobile Lista | Desktop Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-px bg-slate-200 border border-slate-200 shadow-2xl">
            @foreach ($programas as $index => $p)
                <a href="#"
                    class="group relative block bg-white p-4 md:p-8 transition-all duration-500 overflow-hidden">

                    {{-- Indicador Lateral (Hover) --}}
                    <div
                        class="absolute left-0 top-0 h-full w-0 bg-emerald-500 transition-all duration-300 group-hover:w-[4px]">
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-4">

                        {{-- Bloco de Texto Alinhado --}}
                        <div class="flex items-center gap-4 md:block">
                            {{-- ID numérico discreto --}}
                            <span
                                class="text-[9px] md:text-[10px] font-mono font-black text-slate-300 group-hover:text-emerald-500 transition-colors uppercase md:block md:mb-12">
                                #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <div class="flex flex-col gap-1 sm:gap-0">
                                <h4
                                    class="text-xl md:text-3xl font-[1000] text-slate-900 tracking-tighter group-hover:text-emerald-600 transition-colors leading-none uppercase">
                                    {{ $p['sigla'] }}
                                </h4>
                                <p
                                    class="text-[9px] md:text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-tight group-hover:text-slate-600 transition-colors md:mt-2">
                                    {{ $p['desc'] }}
                                </p>
                            </div>
                        </div>

                        {{-- Seta de Ação --}}
                        <div
                            class="relative flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-sm border border-slate-100 bg-slate-50/50 group-hover:bg-emerald-500 group-hover:border-emerald-500 group-hover:rotate-45 transition-all duration-500">
                            <i
                                class="fa-solid fa-arrow-right text-[10px] text-slate-400 group-hover:text-white group-hover:-rotate-45 transition-all"></i>
                        </div>
                    </div>

                    {{-- Overlay sutil no Hover --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-emerald-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Footer --}}
        <div class="mt-8 md:mt-16 flex justify-between items-center px-2">
            <div class="flex items-center gap-2 px-3 py-1 bg-slate-50 border border-slate-100">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[9px] font-mono font-bold uppercase text-slate-500">Editais_UEAP</span>
            </div>
            <div class="text-[9px] font-mono font-bold uppercase text-slate-300 tracking-[0.3em]">
                UEAP_SYS
            </div>
        </div>
    </div>
</section>
