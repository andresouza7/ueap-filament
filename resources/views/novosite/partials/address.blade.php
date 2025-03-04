<section class="w-full bg-gray-100">
    <div class="container mx-auto p-6 ">
        <!-- Campuses Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6 text-center text-xs">
            <!-- Campus I -->
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md">
                <div class="cursor-pointer flex justify-between items-center sm:block" onclick="toggleDetails(this)">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        <i class="fa fa-building"></i> Campus I
                    </p>
                    <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300 sm:hidden"></i>
                </div>
                <div class="mt-2 sm:block hidden">
                    <p class="text-gray-600 dark:text-gray-300">
                        <i class="fa fa-map-signs"></i> Av. Presidente Vargas, nº 650<br>Centro | CEP:
                        68.900-070<br>Macapá - AP
                    </p>
                    <a href="https://maps.app.goo.gl/G3hQ65XPWmK7gdQ56" target="_blank"
                        class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                        Ver no mapa
                    </a>
                </div>
            </div>

            <!-- Campus Território dos Lagos -->
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md">
                <div class="cursor-pointer flex justify-between items-center sm:block" onclick="toggleDetails(this)">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        <i class="fa fa-building"></i> Campus Território dos Lagos
                    </p>
                    <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300 sm:hidden"></i>
                </div>
                <div class="mt-2 sm:block hidden">
                    <p class="text-gray-600 dark:text-gray-300">
                        <i class="fa fa-map-signs"></i> Av. Desidério Antônio Coelho, 470<br>Sete Mangueiras | CEP:
                        68950-000<br>Amapá - AP
                    </p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                        Ver no mapa
                    </a>
                </div>
            </div>

            <!-- Setor Administrativo -->
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md">
                <div class="cursor-pointer flex justify-between items-center sm:block" onclick="toggleDetails(this)">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        <i class="fa fa-building"></i> Setor Administrativo
                    </p>
                    <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300 sm:hidden"></i>
                </div>
                <div class="mt-2 sm:block hidden">
                    <p class="text-gray-600 dark:text-gray-300">
                        <i class="fa fa-map-signs"></i> Rua Tiradentes, 284<br>Centro | CEP: 68900-098<br>Macapá - AP
                    </p>
                    <a href="https://maps.app.goo.gl/6CTfZ6LCs8EGsNRT6" target="_blank"
                        class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                        Ver no mapa
                    </a>
                </div>
            </div>

            <!-- Anexo Graziela -->
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md">
                <div class="cursor-pointer flex justify-between items-center sm:block" onclick="toggleDetails(this)">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        <i class="fa fa-building"></i> Anexo Graziela
                    </p>
                    <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300 sm:hidden"></i>
                </div>
                <div class="mt-2 sm:block hidden">
                    <p class="text-gray-600 dark:text-gray-300">
                        <i class="fa fa-map-signs"></i> Av. Duque de Caxias, 60<br>Centro | CEP: 68900-071<br>Macapá -
                        AP
                    </p>
                    <a href="https://maps.app.goo.gl/DYtzkwTXccMss3rN7" target="_blank"
                        class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                        Ver no mapa
                    </a>
                </div>
            </div>

            <!-- NTE - Núcleo Tecnológico -->
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md">
                <div class="cursor-pointer flex justify-between items-center sm:block" onclick="toggleDetails(this)">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        <i class="fa fa-building"></i> NTE - Núcleo Tecnológico
                    </p>
                    <i class="fas fa-chevron-down text-gray-500 transition-transform duration-300 sm:hidden"></i>
                </div>
                <div class="mt-2 sm:block hidden">
                    <p class="text-gray-600 dark:text-gray-300">
                        <i class="fa fa-map-signs"></i> Av. 13 de Setembro, 2081<br>Buritizal | CEP: 68902-865<br>Macapá
                        - AP
                    </p>
                    <a href="https://maps.app.goo.gl/vqpDBMFg8L19Ln1q8" target="_blank"
                        class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                        Ver no mapa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para alternar a exibição dos detalhes -->
    <script>
        function toggleDetails(element) {
            const details = element.nextElementSibling;
            const chevron = element.querySelector('.fa-chevron-down');

            details.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }
    </script>
</section>
