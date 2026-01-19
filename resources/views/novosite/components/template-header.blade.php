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

    /* Dropdown Institucional */
    .dropdown-ueap {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-radius: 0 0 4px 4px;
        border-top: 3px solid var(--color-ueap-primary);
    }
</style>

<header x-data="{ mobileMenu: false, searchModal: false }" 
        @keydown.window.escape="mobileMenu = false; searchModal = false"
        x-effect="mobileMenu || searchModal ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')"
        class="relative w-full z-[100] bg-white antialiased shadow-sm">

    {{-- TOP BAR --}}
    <section class="bg-gray-50 border-b border-gray-200 text-slate-600 text-[11px] font-medium py-2">
        <div class="max-w-ueap mx-auto px-4 lg:px-8 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-ueap-primary rounded-full"></span>
                    Portal Institucional
                </span>
            </div>
            <nav class="hidden md:flex items-center gap-6">
                <a href="#" class="hover:text-ueap-primary transition-colors">Acesso à Informação</a>
                <a href="#" class="hover:text-ueap-primary transition-colors font-bold">SIGAA</a>
                <a href="#" class="hover:text-ueap-primary transition-colors">Webmail</a>
            </nav>
        </div>
    </section>

    {{-- NAV PRINCIPAL --}}
    <nav class="bg-white h-20 lg:h-24 flex items-center">
        <div class="max-w-ueap mx-auto w-full px-4 lg:px-8 flex justify-between items-center">
            
            {{-- LOGO --}}
            <a href="/" class="flex items-center gap-4 group">
                <img src="/img/site/logo.png" alt="UEAP" class="h-12 lg:h-14 w-auto">
                <div class="flex flex-col border-l border-gray-300 pl-4">
                    <span class="text-2xl lg:text-3xl font-bold text-ueap-primary tracking-tight leading-none">UEAP</span>
                    <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-1">Universidade do Estado do Amapá</span>
                </div>
            </a>

            {{-- MENU DESKTOP --}}
            <ul class="hidden lg:flex items-center gap-1 h-full">
                @foreach ($menus as $menu)
                    <li class="relative group h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="nav-link relative px-3 py-2 text-[13px] font-bold text-slate-700 uppercase tracking-wide hover:text-ueap-primary transition-colors flex items-center gap-1">
                            {{ $menu->name }}
                            @if ($menu->items->count())
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 group-hover:text-ueap-primary transition-colors"></i>
                            @endif
                        </button>

                        @if ($menu->items->count())
                            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 top-full w-64 dropdown-ueap py-2 z-50">
                                <div class="flex flex-col">
                                    @foreach ($menu->items as $item)
                                        <a href="{{ $item->url }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-gray-50 hover:text-ueap-primary transition-colors">
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>

            {{-- BOTÕES --}}
            <div class="flex items-center gap-3">
                <button @click="searchModal = true" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-ueap-primary hover:bg-ueap-primary hover:text-white transition-all" aria-label="Pesquisar">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </button>
                <button @click="mobileMenu = true" class="lg:hidden w-10 h-10 flex items-center justify-center bg-ueap-primary text-white rounded hover:bg-ueap-primary/90 transition-colors" aria-label="Menu">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </nav>

    {{-- MODAL PESQUISA --}}
    <template x-teleport="body">
        <div x-show="searchModal" x-cloak class="fixed inset-0 z-[500] flex items-center justify-center p-6">
            <div class="absolute inset-0 bg-ueap-primary/95 backdrop-blur-sm" @click="searchModal = false"></div>
            <div class="w-full max-w-3xl relative z-10">
                <div class="flex justify-end mb-4">
                    <button @click="searchModal = false" class="text-white/70 hover:text-white text-3xl transition-colors">&times;</button>
                </div>
                <form action="{{ route('site.post.list') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="O que você procura?" autofocus
                           class="w-full bg-transparent border-b-2 border-white/20 focus:border-ueap-secondary px-0 py-4 text-2xl lg:text-4xl font-bold text-white placeholder:text-white/30 outline-none transition-all">
                    <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 text-ueap-secondary hover:text-white transition-colors">
                        <i class="fa-solid fa-arrow-right text-2xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </template>

    {{-- MENU MOBILE --}}
    <template x-teleport="body">
        <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[600] lg:hidden bg-ueap-primary flex flex-col">
            <div class="p-6 flex justify-between items-center border-b border-white/10">
                <span class="text-2xl font-bold text-white tracking-tight">UEAP</span>
                <button @click="mobileMenu = false" class="text-white text-3xl">&times;</button>
            </div>
            <div class="flex-1 overflow-y-auto p-6">
                <nav class="space-y-4">
                    @foreach ($menus as $menu)
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex justify-between items-center text-left py-2">
                                <span class="text-lg font-bold text-white" :class="open ? 'text-ueap-secondary' : ''">{{ $menu->name }}</span>
                                <i class="fa-solid fa-chevron-down text-white/50 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="open" x-collapse class="mt-2 ml-4 space-y-2 border-l border-white/10 pl-4">
                                @foreach ($menu->items as $item)
                                    <a href="{{ $item->url }}" class="block text-white/80 text-sm py-1 hover:text-ueap-secondary transition-colors">
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