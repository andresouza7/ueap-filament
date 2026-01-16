@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', fn($q) => $q->where('slug', 'principal'))
        ->orderBy('position')
        ->take(6)
        ->get();
@endphp

<style>
    [x-cloak] { display: none !important; }
    .no-scroll { overflow: hidden !important; }

    /* Dropdown de Alto Nível */
    .dropdown-ueap {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.25);
        border-radius: 0 0 8px 8px;
        border-top: 4px solid #002266;
    }

    /* Linha de progresso no hover */
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: #A4ED4A;
        transition: width 0.3s ease;
    }
    .nav-link:hover::after { width: 100%; }
</style>

<header x-data="{ mobileMenu: false, searchModal: false }" 
        @keydown.window.escape="mobileMenu = false; searchModal = false"
        x-effect="mobileMenu || searchModal ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')"
        class="relative w-full z-[100] bg-white antialiased">

    {{-- TOP BAR - O contraste que faltava (Cinza Profissional) --}}
    <section class="bg-gray-100 border-b border-slate-200 text-slate-500 text-[10px] font-bold uppercase tracking-[0.2em] py-2">
        <div class="max-w-[1440px] mx-auto px-6 lg:px-12 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-[#002266] rounded-full"></span>
                    Portal Institucional
                </span>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a href="#" class="hover:text-[#002266] transition-colors">Acesso à Informação</a>
                <a href="#" class="hover:text-[#002266] transition-colors font-black">SIGAA</a>
                <a href="#" class="hover:text-[#002266] transition-colors">Webmail</a>
            </nav>
        </div>
    </section>

    {{-- NAV PRINCIPAL --}}
    <nav class="bg-white border-b border-slate-200 h-20 lg:h-24 flex items-center">
        <div class="max-w-[1440px] mx-auto w-full px-6 lg:px-12 flex justify-between items-center">
            
            {{-- LOGO UNIFICADA --}}
            <a href="/" class="flex items-center gap-5 group">
                <img src="/img/site/logo.png" alt="UEAP" class="h-12 lg:h-16 w-auto">
                <div class="flex flex-col border-l-2 border-slate-200 pl-5">
                    <span class="text-3xl lg:text-4xl font-black text-[#002266] tracking-tighter leading-none">UEAP</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-1">Universidade do Estado do Amapá</span>
                </div>
            </a>

            {{-- MENU DESKTOP - Condensado e imponente --}}
            <ul class="hidden lg:flex items-center gap-2 h-full">
                @foreach ($menus as $menu)
                    <li class="relative group h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="nav-link relative px-4 py-2 text-[12px] font-black text-[#334155] uppercase tracking-[0.15em] hover:text-[#002266] transition-colors">
                            {{ $menu->name }}
                        </button>

                        @if ($menu->items->count())
                            <div x-show="open" x-cloak x-transition class="absolute left-0 top-full w-72 dropdown-ueap p-4 z-50">
                                <div class="grid gap-1">
                                    @foreach ($menu->items as $item)
                                        <a href="{{ $item->url }}" class="flex items-center gap-3 px-3 py-3 rounded hover:bg-slate-50 group/link">
                                            <span class="w-2 h-2 rounded-full border-2 border-slate-300 group-hover/link:bg-[#A4ED4A] group-hover/link:border-[#A4ED4A] transition-all"></span>
                                            <span class="text-[11px] font-black text-slate-500 group-hover/link:text-[#002266] uppercase tracking-widest">{{ $item->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>

            {{-- BOTÕES --}}
            <div class="flex items-center gap-4">
                <button @click="searchModal = true" class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-100 text-[#002266] hover:bg-[#002266] hover:text-white transition-all">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>
                <button @click="mobileMenu = true" class="lg:hidden w-12 h-12 flex items-center justify-center bg-[#002266] text-white rounded-lg">
                    <i class="fa-solid fa-bars-staggered text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    {{-- MODAL PESQUISA --}}
    <template x-teleport="body">
        <div x-show="searchModal" x-cloak class="fixed inset-0 z-[500] flex items-center justify-center p-6">
            <div class="absolute inset-0 bg-[#002266]/90 backdrop-blur-md" @click="searchModal = false"></div>
            <div class="w-full max-w-3xl relative z-10">
                <div class="flex justify-end mb-4">
                    <button @click="searchModal = false" class="text-white/50 hover:text-white text-4xl">&times;</button>
                </div>
                <form action="#" method="GET" class="relative">
                    <input type="text" placeholder="BUSCAR NO PORTAL..." autofocus
                           class="w-full bg-transparent border-b-4 border-white/20 focus:border-[#A4ED4A] px-0 py-6 text-3xl lg:text-5xl font-black text-white placeholder:text-white/20 outline-none transition-all">
                    <button class="absolute right-0 top-1/2 -translate-y-1/2 text-[#A4ED4A]">
                        <i class="fa-solid fa-arrow-right-long text-4xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </template>

    {{-- MENU MOBILE --}}
    <template x-teleport="body">
        <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[600] lg:hidden bg-[#002266] flex flex-col">
            <div class="p-8 flex justify-between items-center border-b border-white/10">
                <span class="text-4xl font-black text-white tracking-tighter">UEAP</span>
                <button @click="mobileMenu = false" class="text-white text-4xl">&times;</button>
            </div>
            <div class="flex-1 overflow-y-auto p-8">
                <nav class="space-y-6">
                    @foreach ($menus as $menu)
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex justify-between items-center text-left">
                                <span class="text-xl font-bold text-white uppercase tracking-widest" :class="open ? 'text-[#A4ED4A]' : ''">{{ $menu->name }}</span>
                                <i class="fa-solid fa-chevron-down text-[#A4ED4A] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-collapse class="mt-4 ml-4 space-y-4 border-l border-white/10 pl-4">
                                @foreach ($menu->items as $item)
                                    <a href="{{ $item->url }}" class="block text-white/70 font-bold text-sm tracking-widest hover:text-[#A4ED4A]">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </nav>
            </div>
        </div>
    </template>
</header>