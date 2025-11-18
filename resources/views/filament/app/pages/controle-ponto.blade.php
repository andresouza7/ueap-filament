<x-filament-panels::page>
    <div>
        {{ $this->form }}
    </div>

    <div class="overflow-x-auto shadow rounded-lg border">
        <table class="table-fixed w-full text-sm border-collapse">
            <thead class="bg-gray-100 sticky top-0">
                <tr>
                    <!-- Coluna maior para o servidor -->
                    <th class="px-4 py-3 border-b text-left w-2/6 font-medium">Servidor</th>

                    <!-- Cada mês ocupa a mesma largura -->
                    @foreach ([
        1 => 'Jan',
        2 => 'Fev',
        3 => 'Mar',
        4 => 'Abr',
        5 => 'Mai',
        6 => 'Jun',
        7 => 'Jul',
        8 => 'Ago',
        9 => 'Set',
        10 => 'Out',
        11 => 'Nov',
        12 => 'Dez',
    ] as $m => $nomeMes)
                        <th class="px-2 py-3 border-b text-center w-1/12 font-medium">{{ $nomeMes }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($this->servidores as $servidor => $folhas)
                    <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors">
                        <td class="px-4 py-1 border-b border-r font-medium text-gray-800">{{ $servidor }}</td>
                        @for ($m = 1; $m <= 12; $m++)
                            @php
                                // pega todas as folhas do mês
                                $mesFolhas = $folhas->where('month', $m);

                                // prioridade: pendente > aprovado > rejeitado
                                $folha =
                                    $mesFolhas->firstWhere('status', 'pendente') ??
                                    ($mesFolhas->firstWhere('status', 'aprovado') ?? $mesFolhas->first());
                            @endphp
                            <td class="px-2 py-1 border-b border-r text-center">
                                @if ($folha)
                                    <a href="{{ $folha->file_path }}" target="_blank">
                                        <span class="text-xl">
                                            @switch($folha->status)
                                                @case('aprovado')
                                                    ✔
                                                @break

                                                @case('pendente')
                                                    ⏳
                                                @break

                                                @case('rejeitado')
                                                    ❌
                                                @break

                                                @default
                                                    -
                                            @endswitch
                                        </span>
                                    </a>
                                @else
                                    <span class="text-gray-400 text-lg">-</span>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="my-4 flex justify-center">
            {{ $this->servidores->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Explicação dos status -->
    <div class="mb-4 text-xs text-gray-600">
        <p><span class="text-green-500 font-bold">✔</span> Aprovado: folha de ponto conferida e aprovada.</p>
        <p><span class="text-yellow-500 font-bold">⏳</span> Pendente: folha de ponto enviada, aguardando avaliação.</p>
        <p><span class="text-red-500 font-bold">❌</span> Rejeitado: folha de ponto rejeitada, requer correção.</p>
        <p><span class="text-gray-400 font-bold">-</span> Nenhum registro: folha de ponto não enviada.</p>
    </div>
</x-filament-panels::page>
