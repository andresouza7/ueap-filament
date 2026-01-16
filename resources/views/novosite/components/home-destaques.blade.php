{{-- Container Pai - Destaque Cinematográfico + Menu Institucional --}}
<div class="w-full relative overflow-hidden bg-[#001a4d]">

    {{-- Camada 01: Background SVG sutil --}}
    <div class="absolute inset-0 z-0 opacity-[0.2] pointer-events-none bg-repeat"
        style="background-image: url('/img/site/hero-bg.svg'); background-size: contain; background-position: -170%;"
        aria-hidden="true">
    </div>

    {{-- Camada 02: Gradiente de transição --}}
    <div class="hidden lg:block absolute inset-0 z-10 bg-gradient-to-b from-[#001a4d] via-transparent to-[#001a4d]/60"
        aria-hidden="true"></div>

    <section class="w-full relative z-30 py-10 lg:py-16" aria-label="Destaques Institucionais">
        <div class="w-full lg:max-w-[1440px] lg:mx-auto lg:px-12">

            {{-- O segredo está no 'items-stretch' para forçar a mesma altura em ambas as colunas --}}
            <div class="grid grid-cols-12 gap-6 lg:gap-10 items-stretch">

                {{-- COLUNA DA ESQUERDA: NOTÍCIA CINEMATOGRÁFICA --}}
                @if (isset($featured[0]))
                    <article class="col-span-12 lg:col-span-8 px-4 lg:px-0 flex">
                        <a href="{{ route('site.post.show', $featured[0]->slug) }}"
                            class="relative group w-full h-[500px] lg:h-[620px] flex flex-col overflow-hidden rounded-[45px] lg:rounded-[60px] shadow-[0_35px_70px_-15px_rgba(0,0,0,0.8)] transition-all border border-white/10">

                            <div class="absolute inset-0 bg-[#001133]">
                                <img src="{{ $featured[0]->image_url }}" alt="{{ $featured[0]->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-all duration-[2.5s] opacity-90 group-hover:opacity-100">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#001133] via-[#001133]/20 to-transparent opacity-90">
                                </div>
                            </div>

                            <div class="absolute top-10 left-10 z-20">
                                <span
                                    class="bg-[#A4ED4A] text-[#001a4d] text-[11px] font-[1000] px-6 py-2 rounded-full uppercase tracking-[0.25em] shadow-2xl">
                                    {{ $featured[0]->category->name ?? 'Destaque' }}
                                </span>
                            </div>

                            <div class="relative mt-auto p-10 lg:p-16">
                                <h2
                                    class="text-white text-4xl lg:text-6xl font-[1000] leading-[0.9] tracking-tighter mb-10 group-hover:text-[#A4ED4A] transition-colors duration-500">
                                    {{ $featured[0]->title }}
                                </h2>
                                <div class="flex items-center gap-5">
                                    <div
                                        class="w-16 h-16 rounded-full bg-white text-[#001a4d] flex items-center justify-center group-hover:bg-[#A4ED4A] transition-all transform group-hover:rotate-[-45deg] shadow-2xl">
                                        <i class="fa-solid fa-arrow-right text-xl"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-white font-black text-[11px] uppercase tracking-[0.4em]">Continuar
                                            Lendo</span>
                                        <div
                                            class="h-[2px] w-0 bg-[#A4ED4A] group-hover:w-full transition-all duration-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endif

                {{-- COLUNA DA DIREITA: SINCRONIA TOTAL DE ALTURA --}}
                <aside class="col-span-12 lg:col-span-4 px-4 lg:px-0 flex flex-col">
                    <div
                        class="flex flex-col flex-1 w-full bg-white rounded-[45px] lg:rounded-[60px] shadow-[0_40px_80px_-15px_rgba(0,0,0,0.2)] border border-slate-200 overflow-hidden relative">

                        {{-- Header: Altura Fixa Controlada --}}
                        <div
                            class="bg-gradient-to-br from-[#f8fafc] to-[#f1f5f9] px-8 py-8 lg:px-10 border-b border-slate-200 relative flex-shrink-0">
                            <div class="flex items-center gap-3 mb-3">
                                <span
                                    class="px-2 py-0.5 bg-[#001a4d] text-[#A4ED4A] text-[8px] font-black uppercase tracking-[0.3em] rounded-sm shadow-sm">Oficial</span>
                                <span class="text-[#001a4d]/40 font-bold text-[9px] uppercase tracking-[0.2em]">Serviços
                                    Digitais</span>
                            </div>
                            <h3 class="text-[#001a4d] text-3xl lg:text-4xl font-black tracking-tight leading-[0.85]">
                                Canais de<br>Acesso<span class="text-[#A4ED4A]">.</span>
                            </h3>
                            <i
                                class="fa-solid fa-shield-halved absolute top-1/2 -translate-y-1/2 right-10 text-slate-200/40 text-3xl pointer-events-none"></i>
                        </div>

                        {{-- Lista de Links: O 'flex-1' aqui estica a lista para bater com a altura do card da esquerda --}}
                        <nav class="flex flex-col flex-1 divide-y divide-slate-100 bg-white min-h-0">
                            @php
                                $links = [
                                    [
                                        'icon' => 'fa-calendar-days',
                                        'label' => 'Calendário Acadêmico',
                                        'desc' => 'Datas e prazos do semestre',
                                    ],
                                    [
                                        'icon' => 'fa-scale-balanced',
                                        'label' => 'Legislação e Atos',
                                        'desc' => 'Base jurídica institucional',
                                    ],
                                    [
                                        'icon' => 'fa-file-lines',
                                        'label' => 'Instruções Normativas',
                                        'desc' => 'Regramentos e procedimentos',
                                    ],
                                    [
                                        'icon' => 'fa-gavel',
                                        'label' => 'Conselho Superior',
                                        'desc' => 'Resoluções e atas CONSU',
                                    ],
                                    [
                                        'icon' => 'fa-handshake',
                                        'label' => 'Licitações e Contratos',
                                        'desc' => 'Transparência e compras',
                                    ],
                                    [
                                        'icon' => 'fa-user-tie',
                                        'label' => 'Processos Seletivos',
                                        'desc' => 'Concursos e seletivos',
                                    ],
                                ];
                            @endphp

                            @foreach ($links as $link)
                                {{-- O 'flex-1' em cada <a> garante que todos cresçam na mesma proporção --}}
                                <a href="#"
                                    class="group flex flex-1 items-center px-8 lg:px-10 hover:bg-[#001a4d] transition-all duration-300">
                                    <div
                                        class="w-11 h-11 flex-shrink-0 flex items-center justify-center rounded-2xl bg-slate-50 group-hover:bg-white/10 transition-all">
                                        <i
                                            class="fa-solid {{ $link['icon'] }} text-[#001a4d] text-lg group-hover:text-[#A4ED4A]"></i>
                                    </div>

                                    <div class="flex flex-col ml-5">
                                        <span
                                            class="text-[12px] lg:text-[13px] font-black text-[#001a4d] group-hover:text-white uppercase tracking-tight leading-none mb-1">
                                            {{ $link['label'] }}
                                        </span>
                                        <span
                                            class="text-[9px] lg:text-[10px] text-slate-400 group-hover:text-white/40 font-medium uppercase tracking-wider">
                                            {{ $link['desc'] }}
                                        </span>
                                    </div>

                                    <div
                                        class="ml-auto transform translate-x-2 opacity-0 group-hover:opacity-100 group-hover:translate-x-0 transition-all">
                                        <i class="fa-solid fa-chevron-right text-[#A4ED4A] text-xs"></i>
                                    </div>
                                </a>
                            @endforeach
                        </nav>

                        {{-- Footer: Altura Fixa Controlada --}}
                        <div
                            class="px-8 py-5 lg:px-10 bg-[#f8fafc] border-t border-slate-100 flex items-center justify-between flex-shrink-0">
                            <div class="flex flex-col justify-center">
                                <span
                                    class="text-[#001a4d] text-[10px] font-black uppercase tracking-[0.2em] leading-none mb-1.5">Portal
                                    UEAP</span>
                                <div class="flex items-center gap-2">
                                    <div class="relative flex h-2 w-2">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#A4ED4A] opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#A4ED4A]"></span>
                                    </div>
                                    <span class="text-slate-400 text-[9px] uppercase font-bold tracking-tighter">Acesso
                                        à Informação</span>
                                </div>
                            </div>

                            <div
                                class="w-9 h-9 rounded-full border border-slate-200 flex items-center justify-center bg-white shadow-sm">
                                <i class="fa-solid fa-universal-access text-slate-400 text-base"></i>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>
</div>
