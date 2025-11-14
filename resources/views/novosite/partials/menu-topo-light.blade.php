<nav class="bg-white text-gray-900 shadow-[0_4px_10px_rgba(0,0,0,0.2)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="/img/nova_logo_black.png" alt="Logo" class="h-8 w-auto">
            </div>

            <!-- Menu principal -->
            @php
                $menuItems = ['Início', 'Sobre', 'Serviços', 'Projetos', 'Notícias', 'Contato', 'Portal', 'Ouvidoria'];
            @endphp

            <div class="hidden md:flex items-center space-x-6">
                @foreach ($menuItems as $item)
                    <a href="#"
                        class="text-gray-900 font-medium transition-all transform hover:-translate-y-[2px] hover:text-gray-700 hover:underline underline-offset-4 decoration-accent-yellow decoration-2">
                        {{ $item }}
                    </a>
                @endforeach
            </div>

            <!-- Área de pesquisa -->
            <div class="hidden md:flex items-center">
                <div class="relative">
                    <input type="text" placeholder="Buscar..."
                        class="pl-10 pr-4 py-2 text-sm rounded-full bg-gray-100 text-gray-900 placeholder-gray-500 border border-transparent focus:outline-none focus:ring-2 focus:ring-gray-300 focus:bg-white transition-all">
                    <i class="fa-solid fa-magnifying-glass w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2"></i>
                </div>
            </div>

            <!-- Botão de menu mobile -->
            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="text-gray-900 hover:text-gray-700 focus:outline-none transition-colors">
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
    <div id="mobile-menu" class="md:hidden hidden border-t border-gray-200 bg-white">
        @foreach ($menuItems as $item)
            <a href="#"
                class="block px-4 py-2 text-gray-900 hover:bg-gray-100 hover:text-gray-700 transition-all transform hover:-translate-y-[1px]">
                {{ $item }}
            </a>
        @endforeach

        <!-- Pesquisa Mobile -->
        <div class="border-t border-gray-200 mt-2 px-4 py-3">
            <div class="relative">
                <input type="text" placeholder="Buscar..."
                    class="w-full pl-9 pr-3 py-2 text-sm rounded-full bg-gray-100 text-gray-900 placeholder-gray-500 focus:bg-white focus:ring-2 focus:ring-gray-300 transition-all">
                <i class="fa-solid fa-magnifying-glass w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2"></i>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
