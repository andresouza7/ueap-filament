<section class="py-12 bg-white">
    <div class="max-w-ueap mx-auto px-6 lg:px-10 font-sans">

        {{-- SEÇÃO 1: SERVIÇOS --}}
        <div class="mb-14">
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-900 whitespace-nowrap">Serviços Institucionais</h2>
                <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-gray-100 border border-gray-100">
                <a href="#" class="group flex items-center p-8 bg-white transition-all duration-300 hover:bg-gray-50">
                    <div class="flex-1">
                        <span class="text-[10px] font-bold text-[#017D49] uppercase tracking-widest mb-1 block">Acesso ao Usuário</span>
                        <h4 class="text-xl font-black text-gray-900 uppercase tracking-tighter">Carta de Serviços</h4>
                    </div>
                    <i class="fa-solid fa-arrow-right-long text-gray-200 group-hover:text-gray-900 group-hover:translate-x-2 transition-all"></i>
                </a>

                <a href="#" class="group flex items-center p-8 bg-white transition-all duration-300 hover:bg-gray-50">
                    <div class="flex-1">
                        <span class="text-[10px] font-bold text-[#017D49] uppercase tracking-widest mb-1 block">Canal de Escuta</span>
                        <h4 class="text-xl font-black text-gray-900 uppercase tracking-tighter">Ouvidoria @UVAP</h4>
                    </div>
                    <i class="fa-solid fa-arrow-right-long text-gray-200 group-hover:text-gray-900 group-hover:translate-x-2 transition-all"></i>
                </a>
            </div>
        </div>

        {{-- SEÇÃO 2: ACESSE (Cards de Impacto) --}}
        <div class="mb-14">
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-900 whitespace-nowrap">Plataformas</h2>
                <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- UEAP TV --}}
                <a href="#" class="relative h-48 bg-gray-900 overflow-hidden group">
                    <img src="placeholder-tv.jpg" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <span class="text-[10px] font-bold text-[#017D49] uppercase tracking-widest">Streaming</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">UEAP TV</h4>
                    </div>
                    <div class="absolute top-6 right-6 h-10 w-10 flex items-center justify-center border border-white/20 group-hover:bg-white group-hover:text-black transition-all">
                        <i class="fa-solid fa-play text-xs"></i>
                    </div>
                </a>

                {{-- HERBÁRIO --}}
                <a href="#" class="relative h-48 bg-[#017D49] group overflow-hidden border border-gray-100">
                    <div class="absolute inset-0 opacity-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-leaf text-[150px] text-white"></i>
                    </div>
                    <div class="absolute bottom-6 left-6">
                        <span class="text-[10px] font-bold text-green-200 uppercase tracking-widest">Ciência e Pesquisa</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Herbário Amapá</h4>
                    </div>
                    <div class="absolute top-6 right-6 h-10 w-10 flex items-center justify-center border border-white/20 group-hover:bg-white group-hover:text-[#017D49] transition-all">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </div>
                </a>
            </div>
        </div>

        {{-- SEÇÃO 3: PROGRAMAS (Grid Editorial Compacto) --}}
        <div>
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-900 whitespace-nowrap">Programas e Bolsas</h2>
                <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
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
                <a href="#" class="group block border-l border-gray-100 pl-4 py-2 hover:border-gray-900 transition-all">
                    <h4 class="text-lg font-black text-gray-900 tracking-tighter leading-none group-hover:text-[#017D49] transition-colors">
                        {{ $p['sigla'] }}
                    </h4>
                    <p class="text-[11px] text-gray-400 font-medium uppercase tracking-tight mt-1 leading-tight italic">
                        {{ $p['desc'] }}
                    </p>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</section>