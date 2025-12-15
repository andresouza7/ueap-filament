<x-filament-panels::page>

    @php
        $items = [
            // [
            //     'label' => 'Mapa de Férias',
            //     'icon' => 'heroicon-o-map',
            //     'color' => 'green',
            //     'href' => route('filament.app.resources.gestao.mapa-ferias.index'),
            // ],
            // [
            //     'label' => 'Ocorrências de Ponto',
            //     'icon' => 'heroicon-o-exclamation-circle',
            //     'color' => 'yellow',
            //     'href' => route('filament.app.resources.gestao.calendar-occurrences.index'),
            // ],
            [
                'label' => 'Recebimento de Ponto',
                'icon' => 'heroicon-o-document-check',
                'color' => 'blue',
                'href' => route('filament.app.resources.gestao.tickets.index'),
            ],
            [
                'label' => 'Registro manual de ponto',
                'icon' => 'heroicon-o-document-plus',
                'color' => 'gray',
                'href' => route('filament.app.pages.cadastro-ponto-urh'),
            ],
            [
                'label' => 'Planilha de Pontos',
                'icon' => 'heroicon-o-calendar',
                'color' => 'red',
                'href' => route('filament.app.pages.controle-ponto'),
            ],
        ];
    @endphp

    {{-- CONTAINER PRINCIPAL COM BORDA VISÍVEL NO DARK --}}
    <div
        class="
        rounded-xl shadow-lg overflow-hidden
        dark:border
        dark:border-gray-700/70 
        dark:bg-[#1d2335]
    ">

        {{-- Banner com borda curva --}}
        <div class="relative w-full h-56 md:h-96 overflow-hidden rounded-t-xl">
            <img src="/img/bg-frequencia.jpg" class="absolute inset-0 w-full h-full object-cover object-center"
                alt="Banner">

            {{-- Overlay claro/escuro --}}
            <div class="absolute inset-0 bg-black/30 dark:bg-black/60"></div>

            <div class="relative z-10 flex flex-col justify-center h-full px-4 md:px-8 pb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow">
                    Controle de Frequência
                </h1>

                <p class="text-white/90 text-base md:text-lg mt-2 max-w-2xl">
                    Ferramentas de gestão de ponto e afastamentos
                </p>
            </div>
        </div>

        {{-- Conteúdo --}}
        <div class="relative pt-6 pb-12 bg-transparent">
            <div class="max-w-7xl mx-auto px-4">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-2 md:p-4">

                    {{-- COLUNA ESQUERDA --}}
                    <aside class="md:col-span-1 space-y-4">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                            Sobre
                        </h2>

                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed text-sm">
                            Aqui você encontra todas as funcionalidades relacionadas ao controle de frequência.
                            Utilize os módulos ao lado para acessar cada seção.
                        </p>
                    </aside>

                    {{-- COLUNA DIREITA — CARDS --}}
                    <div class="md:col-span-2">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                            @foreach ($items as $item)
                                @php
                                    // Ajuste de cores no dark mode
                                    $iconBg = "bg-{$item['color']}-100 dark:bg-[#2a3148]";
                                    $iconTxt = "text-{$item['color']}-600 dark:text-{$item['color']}-300";
                                @endphp

                                <a href="{{ $item['href'] }}"
                                    class="group 
                                        bg-gray-50 
                                        dark:bg-[#232a3d] 
                                        rounded-xl p-4 
                                        dark:border dark:border-gray-700/60
                                        shadow hover:shadow-md
                                        transition flex items-center gap-3">

                                    {{-- Coluna esquerda: Ícone --}}
                                    <div class="p-3 rounded-lg {{ $iconBg }}">
                                        <x-dynamic-component :component="$item['icon']" class="w-6 h-6 {{ $iconTxt }}" />
                                    </div>

                                    {{-- Coluna direita: Texto --}}
                                    <span class="font-medium text-sm text-gray-700 dark:text-gray-100">
                                        {{ $item['label'] }}
                                    </span>
                                </a>
                            @endforeach

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-filament-panels::page>
