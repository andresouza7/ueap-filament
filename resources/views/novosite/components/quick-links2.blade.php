<section class="max-w-ueap mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-0 bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
        
        @php
            $links = [
                ['icon' => 'fa-calendar-days', 'label' => 'Calendário Acadêmico', 'color' => 'text-emerald-600'],
                ['icon' => 'fa-scale-balanced', 'label' => 'Legislação Ueap', 'color' => 'text-teal-600'],
                ['icon' => 'fa-file-lines', 'label' => 'Instruções Normativas', 'color' => 'text-emerald-600'],
                ['icon' => 'fa-gavel', 'label' => 'Resoluções CONSU', 'color' => 'text-teal-600'],
                ['icon' => 'fa-handshake', 'label' => 'Licitações', 'color' => 'text-emerald-600'],
                ['icon' => 'fa-user-tie', 'label' => 'Processos Seletivos', 'color' => 'text-teal-600']
            ];
        @endphp

        @foreach($links as $link)
        <a href="#" class="flex flex-col items-center p-8 border-r border-b lg:border-b-0 border-gray-50 hover:bg-gray-50 transition-all group">
            <div class="w-14 h-14 bg-gray-50 {{ $link['color'] }} rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-inner">
                <i class="fa-solid {{ $link['icon'] }} text-2xl"></i>
            </div>
            <span class="text-[11px] font-black text-gray-700 uppercase tracking-tighter text-center leading-tight">
                {{ $link['label'] }}
            </span>
        </a>
        @endforeach
    </div>
</section>