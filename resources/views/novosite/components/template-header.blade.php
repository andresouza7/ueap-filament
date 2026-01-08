<div class="bg-gray-900 text-gray-300 text-xs py-3"> <!-- bg-[#023E88] -->
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 flex justify-end space-x-6">
        <a href="https://sigaa.ueap.edu.br/sigaa" class="hover:text-white transition">SIGAA</a>
        <a href="https://intranet.ueap.edu.br" class="hover:text-white transition">Intranet</a>
        <a href="https://transparencia.ueap.edu.br" class="hover:text-white transition">Transparência</a>
        <a href="https://servicedesk.ueap.edu.br" class="hover:text-white transition">Service Desk</a>
    </div>
</div>

<div class="h-1 bg-gradient-to-r from-ueap-green via-yellow-500 to-blue-800"></div>

<nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <a href="/" class="block group">
                <div class="flex items-center flex-shrink-0">
                    <div class="flex flex-row items-center gap-1.5 sm:gap-2">

                        {{-- Logo: h-10 no mobile, h-14 em telas médias, h-16 em desktop --}}
                        <img src="/img/site/logo.png" alt="Logo UEAP"
                            class="h-10 md:h-14 lg:h-16 w-auto transition-all">

                        <div class="flex flex-col justify-center leading-none select-none cursor-pointer">
                            {{-- UEAP: text-xl no mobile, text-3xl no desktop --}}
                            <span
                                class="text-xl md:text-2xl lg:text-3xl font-extrabold text-ueap-green tracking-tighter leading-none">
                                UEAP
                            </span>

                            {{-- Descrição: Diminuída para text-[0.45rem] em telas muito pequenas --}}
                            <span
                                class="text-[0.45rem] md:text-[0.55rem] lg:text-[0.6rem] text-gray-500 uppercase tracking-tighter sm:tracking-widest leading-[1.1] font-medium">
                                Universidade do<br class="md:hidden"> Estado do Amapá
                            </span>
                        </div>
                    </div>
                </div>
            </a>

            @php
                $menus = \App\Models\WebMenu::where('status', 'published')
                    ->whereHas('menu_place', function ($query) {
                        $query->where('slug', 'principal');
                    })
                    ->orderBy('position')
                    ->get();
            @endphp

            @if ($menus->count())
                <div class="bg-white">
                    <nav class="hidden lg:flex items-center space-x-6 xl:space-x-8 ">
                        <div class="max-w-ueap mx-auto">

                            @foreach ($menus as $menu)
                                @php
                                    $items = $menu
                                        ->items()
                                        ->whereNull('menu_parent_id')
                                        ->where('status', 'published')
                                        ->orderBy('position')
                                        ->get();
                                @endphp

                                @if ($items->count())
                                    <div class="relative group inline-block">

                                        <!-- LABEL DO MENU -->
                                        <button
                                            class="flex items-center gap-2 text-gray-800 hover:text-ueap-green
                           font-medium transition text-sm py-2 px-1 cursor-pointer">

                                            <span>{{ $menu->name }}</span>

                                        </button>

                                        <!-- DROPDOWN -->
                                        <div
                                            class="absolute left-0 top-full -mt-2
                        bg-white shadow-xl rounded-lg border border-gray-200
                        opacity-0 invisible group-hover:opacity-100 group-hover:visible
                        group-hover:translate-y-1 transition-all duration-200 ease-out
                        w-max max-w-[420px] min-w-[220px]
                        py-1 z-[99999] pointer-events-auto">

                                            @foreach ($items as $item)
                                                <a href="{{ $item->url ?? '#' }}"
                                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-ueap-green
                               text-sm transition truncate border-b border-gray-50 last:border-none">
                                                    {{ $item->name }}
                                                </a>
                                            @endforeach

                                        </div>

                                    </div>
                                @endif
                            @endforeach

                        </div>

                    </nav>
                </div>
            @endif

            <form action="{{ route('site.post.list') }}" method="get">
                <div class="hidden lg:flex items-center">
                    <button class="text-gray-500 hover:text-ueap-green p-2 xl:hidden transition-colors">
                        <span class="sr-only">Buscar</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <div class="relative hidden xl:block">
                        <input type="text" placeholder="Buscar..." name="search"
                            class="bg-gray-100 text-gray-700 rounded-full pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-ueap-green w-48 transition-all focus:w-64">
                        <button class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-ueap-green">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>

            <div class="lg:hidden flex items-center">
                <button id="mobile-menu-btn" class="text-gray-600 hover:text-ueap-green focus:outline-none p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-100 bg-gray-50">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-ueap-green hover:bg-white transition">Institucional</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-ueap-green hover:bg-white transition">Cursos</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-ueap-green hover:bg-white transition">Ensino</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-ueap-green hover:bg-white transition">Comunidade</a>
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-ueap-green hover:bg-white transition">Acesso
                à Informação</a>

            <div class="relative mt-4 px-3 pb-3">
                <input type="text" placeholder="Buscar..."
                    class="w-full bg-white border border-gray-300 text-gray-700 rounded-md pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-ueap-green">
                <button class="absolute right-0 top-0 mt-2 mr-6 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
