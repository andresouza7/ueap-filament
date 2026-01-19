<section class="py-16 bg-gray-50 border-t border-gray-200">
    <div class="max-w-ueap mx-auto px-4 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl font-bold text-ueap-primary mb-4">Programas e Projetos</h2>
            <p class="text-slate-500">Iniciativas que integram ensino, pesquisa e extensão para a comunidade.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php
                $programs = [
                    ['title' => 'Iniciação Científica', 'icon' => 'fa-microscope', 'color' => 'bg-blue-500'],
                    ['title' => 'Extensão Universitária', 'icon' => 'fa-hands-holding-circle', 'color' => 'bg-green-500'],
                    ['title' => 'Assistência Estudantil', 'icon' => 'fa-user-graduate', 'color' => 'bg-yellow-500'],
                    ['title' => 'Internacionalização', 'icon' => 'fa-globe', 'color' => 'bg-purple-500'],
                ];
            @endphp

            @foreach ($programs as $prog)
                <a href="#" class="group bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all text-center">
                    <div class="w-14 h-14 mx-auto rounded-full {{ $prog['color'] }}/10 text-{{ str_replace('bg-', '', $prog['color']) }} flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid {{ $prog['icon'] }} text-2xl text-ueap-primary"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 group-hover:text-ueap-primary transition-colors">{{ $prog['title'] }}</h3>
                </a>
            @endforeach
        </div>

    </div>
</section>
