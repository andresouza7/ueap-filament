<footer class="bg-green-600 text-white py-10 w-full px-6 lg:px-12">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 items-start p-4">

        <!-- Logo Area -->
        <div class="flex flex-col items-center md:items-start">
            <img src="{{ asset('img/logo-white.png') }}" alt="University Logo" class="w-48 mb-4 lg:w-64">
            <p class="text-white font-semibold text-center md:text-left lg:text-lg">Universidade do Estado do Amapá</p>
        </div>

        <!-- Site Map -->
        <div class="flex flex-col items-center md:items-start">
            <h3 class="text-slate-200 font-semibold mb-4 text-base">Mapa do Site</h3>
            <ul class="space-y-2">
                <li><a href="/about" class="text-slate-300 hover:text-gray-300 transition-colors duration-200">About Us</a></li>
                <li><a href="/admissions" class="text-slate-300 hover:text-gray-300 transition-colors duration-200">Admissions</a></li>
                <li><a href="/departments" class="text-slate-300 hover:text-gray-300 transition-colors duration-200">Departments</a></li>
                <li><a href="/contact" class="text-slate-300 hover:text-gray-300 transition-colors duration-200">Contact</a></li>
            </ul>
        </div>

        <!-- External Validation Banner -->
        <div class="flex flex-col items-center md:items-start">
            <a href="https://externalvalidationwebsite.com" target="_blank" rel="noopener" class="block">
                <img src="{{ asset('img/banner-mec.png') }}" alt="Ministry of Education Validation" class="w-64 lg:w-full mb-4 rounded-md shadow-lg hover:opacity-90  transition transform hover:scale-105">
            </a>
            <p class="text-gray-200 text-sm text-center md:text-left">Consulte o nosso cadastro no sistema e-MEC.</p>
        </div>

        <!-- Social Media Links -->
        <div class="flex flex-col items-center md:items-start">
            <h3 class="text-brightblue font-semibold mb-4 text-base">Siga a UEAP</h3>
            <div class="flex space-x-4">
                <a href="https://facebook.com/university" class="text-lightblue hover:text-brightblue transition-colors duration-200">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <!-- Facebook icon SVG -->
                    </svg>
                </a>
                <a href="https://twitter.com/university" class="text-lightblue hover:text-brightblue transition-colors duration-200">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <!-- Twitter icon SVG -->
                    </svg>
                </a>
                <a href="https://instagram.com/university" class="text-lightblue hover:text-brightblue transition-colors duration-200">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <!-- Instagram icon SVG -->
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Divider for aesthetics (optional) -->
    <div class="border-t border-gray-100 mt-8"></div>

    <!-- Copyright and other information -->
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center mt-6 text-gray-400 text-sm">
        <p>&copy; {{ now()->year }} DINFO/UEAP. Todos os direitos reservados.</p>
        <a href="/privacy-policy" class="text-gray-400 hover:text-gray-300 transition-colors duration-200 mt-4 md:mt-0">Política de Privacidade</a>
    </div>
</footer>
