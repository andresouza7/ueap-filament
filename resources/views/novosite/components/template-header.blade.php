@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', fn($q) => $q->where('slug', 'principal'))
        ->orderBy('position')
        ->get();
@endphp

<header x-data="{ mobileMenu: false, searchModal: false }" class="bg-ueap-blue text-white sticky top-0 z-50 shadow-md font-sans">

    {{-- Barra Superior de Sistemas (Opcional, mas útil para portais universitários) --}}
    <div class="bg-ueap-blue-dark/50 border-b border-white/10">
        <div
            class="container mx-auto px-4 py-1.5 flex justify-end gap-4 text-[10px] font-bold uppercase tracking-widest text-blue-100/80">
            <a href="https://sigaa.ueap.edu.br/sigaa/" class="hover:text-ueap-green transition">SIGAA</a>
            <a href="http://transparencia.ueap.edu.br/" class="hover:text-ueap-green transition">Transparência</a>
            <a href="https://servicedesk.ueap.edu.br/" class="hover:text-ueap-green transition">Suporte</a>
        </div>
    </div>

    <div class="container mx-auto px-4 h-20 flex justify-between items-center">
        {{-- LOGO --}}
        <a href="/" class="h-12 flex items-center group">
            <img src="{{ asset('img/nova_logo_white.png') }}" alt="Logo UEAP"
                class="h-full w-auto transition-transform group-hover:scale-105">
        </a>

        {{-- NAVEGAÇÃO DESKTOP --}}
        <nav class="hidden lg:flex items-center gap-2 h-full">
            @foreach ($menus as $menu)
                <div class="relative h-full flex items-center group" x-data="{ open: false }" @mouseenter="open = true"
                    @mouseleave="open = false">
                    <button
                        class="px-4 py-2 text-xs font-bold uppercase tracking-widest hover:text-ueap-sky transition flex items-center gap-1">
                        {{ $menu->name }}
                        @if ($menu->items->count())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-50" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        @endif
                    </button>

                    @if ($menu->items->count())
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute top-[80%] left-0 w-64 bg-white text-ueap-blue-dark shadow-2xl border-t-4 border-ueap-green py-3">
                            @foreach ($menu->items as $item)
                                <a href="{{ $item->url }}"
                                    class="block px-6 py-2.5 text-[11px] font-bold uppercase tracking-tight hover:bg-gray-100 hover:text-ueap-blue transition">
                                    {{ $item->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            {{-- Botão de Busca --}}
            <button @click="searchModal = true" class="ml-4 p-2 hover:bg-white/10 rounded-full transition"
                title="Pesquisar">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </nav>

        {{-- BOTÃO MOBILE --}}
        <button @click="mobileMenu = true" class="lg:hidden p-2 bg-ueap-green text-ueap-blue-dark rounded shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    {{-- MENU MOBILE (SIMPLES) --}}
    <template x-if="mobileMenu">
        <div class="fixed inset-0 z-[100] bg-ueap-blue-dark flex flex-col p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <img src="{{ asset('img/nova_logo_white.png') }}" class="h-8">
                <button @click="mobileMenu = false" class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="flex flex-col gap-2">
                @foreach ($menus as $menu)
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between py-4 text-sm font-black uppercase tracking-widest border-b border-white/10">
                            {{ $menu->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform"
                                :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" class="bg-black/10 flex flex-col">
                            @foreach ($menu->items as $item)
                                <a href="{{ $item->url }}"
                                    class="px-6 py-4 text-xs font-bold text-blue-200 border-b border-white/5">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>
        </div>
    </template>

    {{-- MODAL DE BUSCA (LIMPO) --}}
    <template x-if="searchModal">
        <div class="fixed inset-0 z-[110] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-ueap-blue-dark/95 backdrop-blur-sm" @click="searchModal = false"></div>
            <div class="relative w-full max-w-2xl bg-white p-8 shadow-2xl rounded-ueap">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-ueap-blue-dark font-black uppercase tracking-widest">O que você procura?</h3>
                    <button @click="searchModal = false" class="text-gray-400 hover:text-red-500 transition">Fechar
                        (Esc)</button>
                </div>
                <form action="{{ route('site.post.list') }}" method="GET">
                    <input type="text" name="search" autofocus placeholder="Digite o termo da busca..."
                        class="w-full border-b-4 border-ueap-blue py-4 text-2xl font-display font-bold text-ueap-blue-dark focus:outline-none placeholder:text-gray-200">
                    <button type="submit"
                        class="mt-6 w-full bg-ueap-green text-ueap-blue-dark font-black py-4 uppercase tracking-widest hover:bg-ueap-blue hover:text-white transition">Pesquisar
                        Agora</button>
                </form>
            </div>
        </div>
    </template>
</header>
