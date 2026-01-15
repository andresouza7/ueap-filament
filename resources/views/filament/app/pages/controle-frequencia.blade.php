<x-filament-panels::page>
    @php
        $items = [
            [
                'label' => 'Recebimento de ponto',
                'description' => 'Gestão de solicitações e validação de documentos.',
                'icon' => 'heroicon-o-document-check',
                'href' => route('filament.app.resources.gestao.tickets.index'),
            ],
            [
                'label' => 'Registro Manual',
                'description' => 'Lançamento individual da folha de ponto do servidor.',
                'icon' => 'heroicon-o-document-plus',
                'href' => route('filament.app.pages.cadastro-ponto-urh'),
            ],
        ];
    @endphp

    <div class="rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-white/10 bg-white dark:bg-[#1d2335]">
        
        {{-- BANNER - Altura reduzida mas ainda dominante sobre a seção de baixo --}}
        <div class="relative w-full h-80 md:h-[400px] overflow-hidden">
            <img src="/img/bg-frequencia.jpg" class="absolute inset-0 w-full h-full object-cover" alt="Banner">
            <div class="absolute inset-0 bg-gradient-to-t from-[#1d2335] via-[#1d2335]/40 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-10">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight drop-shadow-lg">
                    Controle de Frequência
                </h1>
                <p class="text-gray-200 text-base mt-2 max-w-xl font-medium drop-shadow-md">
                    Gestão operacional do envio da folha de ponto
                </p>
            </div>
        </div>

        {{-- SEÇÃO DE AÇÕES - Expandida na largura e compacta na altura --}}
        <div class="w-full p-6"> {{-- Largura total do container --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                
                @foreach ($items as $item)
                    <a href="{{ $item['href'] }}" class="group relative flex flex-col gap-3 rounded-xl border border-gray-200 p-5 transition-all duration-300 hover:ring-2 hover:ring-primary-500 dark:border-gray-700/50 dark:bg-[#232a3d] dark:hover:bg-[#2a324b] shadow-sm">
                        
                        <div class="flex items-center justify-between">
                            {{-- Ícone Compacto --}}
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-50 text-gray-600 ring-1 ring-gray-200 transition-colors group-hover:bg-primary-500 group-hover:text-white dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700">
                                <x-dynamic-component :component="$item['icon']" class="h-5 w-5" />
                            </div>
                            
                            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">
                                Módulo
                            </span>
                        </div>

                        <div class="flex-1">
                            <h2 class="text-base font-bold text-gray-900 dark:text-white transition-colors group-hover:text-primary-600 dark:group-hover:text-primary-400">
                                {{ $item['label'] }}
                            </h2>
                            <p class="mt-1 text-[12px] leading-tight text-gray-500 dark:text-gray-400">
                                {{ $item['description'] }}
                            </p>
                        </div>

                        <div class="flex items-center font-bold text-primary-600 dark:text-primary-400 text-[10px] uppercase tracking-[0.15em] pt-1">
                            Acessar ferramenta
                            <svg class="ml-1.5 h-3 w-3 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Rodapé --}}
            <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-800">
                <p class="text-[9px] font-bold uppercase tracking-[0.3em] text-gray-400 dark:text-gray-600 text-center">
                    Sistema Integrado de Recursos Humanos
                </p>
            </div>
        </div>
    </div>
</x-filament-panels::page>