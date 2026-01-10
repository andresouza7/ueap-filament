<section class="py-20 bg-white relative overflow-hidden">
    {{-- Elemento decorativo sutil de fundo --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-slate-50/50 -skew-x-12 translate-x-1/2 pointer-events-none"></div>

    <div class="max-w-ueap mx-auto px-6 lg:px-10 relative z-10">

        {{-- SEÇÃO 1: SERVIÇOS --}}
        <div class="mb-20">
            <div class="flex flex-col mb-10">
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-[2px] bg-emerald-600"></span>
                    <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-emerald-700">Utilidade</h2>
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900 uppercase tracking-tighter leading-none">
                    Serviços <span class="text-emerald-500">Institucionais</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-slate-200 border border-slate-200 shadow-2xl shadow-slate-200/50">
                <a href="#" class="group flex items-center p-10 bg-white transition-all duration-500 hover:bg-slate-50">
                    <div class="flex-1">
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-2 block opacity-70">Acesso ao Usuário</span>
                        <h4 class="text-2xl md:text-3xl font-black text-slate-900 uppercase tracking-tighter group-hover:text-emerald-700 transition-colors">
                            Carta de Serviços
                        </h4>
                    </div>
                    <div class="w-12 h-12 rounded-full border border-slate-100 flex items-center justify-center group-hover:bg-emerald-600 group-hover:border-emerald-600 transition-all duration-500">
                        <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-white group-hover:translate-x-1 transition-all"></i>
                    </div>
                </a>

                <a href="#" class="group flex items-center p-10 bg-white transition-all duration-500 hover:bg-slate-50">
                    <div class="flex-1">
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-2 block opacity-70">Canal de Escuta</span>
                        <h4 class="text-2xl md:text-3xl font-black text-slate-900 uppercase tracking-tighter group-hover:text-emerald-700 transition-colors">
                            Ouvidoria @UEAP
                        </h4>
                    </div>
                    <div class="w-12 h-12 rounded-full border border-slate-100 flex items-center justify-center group-hover:bg-emerald-600 group-hover:border-emerald-600 transition-all duration-500">
                        <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-white group-hover:translate-x-1 transition-all"></i>
                    </div>
                </a>
            </div>
        </div>

        {{-- SEÇÃO 2: PLATAFORMAS (Cards de Impacto) --}}
        <div class="mb-20">
            <div class="flex flex-col mb-10 items-end text-right">
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-emerald-700">Digital</h2>
                    <span class="w-8 h-[2px] bg-emerald-600"></span>
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900 uppercase tracking-tighter leading-none">
                    Nossas <span class="text-emerald-500">Plataformas</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- UEAP TV --}}
                <a href="#" class="relative h-64 bg-slate-900 overflow-hidden group rounded-2xl shadow-2xl shadow-emerald-900/20">
                    <img src="placeholder-tv.jpg" class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-110 group-hover:rotate-2 transition-all duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/40 to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <span class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.2em] mb-2 block">Streaming Oficial</span>
                        <h4 class="text-4xl font-black text-white uppercase tracking-tighter leading-none">UEAP TV</h4>
                    </div>
                    <div class="absolute top-8 right-8 h-14 w-14 flex items-center justify-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 group-hover:bg-emerald-500 group-hover:border-emerald-500 transition-all duration-500 shadow-xl">
                        <i class="fa-solid fa-play text-white text-xl"></i>
                    </div>
                </a>

                {{-- HERBÁRIO --}}
                <a href="#" class="relative h-64 bg-[#013321] group overflow-hidden rounded-2xl shadow-2xl shadow-emerald-900/20 border border-emerald-800/50">
                    <div class="absolute inset-0 opacity-10 flex items-center justify-end -mr-10 group-hover:scale-125 group-hover:-rotate-12 transition-all duration-1000">
                        <i class="fa-solid fa-leaf text-[240px] text-white"></i>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-950/80 to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <span class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.2em] mb-2 block">Ciência e Pesquisa</span>
                        <h4 class="text-4xl font-black text-white uppercase tracking-tighter leading-none">Herbário <br>Amapá</h4>
                    </div>
                    <div class="absolute top-8 right-8 h-14 w-14 flex items-center justify-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 group-hover:bg-emerald-500 group-hover:border-emerald-500 transition-all duration-500 shadow-xl">
                        <i class="fa-solid fa-magnifying-glass text-white text-xl"></i>
                    </div>
                </a>
            </div>
        </div>

        {{-- SEÇÃO 3: PROGRAMAS --}}
        <div>
            <div class="flex items-center gap-6 mb-12">
                <div class="flex flex-col">
                    <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-emerald-700 mb-1">Fomento</h2>
                    <h3 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tighter leading-none">Programas <span class="font-light text-slate-400">&</span> Bolsas</h3>
                </div>
                <div class="h-px flex-1 bg-gradient-to-r from-slate-200 via-slate-100 to-transparent"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-8 gap-y-10">
                @php
                    $programas = [
                        ['sigla' => 'PIBID', 'desc' => 'Iniciação à Docência'],
                        ['sigla' => 'PRP', 'desc' => 'Residência Pedagógica'],
                        ['sigla' => 'PROACE', 'desc' => 'Ações Comunitárias'],
                        ['sigla' => 'PROAPE', 'desc' => 'Apoio Pedagógico'],
                        ['sigla' => 'PROBICT', 'desc' => 'Bolsas de C&T'],
                        ['sigla' => 'PROMONITORIA', 'desc' => 'Monitoria Acadêmica'],
                        ['sigla' => 'PIBIC', 'desc' => 'Iniciação Científica'],
                        ['sigla' => 'PIBT', 'desc' => 'Inovação Tecnológica'],
                    ];
                @endphp

                @foreach ($programas as $p)
                <a href="#" class="group block border-t-2 border-slate-50 pt-5 hover:border-emerald-500 transition-all duration-500">
                    <h4 class="text-2xl font-black text-slate-900 tracking-tighter leading-none group-hover:text-emerald-600 transition-colors mb-2">
                        {{ $p['sigla'] }}
                    </h4>
                    <p class="text-[11px] text-slate-500 font-bold uppercase tracking-tight leading-snug group-hover:text-slate-900 transition-colors">
                        {{ $p['desc'] }}
                    </p>
                    <div class="mt-4 flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-500 -translate-x-2 group-hover:translate-x-0">
                        <span class="text-[9px] font-black uppercase text-emerald-600 tracking-widest">Acessar</span>
                        <i class="fa-solid fa-chevron-right text-[8px] text-emerald-600"></i>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</section>