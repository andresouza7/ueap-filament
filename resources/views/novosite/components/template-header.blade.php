@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', fn($q) => $q->where('slug', 'principal'))
        ->orderBy('position')
        ->get();
@endphp

<style>
    [x-cloak] {
        display: none !important;
    }

    .no-scroll {
        overflow: hidden !important;
    }

    /* Ajuste de Sombra para fundo escuro */
    .nav-ueap-shadow {
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.6);
    }

    /* FADE DINÂMICO (SUBSTITUINDO O CORTE SECO) */
    .header-skew-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 85%;
        height: 100%;
        background: #0f172a;
        z-index: 0;
        pointer-events: none;
        -webkit-mask-image: linear-gradient(to right, black 60%, transparent 90%);
        mask-image: linear-gradient(to right, black 60%, transparent 90%);
    }

    @media (min-width: 1024px) {
        .header-skew-bg {
            -webkit-mask-image: linear-gradient(to right, black 20%, transparent 35%);
            mask-image: linear-gradient(to right, black 20%, transparent 35%);
            transform: none;
        }
    }

    /* DROPDOWN CYBER */
    .dropdown-cyber {
        background: rgba(6, 9, 15, 0.98);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(16, 185, 129, 0.3);
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 0 100%);
    }

    /* O MODAL DE BUSCA (TERMINAL) */
    .cyber-panel {
        background: rgba(6, 9, 15, 0.98);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(16, 185, 129, 0.3);
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 20px), calc(100% - 20px) 100%, 0 100%);
    }

    /* Linha de Scan animada do Modal (Corrigida: Vertical) */
    .input-scan {
        background: linear-gradient(to right, transparent, rgba(16, 185, 129, 0.5), transparent);
        height: 2px;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 20;
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.3);
        animation: scan-vertical 3s ease-in-out infinite;
    }

    @keyframes scan-vertical {

        0%,
        100% {
            top: 0%;
            opacity: 0;
        }

        5%,
        95% {
            opacity: 1;
        }

        50% {
            top: 100%;
        }
    }
</style>

<header x-data="{ mobileMenu: false, searchModal: false }" @keydown.window.escape="mobileMenu = false; searchModal = false"
    x-effect="mobileMenu || searchModal ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')"
    class="relative w-full bg-slate-950 font-sans border-b border-white/5">

    {{-- BARRA DE SISTEMAS --}}
    <section aria-label="Links institucionais"
        class="bg-black/50 text-slate-500 text-[9px] md:text-[10px] font-bold uppercase tracking-[0.2em] py-2 relative z-[80]">
        <div class="mx-auto px-4 lg:px-12 lg:max-w-ueap flex justify-between items-center">
            <span class="text-emerald-500/80 font-black animate-pulse uppercase" aria-hidden="true">Site_UEAP_v2.0</span>
            <nav class="flex gap-2 md:gap-4">
                <a href="https://sigaa.ueap.edu.br/sigaa/"
                    class="hover:text-emerald-400 transition-colors tracking-tighter">SIGAA</a>
                <a href="http://intranet.ueap.edu.br/"
                    class="hover:text-emerald-400 transition-colors tracking-tighter">INTRANET</a>
                <a href="http://transparencia.ueap.edu.br/"
                    class="hover:text-emerald-400 transition-colors tracking-tighter">TRANSPARÊNCIA</a>
                <a href="https://servicedesk.ueap.edu.br/"
                    class="hover:text-emerald-400 transition-colors tracking-tighter">SERVICE DESK</a>
            </nav>
        </div>
    </section>

    <div class="h-[2px] bg-gradient-to-r from-emerald-600 via-emerald-400 to-blue-900 relative z-[70]"
        aria-hidden="true"></div>

    {{-- NAV PRINCIPAL --}}
    <nav class="relative z-[60] bg-slate-950 nav-ueap-shadow" aria-label="Menu Principal">
        <div class="header-skew-bg" aria-hidden="true"></div>

        <div class="mx-auto px-4 lg:px-12 lg:max-w-ueap relative z-10">
            <div class="flex justify-between items-center h-20 lg:h-24">

                {{-- LOGO --}}
                <a href="/"
                    class="flex items-center gap-1 shrink-0 group relative z-20 transition-all duration-300"
                    aria-label="Ir para a página inicial">
                    <img src="/img/site/logo.png" alt="Logotipo UEAP"
                        class="h-14 lg:h-[4.4rem] w-auto object-contain brightness-110 drop-shadow-[0_0_15px_rgba(16,185,129,0.15)] group-hover:scale-105 transition-transform">
                    <div class="flex flex-col justify-between h-14 lg:h-[4.2rem] py-0.5" aria-hidden="true">
                        <span
                            class="text-2xl lg:text-[2.6rem] font-[1000] text-white tracking-[-0.08em] uppercase italic leading-[0.8] mb-1.5">
                            UEAP<span class="text-emerald-500 not-italic">_</span>
                        </span>
                        <span
                            class="text-[7.5px] lg:text-[8px] font-black text-slate-400 uppercase tracking-wider leading-[1.2] border-t border-white/10 pt-1.5">
                            Universidade do Estado <br>
                            <span class="text-slate-200">do Amapá</span>
                        </span>
                    </div>
                </a>

                {{-- MENU DESKTOP --}}
                <ul class="hidden lg:flex h-full items-center ml-auto">
                    @foreach ($menus as $menu)
                        <li class="relative h-full group" x-data="{ open: false }" @mouseenter="open = true"
                            @mouseleave="open = false" @focusin="open = true" @focusout="open = false">

                            <button type="button" class="h-full px-3 flex items-center" :aria-expanded="open"
                                aria-haspopup="true">
                                <span
                                    class="text-[11px] xl:text-[12px] font-[900] text-slate-300 group-hover:text-emerald-400 uppercase tracking-tight transition-colors">
                                    {{ $menu->name }}
                                </span>
                            </button>

                            @if ($menu->items->count())
                                <ul x-show="open" x-cloak x-transition
                                    class="absolute left-0 top-[80%] w-[240px] dropdown-cyber shadow-2xl py-5 z-50">
                                    @foreach ($menu->items as $item)
                                        <li>
                                            <a href="{{ $item->url }}"
                                                class="group/item flex items-center px-6 py-2 hover:bg-emerald-500/5 transition-all">
                                                <div
                                                    class="flex flex-col border-l border-white/10 pl-3 py-1 group-hover/item:border-emerald-500">
                                                    <span
                                                        class="text-[11px] font-bold text-slate-300 uppercase tracking-tight">{{ $item->name }}</span>
                                                    <span class="text-[6px] text-slate-600 font-mono"
                                                        aria-hidden="true">link_point_{{ $loop->iteration }}</span>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>

                {{-- BOTÕES --}}
                <div class="flex items-center gap-3 ml-4">
                    <button @click="searchModal = true" aria-label="Abrir busca"
                        class="w-10 h-10 border border-white/10 flex items-center justify-center hover:bg-emerald-500 hover:border-emerald-500 text-white transition-all">
                        <i class="fa-solid fa-magnifying-glass text-sm" aria-hidden="true"></i>
                    </button>
                    <button @click="mobileMenu = true" aria-label="Abrir menu de navegação" aria-expanded="false"
                        :aria-expanded="mobileMenu.toString()"
                        class="lg:hidden w-10 h-10 bg-emerald-500 text-slate-950 flex items-center justify-center">
                        <i class="fa-solid fa-bars text-lg" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- MENU MOBILE --}}
    <div x-show="mobileMenu" x-cloak role="dialog" aria-modal="true" aria-label="Menu Mobile"
        class="fixed inset-0 z-[200] bg-slate-950 p-4 overflow-y-auto">

        <div class="flex justify-between items-center mb-6 border-b border-white/10 pb-3">
            <span class="text-emerald-500 font-black text-[10px] tracking-[0.3em] uppercase" aria-hidden="true">//
                NAV_CORE_SYSTEM</span>
            <button @click="mobileMenu = false"
                class="text-white font-mono text-xs border border-white/20 px-2 py-1 hover:bg-white hover:text-black transition-all">
                [ FECHAR ]
            </button>
        </div>

        <div class="flex flex-col gap-2">
            @foreach ($menus as $menu)
                <div x-data="{ open: false }" class="border border-white/5 bg-slate-900/40">
                    <button @click="open = !open" :aria-expanded="open"
                        class="w-full py-3 px-4 flex justify-between items-center text-left transition-colors">
                        <span class="text-sm font-black text-white uppercase italic tracking-tight"
                            :class="open ? 'text-emerald-400' : ''">
                            {{ $menu->name }}
                        </span>
                        <span class="text-emerald-500 font-mono text-xs" x-text="open ? '[-]' : '[+]'"
                            aria-hidden="true"></span>
                    </button>

                    <div x-show="open" x-collapse>
                        <ul class="flex flex-col p-1.5 gap-1">
                            @foreach ($menu->items as $item)
                                <li>
                                    <a href="{{ $item->url }}"
                                        class="group flex items-center justify-between px-3 py-2 text-[11px] font-bold text-slate-400 uppercase transition-all hover:bg-emerald-500 hover:text-black">
                                        <span><span aria-hidden="true">_ </span>{{ $item->name }}</span>
                                        <span class="text-[9px] opacity-0 group-hover:opacity-100 font-mono font-normal"
                                            aria-hidden="true">RUN_FILE ></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- MODAL PESQUISA --}}
    <div x-show="searchModal" x-cloak role="dialog" aria-modal="true" aria-labelledby="search-title"
        class="fixed inset-0 z-[200] flex items-center justify-center p-4">

        <div class="absolute inset-0 bg-slate-950/95 backdrop-blur-md" @click="searchModal = false"></div>

        <div class="w-full max-w-2xl cyber-panel p-6 md:p-10 relative z-10 overflow-hidden">
            <div class="input-scan" aria-hidden="true"></div>

            <div class="flex justify-between items-end mb-6 md:mb-10">
                <h2 id="search-title"
                    class="text-emerald-500 font-black text-[10px] md:text-xs tracking-[0.4em] uppercase">
                    // BUSCA_GLOBAL_SISTEMA
                </h2>
                <button @click="searchModal = false"
                    class="text-slate-500 hover:text-white text-[9px] md:text-[10px] font-bold">[ ESC_FECHAR ]</button>
            </div>

            <form action="{{ route('site.post.list') }}" method="GET" class="relative">
                <label for="site-search" class="sr-only">Digite sua busca</label>
                <input type="text" id="site-search" name="search" placeholder="DIGITE SUA BUSCA..."
                    autocomplete="off"
                    class="w-full bg-transparent text-white border-b-2 border-emerald-500/20 text-xl md:text-3xl font-black italic uppercase py-4 md:py-6 focus:outline-none focus:border-emerald-500 placeholder:text-slate-800">

                <div class="mt-4 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex gap-4 text-[8px] text-slate-600 font-mono italic" aria-hidden="true">
                        <span>QUERY_STATUS: WAITING</span>
                        <span>ENCRYPTION: AES-256</span>
                    </div>
                    <button type="submit"
                        class="text-emerald-500 font-black text-[10px] hover:text-white transition-colors tracking-widest uppercase">
                        [ EXECUTAR_QUERY ]
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>
