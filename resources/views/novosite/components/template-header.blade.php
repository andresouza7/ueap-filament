<style>
    [x-cloak] {
        display: none !important;
    }

    .no-scroll {
        overflow: hidden !important;
    }


    /* Efeito de linha suave no hover do desktop */
    .nav-link-effect::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: #10b981;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .group:hover .nav-link-effect::after {
        width: 100%;
    }
</style>

@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', fn($q) => $q->where('slug', 'principal'))
        ->orderBy('position')
        ->get();
@endphp

<header x-data="{ mobileMenu: false, searchModal: false }"
    x-effect="mobileMenu || searchModal ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')">

    <div
        class="bg-slate-950 text-slate-400 text-[9px] md:text-[10px] font-bold uppercase tracking-[0.1em] py-2.5 border-b border-white/5 relative z-[70]">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="hidden md:flex gap-4 items-center">
                <span class="flex items-center gap-2 text-emerald-500/90 drop-shadow-[0_0_8px_rgba(16,185,129,0.3)]">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Portal da Transparência
                </span>
            </div>
            <div class="flex space-x-4 sm:space-x-6 w-full md:w-auto justify-end antialiased">
                <a href="https://sigaa.ueap.edu.br/sigaa"
                    class="hover:text-emerald-400 transition-colors duration-300">SIGAA</a>
                <a href="https://intranet.ueap.edu.br"
                    class="hover:text-emerald-400 transition-colors duration-300">Intranet</a>
                <a href="https://transparencia.ueap.edu.br"
                    class="hover:text-emerald-400 transition-colors duration-300">Transparência</a>
                <a href="https://servicedesk.ueap.edu.br"
                    class="hover:text-white transition-colors duration-300">Service Desk</a>
            </div>
        </div>
    </div>

    <div class="h-[3px] bg-gradient-to-r from-emerald-500 via-yellow-500 to-blue-800 relative z-[70]"></div>

    <nav class="bg-white relative z-[60] shadow-[0_4px_20px_-5px_rgba(0,0,0,0.1)]">
        <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 bg-white relative z-[61]">
            <div class="flex justify-between h-15 md:h-20 items-center">

                <a href="/" class="block group">
                    <div class="flex items-center gap-0">
                        <img src="/img/site/logo.png" alt="Logo UEAP"
                            class="h-12 md:h-14 lg:h-16 w-auto object-contain transition-transform duration-500 group-hover:scale-105">

                        <div class="flex flex-col justify-center leading-none -ml-0.5 -mt-1">
                            <span
                                class="text-xl md:text-2xl lg:text-3xl font-black text-emerald-600 tracking-tighter uppercase antialiased">
                                UEAP
                            </span>

                            <span
                                class="-mt-1 md:mt-0 text-[0.45rem] md:text-[0.55rem] lg:text-[0.6rem] text-slate-500 uppercase tracking-[0.12em] font-bold leading-[1.1]">
                                Universidade do <br> Estado do Amapá
                            </span>
                        </div>
                    </div>
                </a>

                <nav class="hidden lg:flex items-center h-full">
                    @foreach ($menus as $menu)
                        @php $items = $menu->items()->whereNull('menu_parent_id')->where('status', 'published')->orderBy('position')->get(); @endphp
                        @if ($items->count())
                            <div class="relative h-full group" x-data="{ open: false }" @mouseenter="open = true"
                                @mouseleave="open = false">
                                <button
                                    class="nav-link-effect relative flex items-center gap-1.5 h-full px-5 text-slate-700 group-hover:text-emerald-600 font-bold transition-all duration-300 text-[11px] uppercase tracking-wider">
                                    <span>{{ $menu->name }}</span>
                                    <i class="fa-solid fa-chevron-down text-[7px] opacity-40 transition-transform duration-300"
                                        :class="open ? 'rotate-180 opacity-100' : ''"></i>
                                </button>

                                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="absolute left-0 top-full bg-white shadow-[0_20px_40px_rgba(0,0,0,0.12)] border-x border-b border-slate-100 w-max min-w-[260px] py-1 z-[50]">
                                    @foreach ($items as $item)
                                        <a href="{{ $item->url ?? '#' }}"
                                            class="group/item flex items-center justify-between px-6 py-4 text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 text-[12px] font-bold border-b border-slate-50 last:border-none transition-all duration-200">
                                            <span>{{ $item->name }}</span>
                                            <i
                                                class="fa-solid fa-arrow-right text-[10px] opacity-0 -translate-x-2 group-hover/item:opacity-100 group-hover/item:translate-x-0 transition-all"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </nav>

                <div class="flex items-center gap-1 md:gap-3">
                    <button @click="searchModal = true"
                        class="w-10 h-10 flex items-center justify-center rounded-full text-slate-600 hover:bg-slate-100 hover:text-emerald-600 transition-all duration-300 focus:outline-none">
                        <i class="fa-solid fa-magnifying-glass text-lg"></i>
                    </button>

                    <button @click="mobileMenu = !mobileMenu"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full text-slate-600 hover:bg-slate-100 focus:outline-none transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenu" x-cloak stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenu" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
            class="lg:hidden bg-white fixed inset-x-0 bottom-0 top-[116px] overflow-y-auto menu-scroll z-[59]">

            <div class="px-5 py-8 space-y-4 pb-32">
                <div class="flex items-center gap-3 px-2 mb-6">
                    <div class="h-[1px] flex-1 bg-slate-100"></div>
                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.25em]">Menu Principal</p>
                    <div class="h-[1px] flex-1 bg-slate-100"></div>
                </div>

                @foreach ($menus as $menu)
                    <div x-data="{ subOpen: false }" class="transition-all duration-300">

                        <button @click="subOpen = !subOpen"
                            class="w-full flex justify-between items-center p-4 rounded-2xl transition-all duration-300"
                            :class="subOpen ? 'bg-slate-50' : 'bg-transparent'">

                            <span class="text-[13px] font-bold tracking-wide transition-colors duration-300"
                                :class="subOpen ? 'text-emerald-600' : 'text-slate-700'">
                                {{ $menu->name }}
                            </span>

                            <i class="fa-solid fa-chevron-right text-[10px] transition-transform duration-300"
                                :class="subOpen ? 'rotate-90 text-emerald-500' : 'text-slate-300'"></i>
                        </button>

                        <div x-show="subOpen" x-cloak x-collapse>
                            <div class="mt-1 ml-4 border-l-2 border-emerald-500/10 pl-2 pr-2 pb-4 space-y-1">
                                @foreach ($menu->items()->whereNull('menu_parent_id')->where('status', 'published')->orderBy('position')->get() as $item)
                                    <a href="{{ $item->url ?? '#' }}"
                                        class="flex items-center px-4 py-3.5 text-[14px] font-medium text-slate-600 active:text-emerald-600 active:bg-emerald-50/50 rounded-xl transition-all">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-10 grid grid-cols-2 gap-4 px-2">
                    <a href="https://sigaa.ueap.edu.br"
                        class="flex flex-col items-center justify-center p-5 rounded-2xl bg-slate-50 group active:scale-95 transition-all">
                        <i class="fa-solid fa-graduation-cap text-slate-400 mb-2 group-active:text-emerald-500"></i>
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">SIGAA</span>
                    </a>
                    <a href="https://servicedesk.ueap.edu.br"
                        class="flex flex-col items-center justify-center p-5 rounded-2xl bg-slate-50 group active:scale-95 transition-all">
                        <i class="fa-solid fa-headset text-slate-400 mb-2 group-active:text-emerald-500"></i>
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Suporte</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div x-show="searchModal" x-cloak
        class="fixed inset-0 z-[100] flex items-start justify-center pt-24 md:pt-32 px-6 bg-slate-950/98 backdrop-blur-md"
        x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" @keydown.escape.window="searchModal = false">

        <div class="w-full max-w-4xl" @click.away="searchModal = false">
            <div class="flex justify-between items-center mb-8">
                <span class="text-emerald-500 font-black tracking-widest uppercase text-xs">Busca Institucional</span>
                <button @click="searchModal = false"
                    class="group flex items-center gap-2 text-white/40 hover:text-white transition-all text-[10px] font-bold tracking-tighter">
                    FECHAR (ESC) <div
                        class="w-8 h-8 flex items-center justify-center rounded-full border border-white/10 group-hover:border-white/30 transition-all">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </button>
            </div>
            <form action="{{ route('site.post.list') }}" method="get" class="relative group">
                <input type="text" name="search" placeholder="Digite sua pesquisa..."
                    class="w-full bg-transparent border-b-2 border-white/10 py-8 text-3xl md:text-6xl font-light text-white placeholder-white/10 focus:outline-none focus:border-emerald-500 transition-all duration-500"
                    x-init="$watch('searchModal', value => { if (value) $nextTick(() => $el.focus()) })">
                <button type="submit"
                    class="absolute right-0 bottom-8 text-white/20 hover:text-emerald-500 transition-all duration-300">
                    <i class="fa-solid fa-magnifying-glass text-3xl md:text-5xl"></i>
                </button>
            </form>
            <div class="mt-8 flex gap-4">
                <span class="text-slate-600 text-[10px] font-bold uppercase tracking-widest">Sugestões:</span>
                <div class="flex gap-4 text-[10px] font-bold text-white/40 uppercase tracking-widest">
                    <a href="#" class="hover:text-emerald-500 transition">Cursos</a>
                    <a href="#" class="hover:text-emerald-500 transition">Editais</a>
                    <a href="#" class="hover:text-emerald-500 transition">Calendário</a>
                </div>
            </div>
        </div>
    </div>
</header>
