@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', fn($q) => $q->where('slug', 'principal'))
        ->orderBy('position')
        ->get();
@endphp

<style>
    [x-cloak] { display: none !important; }
    .no-scroll { overflow: hidden !important; }

    /* Ajuste de Sombra para fundo escuro */
    .nav-ueap-shadow { box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.6); }

    /* SKEW DINÂMICO - Agora em tons escuros para integrar com o site */
    .header-skew-bg {
        position: absolute;
        top: 0;
        left: -10%;
        width: 85%;
        height: 100%;
        background: #0f172a; /* Slate 900 */
        transform: skewX(-12deg);
        border-right: 2px solid #10b981;
        z-index: 0;
    }
    @media (min-width: 1024px) {
        .header-skew-bg { 
            width: 35%;
            left: -5%;
            border-right: 1px solid rgba(255,255,255,0.05);
        }
    }

    /* DROPDOWN CYBER */
    .dropdown-cyber {
        background: rgba(6, 9, 15, 0.98);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(16, 185, 129, 0.3);
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 0 100%);
    }

    /* MODAL E MENU MOBILE */
    .cyber-panel {
        background: #020617; /* Slate 950 */
        border: 1px solid rgba(16, 185, 129, 0.3);
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 20px), calc(100% - 20px) 100%, 0 100%);
    }
</style>

<header x-data="{ mobileMenu: false, searchModal: false }"
    x-effect="mobileMenu || searchModal ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')"
    class="relative w-full bg-slate-950 font-sans border-b border-white/5">

    {{-- BARRA DE SISTEMAS --}}
    <div class="bg-black/50 text-slate-500 text-[9px] md:text-[10px] font-bold uppercase tracking-[0.2em] py-2 relative z-[80]">
        <div class="mx-auto px-4 lg:px-12 lg:max-w-ueap flex justify-between items-center">
            <span class="text-emerald-500/80 font-black animate-pulse uppercase">Ueap_Core_v4.0</span>
            <div class="flex gap-4">
                <a href="#" class="hover:text-emerald-400 transition-colors tracking-tighter">[ SIGAA ]</a>
                <a href="#" class="hover:text-emerald-400 transition-colors tracking-tighter">[ INTRANET ]</a>
            </div>
        </div>
    </div>

    {{-- LINHA SCANNER --}}
    <div class="h-[2px] bg-gradient-to-r from-emerald-600 via-emerald-400 to-blue-900 relative z-[70]"></div>

    {{-- NAV PRINCIPAL --}}
    <nav class="relative z-[60] bg-slate-950 nav-ueap-shadow">
        <div class="header-skew-bg"></div>

        <div class="mx-auto px-4 lg:px-12 lg:max-w-ueap relative z-10">
            <div class="flex justify-between items-center h-20 lg:h-24">
                
                {{-- LOGO + IDENTIDADE --}}
                <a href="/" class="flex items-center gap-2 shrink-0 group relative z-20">
                    <img src="/img/site/logo.png" alt="Logo" class="h-14 lg:h-16 w-auto object-contain brightness-110">
                    <div class="flex flex-col justify-center leading-[0.75]">
                        <span class="text-2xl lg:text-3xl font-[1000] text-white tracking-[-0.08em] uppercase italic">
                            UEAP<span class="text-emerald-500 not-italic animate-pulse">_</span>
                        </span>
                        <span class="text-[7px] lg:text-[8px] font-black text-slate-400 uppercase tracking-tighter mt-1 leading-none">
                            Universidade do Estado <br> do Amapá
                        </span>
                    </div>
                </a>

                {{-- MENU DESKTOP --}}
                <div class="hidden lg:flex h-full items-center ml-auto">
                    @foreach ($menus as $menu)
                        <div class="relative h-full group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="h-full px-3 flex items-center">
                                <span class="text-[11px] xl:text-[12px] font-[900] text-slate-300 group-hover:text-emerald-400 uppercase tracking-tight transition-colors">
                                    {{ $menu->name }}
                                </span>
                            </button>

                            @if($menu->items->count())
                                <div x-show="open" x-cloak 
                                    x-transition:enter="transition duration-150 ease-out"
                                    class="absolute left-0 top-[80%] w-[240px] dropdown-cyber shadow-2xl py-5 z-50">
                                    @foreach ($menu->items as $item)
                                        <a href="{{ $item->url }}" class="group/item flex items-center px-6 py-2 hover:bg-emerald-500/5 transition-all">
                                            <div class="flex flex-col border-l border-white/10 pl-3 py-1 group-hover/item:border-emerald-500">
                                                <span class="text-[11px] font-bold text-slate-300 uppercase group-hover/item:text-emerald-400 tracking-tight">{{ $item->name }}</span>
                                                <span class="text-[6px] text-slate-600 font-mono uppercase">link_point_{{ $loop->iteration }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- BOTÕES --}}
                <div class="flex items-center gap-3 ml-4">
                    <button @click="searchModal = true" class="w-10 h-10 border border-white/10 flex items-center justify-center hover:bg-emerald-500 hover:border-emerald-500 text-white transition-all">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>
                    <button @click="mobileMenu = true" class="lg:hidden w-10 h-10 bg-emerald-500 text-slate-950 flex items-center justify-center">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- MENU MOBILE COLAPSÁVEL CYBER --}}
    <div x-show="mobileMenu" x-cloak 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        class="fixed inset-0 z-[200] bg-slate-950 p-6 overflow-y-auto">
        
        <div class="flex justify-between items-center mb-10 border-b border-white/5 pb-4">
            <span class="text-emerald-500 font-black text-[10px] tracking-[0.3em] uppercase">// DATA_INDEX_MOBILE</span>
            <button @click="mobileMenu = false" class="text-white font-bold text-xl">[ X ]</button>
        </div>

        <div class="flex flex-col gap-4">
            @foreach ($menus as $menu)
                <div x-data="{ open: false }" class="border border-white/5 bg-slate-900/50 overflow-hidden">
                    <button @click="open = !open" class="w-full p-5 flex justify-between items-center text-left">
                        <span class="text-xl font-[1000] text-white uppercase italic tracking-tighter" :class="open ? 'text-emerald-500' : ''">
                            {{ $menu->name }}
                        </span>
                        <span class="text-emerald-500 font-mono" x-text="open ? '[-]' : '[+]'"></span>
                    </button>
                    
                    <div x-show="open" x-cloak x-collapse class="bg-black/40 border-t border-white/5">
                        <div class="flex flex-col py-4">
                            @foreach ($menu->items as $item)
                                <a href="{{ $item->url }}" class="px-8 py-3 text-[12px] font-bold text-slate-400 uppercase tracking-widest hover:text-emerald-400 border-l-2 border-transparent hover:border-emerald-500 transition-all">
                                    > {{ $item->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- MODAL PESQUISA --}}
    <div x-show="searchModal" x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/95 backdrop-blur-sm" @click="searchModal = false"></div>
        <div class="w-full max-w-2xl cyber-panel p-8 relative z-10 overflow-hidden">
            <div class="flex justify-between items-end mb-8 border-b border-white/10 pb-2">
                <h2 class="text-emerald-500 font-black text-[10px] tracking-widest uppercase">// QUERY_TERMINAL</h2>
                <button @click="searchModal = false" class="text-slate-500 text-[10px] font-bold">[ ESC_EXIT ]</button>
            </div>
            <input type="text" placeholder="BUSCAR..." class="w-full bg-transparent text-white text-4xl font-[1000] italic uppercase tracking-tighter focus:outline-none placeholder:text-slate-900">
        </div>
    </div>
</header>