<x-filament-panels::page>

    <div class="w-full py-12 text-white"
        style="background-image: url('{{ asset('img/bg-saude.png') }}'); background-size: cover; background-position: center; min-height: 60vh;">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Logo + Título --}}
            <div class="flex items-center gap-4 mb-8">
                <img src="{{ asset('img/logo-white.png') }}" alt="UEAP Logo" class="h-12">
                <h2 class="text-3xl font-extrabold tracking-tight">Saúde e Bem-Estar</h2>
            </div>

            {{-- Alerta com instruções no novo estilo --}}
            <div class="bg-yellow-100/20 border-l-4 border-yellow-400 pl-4 py-2 mb-10">
                <p class="font-bold text-yellow-300">Leia antes de solicitar</p>
                <p class="text-sm">
                    Para garantir um agendamento adequado, leia atentamente as instruções fornecidas pela equipe de
                    Saúde.
                    <span class="underline font-bold">Acesse aqui.</span>
                </p>
            </div>

            {{-- Título central com ícone aprimorado --}}
            <div class="relative text-center mb-12 py-6">

                <h3 class="text-3xl font-extrabold text-white tracking-tight mb-2">
                    Solicitar Novo Agendamento
                </h3>
                <p class="text-sm text-white/90 max-w-xl mx-auto">
                    Escolha abaixo a especialidade desejada para iniciar seu atendimento com a equipe de Saúde e
                    Bem-Estar.
                </p>

                {{-- efeito visual de fundo --}}
                <div class="absolute inset-x-0 -bottom-6 flex justify-center pointer-events-none">
                    <div class="w-48 h-24 bg-green-400/20 blur-3xl rounded-full"></div>
                </div>
            </div>

            {{-- Especialidades em grid responsivo --}}
            @php
                $specialties = [
                    [
                        'category' => 'medicina',
                        'icon' => 'fa-user-md',
                        'title' => 'Medicina',
                        'professional' => 'Samyra Loureiro',
                    ],
                    [
                        'category' => 'fisioterapia',
                        'icon' => 'fa-male',
                        'title' => 'Fisioterapia',
                        'professional' => 'Ana Moura',
                    ],
                    [
                        'category' => 'nutricao',
                        'icon' => 'fa-cutlery',
                        'title' => 'Nutrição',
                        'professional' => 'Noely Almeida',
                    ],
                    [
                        'category' => 'enfermagem',
                        'icon' => 'fa-medkit',
                        'title' => 'Enfermagem',
                        'professional' => 'Maisa Valente',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($specialties as $item)
                    <a href="{{ route('filament.app.pages.agendamento-saude', ['category' => $item['category']]) }}"
                        class="block group transition-transform hover:scale-[1.02]">
                        <div
                            class="bg-white text-gray-800 rounded-xl border border-gray-200 shadow-sm hover:ring-2 hover:ring-primary hover:ring-offset-2 transition p-4 text-center h-full flex flex-col items-center justify-center">

                            <h5 class="text-base font-bold mb-1">{{ $item['title'] }}</h5>
                            <p class="text-sm text-gray-600">{{ $item['professional'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>

</x-filament-panels::page>
