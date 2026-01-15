@php
    $menus = \App\Models\WebMenu::where('status', 'published')
        ->whereHas('menu_place', fn($q) => $q->where('slug', 'principal'))
        ->orderBy('position')
        ->get();
@endphp

<style>
    [x-cloak] { display: none !important; }
    .no-scroll { overflow: hidden !important; }

    /* Novo Dropdown UEAP 2026 */
    .dropdown-ueap {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 34, 102, 0.15);
        border: 1px solid rgba(0, 85, 255, 0.05);
    }

    /* Animação suave para o modal */
    .modal-enter { animation: modalFade 0.3s ease-out; }
    @keyframes modalFade {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<header x-data="{ mobileMenu: false, searchModal: false }" 
        @keydown.window.escape="mobileMenu = false; searchModal = false"
        x-effect="mobileMenu || searchModal ? document.body.classList.add('no-scroll') : document.body.classList.remove('no-scroll')"
        class="relative w-full font-sans">

    {{-- BARRA DE SISTEMAS (TOP BAR) --}}
    <section aria-label="Links institucionais"
        class="bg-[#002266] text-blue-100/60 text-[10px] font-black uppercase tracking-widest py-2.5 relative z-[80]">
        <div class="max-w-[1440px] mx-auto px-4 lg:px-12 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 bg-[#A4ED4A] rounded-full animate-pulse"></span>
                <span>Portal Oficial</span>
            </div>
            <nav class="flex gap-4 md:gap-6">
                <a href="https://sigaa.ueap.edu.br/sigaa/" class="hover:text-[#A4ED4A] transition-colors">SIGAA</a>
                <a href="http://transparencia.ueap.edu.br/" class="hover:text-[#A4ED4A] transition-colors">Transparência</a>
                <a href="https://servicedesk.ueap.edu.br/" class="hover:text-[#A4ED4A] transition-colors">Suporte</a>
            </nav>
        </div>
    </section>

    {{-- NAV PRINCIPAL --}}
    <nav class="relative z-[60] bg-white border-b border-slate-100 shadow-sm" aria-label="Menu Principal">
        <div class="max-w-[1440px] mx-auto px-4 lg:px-12 relative">
            <div class="flex justify-between items-center h-20 lg:h-28">

                {{-- LOGO --}}
                <a href="/" class="flex items-center gap-3 shrink-0 group z-20" aria-label="Ir para a página inicial">
                    <img src="/img/site/logo.png" alt="Logotipo UEAP" class="h-12 lg:h-16 w-auto object-contain transition-transform group-hover:scale-105">
                    <div class="flex flex-col border-l-2 border-[#0055FF]/10 pl-3">
                        <span class="text-3xl lg:text-4xl font-black text-[#002266] tracking-tighter leading-none">
                            UE<span class="text-[#0055FF]">AP</span>
                        </span>
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest mt-1">
                            Universidade do Estado <br> <span class="text-[#0055FF]">do Amapá</span>
                        </span>
                    </div>
                </a>

                {{-- MENU DESKTOP --}}
                <ul class="hidden lg:flex items-center gap-1 ml-auto h-full">
                    @foreach ($menus as $menu)
                        <li class="relative group h-full flex items-center" x-data="{ open: false }" 
                            @mouseenter="open = true" @mouseleave="open = false" 
                            @focusin="open = true" @focusout="open = false">

                            <button type="button" 
                                    class="px-4 py-2 rounded-full text-[12px] font-black text-[#002266] uppercase tracking-tight transition-all hover:bg-[#0055FF]/5 hover:text-[#0055FF]"
                                    :aria-expanded="open" aria-haspopup="true">
                                {{ $menu->name }}
                            </button>

                            @if ($menu->items->count())
                                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2"
                                     class="absolute left-0 top-[70%] w-64 dropdown-ueap p-4 z-50">
                                    <ul class="space-y-1">
                                        @foreach ($menu->items as $item)
                                            <li>
                                                <a href="{{ $item->url }}"
                                                   class="block px-4 py-2.5 rounded-xl text-[11px] font-bold text-slate-600 uppercase hover:bg-[#A4ED4A] hover:text-[#002266] transition-colors">
                                                    {{ $item->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                {{-- BOTÕES DE AÇÃO --}}
                <div class="flex items-center gap-3 ml-6">
                    <button @click="searchModal = true" aria-label="Abrir busca"
                            class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-[#002266] hover:bg-[#0055FF] hover:text-white transition-all focus:ring-4 focus:ring-[#0055FF]/20">
                        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    </button>
                    
                    <button @click="mobileMenu = true" aria-label="Abrir menu"
                            class="lg:hidden w-12 h-12 rounded-2xl bg-[#002266] text-white flex items-center justify-center shadow-lg shadow-blue-900/20">
                        <i class="fa-solid fa-bars-staggered" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- MENU MOBILE (NOVO DESIGN) --}}
    <template x-teleport="body">
        <div x-show="mobileMenu" x-cloak class="fixed inset-0 z-[1000] lg:hidden">
            {{-- Overlay --}}
            <div class="absolute inset-0 bg-[#002266]/95 backdrop-blur-md" @click="mobileMenu = false"></div>
            
            <nav class="relative w-full h-full p-6 flex flex-col" role="dialog" aria-modal="true" aria-label="Menu Mobile">
                <div class="flex justify-between items-center mb-12">
                    <span class="text-[#A4ED4A] font-black text-xs tracking-widest uppercase">Navegação</span>
                    <button @click="mobileMenu = false" class="w-12 h-12 rounded-full bg-white/10 text-white flex items-center justify-center">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <div class="flex-1 space-y-4 overflow-y-auto">
                    @foreach ($menus as $menu)
                        <div x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="w-full flex justify-between items-center text-left py-4 border-b border-white/10">
                                <span class="text-2xl font-black text-white uppercase tracking-tighter" :class="open ? 'text-[#A4ED4A]' : ''">
                                    {{ $menu->name }}
                                </span>
                                <i class="fa-solid" :class="open ? 'fa-minus' : 'fa-plus'" class="text-[#A4ED4A]"></i>
                            </button>
                            <div x-show="open" x-collapse class="pl-4 py-2 space-y-4">
                                @foreach ($menu->items as $item)
                                    <a href="{{ $item->url }}" class="block text-blue-100/60 font-bold uppercase text-sm tracking-wide">
                                        {{ $item->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </nav>
        </div>
    </template>

    {{-- MODAL PESQUISA (MODERNO) --}}
    <template x-teleport="body">
        <div x-show="searchModal" x-cloak class="fixed inset-0 z-[1000] flex items-start justify-center p-4 pt-20 md:pt-32">
            <div class="absolute inset-0 bg-[#002266]/90 backdrop-blur-xl" @click="searchModal = false"></div>
            
            <div class="w-full max-w-3xl bg-white rounded-[40px] p-8 md:p-12 relative z-10 modal-enter shadow-2xl">
                <div class="flex justify-between items-center mb-8">
                    <h2 id="search-title" class="text-[#002266] font-black text-sm uppercase tracking-[0.3em]">
                        O que você procura?
                    </h2>
                    <button @click="searchModal = false" class="text-slate-400 hover:text-[#002266] font-bold text-xs">
                        [ FECHAR ]
                    </button>
                </div>

                <form action="{{ route('site.post.list') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Buscar notícias, editais..." autofocus
                           class="w-full bg-slate-50 border-none rounded-3xl px-8 py-6 text-xl md:text-3xl font-black text-[#002266] focus:ring-4 focus:ring-[#0055FF]/10 placeholder:text-slate-300">
                    
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 w-14 h-14 bg-[#0055FF] text-white rounded-2xl flex items-center justify-center hover:bg-[#A4ED4A] hover:text-[#002266] transition-all">
                        <i class="fa-solid fa-arrow-right text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </template>
</header>