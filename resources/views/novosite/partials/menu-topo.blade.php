<nav class="bg-primary text-gray-100 shadow-[0_4px_10px_rgba(0,0,0,0.2)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="/img/nova_logo_black.png" alt="Logo" class="h-8 w-auto brightness-0 invert">
            </div>

            <!-- Menu principal -->
            @php
                $menuItems = ['Início', 'Sobre', 'Serviços', 'Projetos', 'Notícias', 'Contato', 'Portal', 'Ouvidoria'];
            @endphp

            <div class="hidden md:flex items-center space-x-6">
                @foreach ($menuItems as $item)
                    <a href="#"
                        class="text-gray-200 font-medium transition-all transform hover:-translate-y-[2px] hover:text-white hover:underline underline-offset-4 decoration-accent-yellow decoration-2">
                        {{ $item }}
                    </a>
                @endforeach
            </div>

            <!-- Área de pesquisa -->
            <div class="hidden md:flex items-center">
                <div class="relative">
                    <input type="text" placeholder="Buscar..."
                        class="pl-10 pr-4 py-2 text-sm rounded-full bg-white/15 text-gray-100 placeholder-gray-300 border border-transparent focus:outline-none focus:ring-2 focus:ring-white/60 focus:bg-white/25 focus:border-white/40 transition-all backdrop-blur-sm">
                    <i
                        class="fa-solid fa-magnifying-glass w-4 h-4 text-gray-300 absolute left-3 top-1/2 -translate-y-1/2"></i>
                </div>
            </div>

            <!-- Botão de menu mobile -->
            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="text-gray-200 hover:text-white focus:outline-none transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="md:hidden hidden border-t border-white/10 bg-primary/95 backdrop-blur-md">
        @foreach ($menuItems as $item)
            <a href="#"
                class="block px-4 py-2 text-gray-200 hover:bg-white/10 hover:text-white transition-all transform hover:-translate-y-[1px]">
                {{ $item }}
            </a>
        @endforeach

        <!-- Pesquisa Mobile -->
        <div class="border-t border-white/10 mt-2 px-4 py-3">
            <div class="relative">
                <input type="text" placeholder="Buscar..."
                    class="w-full pl-9 pr-3 py-2 text-sm rounded-full bg-white/15 text-gray-100 placeholder-gray-300 focus:bg-white/25 focus:ring-2 focus:ring-white/50 transition-all backdrop-blur-sm">
                <i
                    class="fa-solid fa-magnifying-glass w-4 h-4 text-gray-300 absolute left-3 top-1/2 -translate-y-1/2"></i>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
