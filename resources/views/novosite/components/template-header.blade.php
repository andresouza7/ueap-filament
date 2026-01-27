@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', fn($q) => $q->where('slug', 'principal'))
        ->orderBy('position')
        ->take(6)
        ->get();
@endphp

<header x-data="{ mobileMenu: false, searchModal: false }" class="bg-ueap-blue text-white sticky top-0 z-50 shadow-xl font-sans">

    {{-- BARRA SUPERIOR DE SISTEMAS --}}
    <div class="bg-ueap-blue-dark/40 border-b border-white/5">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex justify-end gap-6 text-[10px] font-bold uppercase tracking-[0.2em] text-blue-100/60">
            <a href="https://sigaa.ueap.edu.br/sigaa/" class="hover:text-ueap-green transition-colors">SIGAA</a>
            <a href="http://transparencia.ueap.edu.br/" class="hover:text-ueap-green transition-colors">Transparência</a>
            <a href="https://servicedesk.ueap.edu.br/" class="hover:text-ueap-green transition-colors">Suporte TI</a>
        </div>
    </div>

    {{-- NAVEGAÇÃO PRINCIPAL --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex justify-between items-center">

        {{-- LOGO --}}
        <a href="/" class="h-10 lg:h-12 flex items-center group">
            <img src="{{ asset('img/nova_logo_white.png') }}" alt="Logo UEAP"
                class="h-full w-auto transition-all duration-300 brightness-0 invert opacity-100 group-hover:opacity-80">
        </a>

        {{-- MENU DESKTOP --}}
        <nav class="hidden lg:flex items-center gap-1 h-full">
            @foreach ($menus as $menu)
                <div class="relative h-full flex items-center" x-data="{ open: false }" @mouseenter="open = true"
                    @mouseleave="open = false">
                    <button
                        class="px-4 py-2 text-[11px] font-black uppercase tracking-widest transition-colors flex items-center gap-1.5"
                        :class="open ? 'text-ueap-green' : 'text-white hover:text-ueap-green'">
                        {{ $menu->name }}
                        @if ($menu->items->count())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-300"
                                :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        @endif
                    </button>

                    @if ($menu->items->count())
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute top-[85%] left-0 w-64 bg-white text-ueap-blue-dark shadow-2xl border-t-4 border-ueap-green rounded-none z-50 overflow-hidden">
                            <div class="max-h-[500px] overflow-y-auto py-4 scrollbar-thin scrollbar-thumb-ueap-green">
                                @foreach ($menu->items as $item)
                                    <a href="{{ $item->url }}"
                                        class="block px-6 py-2.5 text-[11px] font-bold uppercase tracking-tight hover:bg-gray-50 hover:text-ueap-blue transition-all border-l-4 border-transparent hover:border-ueap-green">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

            {{-- BUSCA DESKTOP --}}
            <button @click="searchModal = true"
                class="ml-4 w-10 h-10 flex items-center justify-center bg-white/5 hover:bg-ueap-green hover:text-ueap-blue-dark rounded-none transition-all duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </nav>

        {{-- CONTROLES MOBILE (BUSCA + MENU) --}}
        <div class="flex items-center gap-2 lg:hidden">
            {{-- BOTÃO BUSCA MOBILE --}}
            <button @click="searchModal = true"
                class="w-11 h-11 flex items-center justify-center bg-white/5 text-white rounded-none border border-white/10 active:bg-ueap-green active:text-ueap-blue-dark transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            {{-- BOTÃO MENU MOBILE --}}
            <button @click="mobileMenu = true"
                class="w-11 h-11 flex items-center justify-center bg-ueap-green text-ueap-blue-dark rounded-none shadow-lg active:scale-95 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- MENU MOBILE FULLSCREEN --}}
    <template x-if="mobileMenu">
        <div class="fixed inset-0 z-[100] bg-ueap-blue-dark flex flex-col p-8 overflow-y-auto rounded-none"
            x-transition>
            <div class="flex justify-between items-center mb-12">
                <img src="{{ asset('img/nova_logo_white.png') }}" class="h-10 brightness-0 invert">
                <button @click="mobileMenu = false"
                    class="w-12 h-12 flex items-center justify-center bg-white/5 rounded-none text-white border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col gap-4">
                @foreach ($menus as $menu)
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between py-5 text-lg font-black uppercase tracking-widest border-b border-white/10"
                            :class="open ? 'text-ueap-green' : 'text-white'">
                            {{ $menu->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-transform"
                                :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-collapse
                            class="bg-black/20 flex flex-col rounded-none overflow-hidden mt-2 border-l-2 border-ueap-green">
                            @foreach ($menu->items as $item)
                                <a href="{{ $item->url }}"
                                    class="px-8 py-4 text-sm font-bold text-blue-100 border-b border-white/5 active:bg-ueap-green active:text-ueap-blue-dark transition-colors">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>
        </div>
    </template>

    {{-- MODAL DE BUSCA AJUSTADO --}}
    <template x-if="searchModal">
        <div class="fixed inset-0 z-[110] flex items-center justify-center p-4">
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-ueap-blue-dark/90 backdrop-blur-sm" @click="searchModal = false"></div>

            {{-- Container do Modal --}}
            <div class="relative w-full max-w-xl bg-white p-8 shadow-2xl rounded-none border-t-4 border-ueap-green">

                {{-- Header do Modal --}}
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-ueap-blue-dark font-bold uppercase tracking-widest text-xs">Pesquisar no Portal
                    </h3>
                    <button @click="searchModal = false"
                        class="text-gray-400 hover:text-gray-600 text-[10px] uppercase font-bold transition-colors">
                        Fechar
                    </button>
                </div>

                {{-- Formulário com botão à direita --}}
                <form action="{{ route('site.post.list') }}" method="GET" class="flex flex-col items-end">
                    <input type="text" name="search" autofocus placeholder="O que você procura?"
                        class="w-full border-b border-gray-200 py-3 text-lg font-normal text-ueap-blue-dark focus:outline-none focus:border-ueap-blue transition-colors placeholder:text-gray-300 rounded-none">

                    <button type="submit"
                        class="mt-6 px-10 py-3 bg-ueap-blue-dark text-white font-medium text-xs uppercase tracking-widest hover:bg-ueap-green hover:text-ueap-blue-dark transition-all rounded-none">
                        Pesquisar
                    </button>
                </form>
            </div>
        </div>
    </template>
</header>
