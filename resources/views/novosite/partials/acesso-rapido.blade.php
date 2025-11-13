<section class="px-4 md:px-8 py-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-3">

            @php
                $menu1 = [
                    ['icon' => 'fa-solid fa-calendar-days', 'color' => 'blue', 'label' => 'Calendário Acadêmico'],
                    ['icon' => 'fa-solid fa-scale-balanced', 'color' => 'green', 'label' => 'Legislação UEAP'],
                    ['icon' => 'fa-solid fa-file-lines', 'color' => 'yellow', 'label' => 'Instruções Normativas'],
                    ['icon' => 'fa-solid fa-scroll', 'color' => 'purple', 'label' => 'Resoluções CONSU'],
                    ['icon' => 'fa-solid fa-gavel', 'color' => 'red', 'label' => 'Licitações'],
                    ['icon' => 'fa-solid fa-graduation-cap', 'color' => 'indigo', 'label' => 'Processos Seletivos'],
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($menu1 as $item)
                    <a href="#"
                        class="group flex items-center gap-3 bg-white rounded-lg shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 p-4">
                        
                        <!-- Ícone -->
                        <div
                            class="flex items-center justify-center w-12 h-12 min-w-[3rem] min-h-[3rem] rounded-lg bg-{{ $item['color'] }}-100 text-{{ $item['color'] }}-600 group-hover:bg-{{ $item['color'] }}-600 group-hover:text-white transition-all duration-300">
                            <i class="{{ $item['icon'] }} text-xl"></i>
                        </div>

                        <!-- Texto -->
                        <span
                            class="text-sm font-semibold text-gray-700 group-hover:text-{{ $item['color'] }}-600 transition-colors leading-tight">
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</section>
