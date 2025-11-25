<div class="bg-gray-900 text-gray-300 text-xs py-3"> <!-- bg-[#023E88] -->
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 flex justify-end space-x-6">
        <a href="#" class="hover:text-white transition">Portal do Aluno</a>
        <a href="#" class="hover:text-white transition">Intranet</a>
        <a href="#" class="hover:text-white transition">Portal da Transparência</a>
    </div>
</div>

<div class="h-1 bg-gradient-to-r from-ueap-green via-yellow-500 to-blue-800"></div>

<nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="flex items-center flex-shrink-0">
                <div class="flex flex-row items-center gap-2">
                    <img src="/img/site/logo.png" alt="Logo UEAP" class="h-14 sm:h-16">
                    <div class="flex flex-col justify-center leading-none select-none cursor-pointer">
                        <span class="text-3xl font-extrabold text-ueap-green tracking-tighter leading-none">UEAP</span>
                        <span
                            class="text-[0.55rem] sm:text-[0.6rem] text-gray-500 uppercase tracking-wide sm:tracking-widest leading-tight font-medium">
                            Universidade do<br class="sm:hidden"> Estado do Amapá
                        </span>
                    </div>
                </div>
            </div>

            <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                <a href="#"
                    class="text-gray-700 hover:text-ueap-green font-medium transition text-sm xl:text-base">Institucional</a>
                <a href="#"
                    class="text-gray-700 hover:text-ueap-green font-medium transition text-sm xl:text-base">Cursos</a>
                <a href="#"
                    class="text-gray-700 hover:text-ueap-green font-medium transition text-sm xl:text-base">Ensino</a>
                <a href="#"
                    class="text-gray-700 hover:text-ueap-green font-medium transition text-sm xl:text-base">Comunidade</a>
                <a href="#"
                    class="text-gray-700 hover:text-ueap-green font-medium transition text-sm xl:text-base whitespace-nowrap">Acesso
                    à Informação</a>
            </div>

            <div class="hidden lg:flex items-center">
                <button class="text-gray-500 hover:text-ueap-green p-2 xl:hidden transition-colors">
                    <span class="sr-only">Buscar</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <div class="relative hidden xl:block">
                    <input type="text" placeholder="Buscar..."
                        class="bg-gray-100 text-gray-700 rounded-full pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-ueap-green w-48 transition-all focus:w-64">
                    <button class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-ueap-green">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

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