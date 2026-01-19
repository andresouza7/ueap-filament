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
</style>

<header x-data="{ mobileMenu: false, searchModal: false }" 
        @keydown.window.escape="mobileMenu = false; searchModal = false"
        x-effect="mobileMenu || searchModal ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')"
        class="bg-white border-b border-gray-200 sticky top-0 z-50">

    {{-- TOP BAR (Government Utility Bar) --}}
    <div class="bg-gray-50 border-b border-gray-100 text-xs">
        <div class="max-w-ueap mx-auto px-4 lg:px-8 h-10 flex justify-between items-center">
            <div class="flex items-center gap-4 text-slate-500 font-medium">
                <span class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-ueap-primary"></span>
                    Portal Institucional
                </span>
            </div>
            <nav class="hidden md:flex items-center gap-6 font-semibold text-slate-600">
                <a href="#" class="hover:text-ueap-primary transition-colors">Acesso à Informação</a>
                <a href="#" class="hover:text-ueap-primary transition-colors">SIGAA</a>
                <a href="#" class="hover:text-ueap-primary transition-colors">Webmail</a>
                <button @click="searchModal = true" class="flex items-center gap-2 hover:text-ueap-primary transition-colors ml-4 pl-4 border-l border-gray-200">
                    <i class="fa-solid fa-search"></i>
                    Buscar
                </button>
            </nav>
        </div>
    </div>

    {{-- MAIN HEADER --}}
    <div class="max-w-ueap mx-auto px-4 lg:px-8 h-20 lg:h-24 flex items-center justify-between">

        {{-- LOGO --}}
        <a href="/" class="flex items-center gap-4 group">
            <img src="/img/site/logo.png" alt="UEAP" class="h-12 lg:h-14 w-auto">
            <div class="hidden sm:flex flex-col border-l border-gray-300 pl-4">
                <span class="text-xl lg:text-2xl font-bold text-ueap-primary tracking-tight leading-none">UEAP</span>
                <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-0.5">Universidade do Estado do Amapá</span>
            </div>
        </a>

        {{-- DESKTOP NAV --}}
        <nav class="hidden lg:block h-full">
            <ul class="flex items-center gap-1 h-full">
                @foreach ($menus as $menu)
                    <li class="relative group h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="px-4 py-2 text-sm font-semibold text-slate-700 hover:text-ueap-primary transition-colors flex items-center gap-1.5 h-full border-b-2 border-transparent hover:border-ueap-primary">
                            {{ $menu->name }}
                            @if ($menu->items->count())
                                <i class="fa-solid fa-chevron-down text-[10px] opacity-50"></i>
                            @endif
                        </button>

                        @if ($menu->items->count())
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-2"
                                 class="absolute left-0 top-full w-64 bg-white shadow-xl border border-gray-100 rounded-b-lg overflow-hidden py-2">
                                @foreach ($menu->items as $item)
                                    <a href="{{ $item->url }}" class="block px-6 py-2.5 text-sm text-slate-600 hover:bg-gray-50 hover:text-ueap-primary font-medium transition-colors">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- MOBILE TOGGLE --}}
        <button @click="mobileMenu = true" class="lg:hidden w-10 h-10 flex items-center justify-center text-ueap-primary rounded hover:bg-gray-50 transition-colors">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>
    </div>

    {{-- SEARCH MODAL --}}
    <template x-teleport="body">
        <div x-show="searchModal" x-cloak class="fixed inset-0 z-[500] flex items-start justify-center pt-24 px-4">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" @click="searchModal = false"></div>
            <div class="w-full max-w-2xl bg-white rounded-xl shadow-2xl relative z-10 overflow-hidden" @click.outside="searchModal = false">
                <form action="{{ route('site.post.list') }}" method="GET" class="relative flex items-center p-4">
                    <i class="fa-solid fa-search text-slate-400 text-xl ml-4"></i>
                    <input type="text" name="search" placeholder="O que você procura?" autofocus
                           class="w-full bg-transparent border-none focus:ring-0 text-lg text-slate-800 placeholder-slate-400 px-4 py-2 h-14">
                    <button type="button" @click="searchModal = false" class="text-slate-400 hover:text-slate-600 px-4">
                        <span class="text-xs font-bold uppercase border border-slate-200 rounded px-2 py-1">ESC</span>
                    </button>
                </form>
            </div>
        </div>
    </template>

    {{-- MOBILE MENU --}}
    <template x-teleport="body">
        <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[600] lg:hidden">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" @click="mobileMenu = false"></div>
            <div class="absolute right-0 top-0 bottom-0 w-80 bg-white shadow-2xl flex flex-col transform transition-transform duration-300"
                 x-show="mobileMenu"
                 x-transition:enter="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="translate-x-0"
                 x-transition:leave-end="translate-x-full">

                <div class="p-6 flex justify-between items-center border-b border-gray-100">
                    <span class="text-xl font-bold text-ueap-primary">Menu</span>
                    <button @click="mobileMenu = false" class="text-slate-400 hover:text-slate-600">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6">
                    <nav class="space-y-6">
                        @foreach ($menus as $menu)
                            <div x-data="{ open: false }">
                                <button @click="open = !open" class="w-full flex justify-between items-center text-left py-1 text-slate-800 font-bold text-lg">
                                    {{ $menu->name }}
                                    <i class="fa-solid fa-chevron-down text-sm text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                <div x-show="open" x-collapse class="mt-3 ml-2 space-y-3 pl-4 border-l-2 border-gray-100">
                                    @foreach ($menu->items as $item)
                                        <a href="{{ $item->url }}" class="block text-slate-600 font-medium hover:text-ueap-primary">
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="pt-6 border-t border-gray-100 space-y-4">
                            <a href="#" class="block text-slate-600 font-medium">Acesso à Informação</a>
                            <a href="#" class="block text-slate-600 font-medium">SIGAA</a>
                            <a href="#" class="block text-slate-600 font-medium">Webmail</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </template>
</header>
