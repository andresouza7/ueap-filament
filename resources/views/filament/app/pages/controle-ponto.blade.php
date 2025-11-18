<x-filament-panels::page>
    <div>
        {{ $this->form }}
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-300 shadow-sm">
        <table class="w-full table-fixed text-sm border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300 text-gray-700">
                    <th class="py-2 px-3 text-left font-semibold w-2/6">
                        Servidor
                    </th>

                    @foreach ([
                        1 => 'Jan', 2 => 'Fev', 3 => 'Mar', 4 => 'Abr', 5 => 'Mai', 6 => 'Jun',
                        7 => 'Jul', 8 => 'Ago', 9 => 'Set', 10 => 'Out', 11 => 'Nov', 12 => 'Dez'
                    ] as $nomeMes)
                        <th class="py-2 px-1 text-center font-semibold w-[70px]">
                            {{ $nomeMes }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($this->servidores as $servidor => $folhas)
                    <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors">
                        <td class="py-1 px-3 font-medium text-gray-800 border-b border-gray-300">
                            {{ $servidor }}
                        </td>

                        @for ($m = 1; $m <= 12; $m++)
                            @php
                                $mesFolhas = $folhas->where('month', $m);

                                $folha =
                                    $mesFolhas->firstWhere('status', 'pendente') ??
                                    $mesFolhas->firstWhere('status', 'aprovado') ??
                                    $mesFolhas->first();
                            @endphp

                            <td class="py-1 px-1 text-center border-b border-gray-300 w-[70px]">
                                @if ($folha)
                                    <a href="{{ $folha->file_path }}" target="_blank">
                                        @switch($folha->status)
                                            @case('aprovado')
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-semibold bg-green-100 text-green-700">
                                                    ✔
                                                </span>
                                            @break

                                            @case('pendente')
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                    ⏳
                                                </span>
                                            @break

                                            @case('rejeitado')
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-semibold bg-red-100 text-red-700">
                                                    ❌
                                                </span>
                                            @break
                                        @endswitch
                                    </a>
                                @else
                                    <span class="text-gray-400 text-sm">—</span>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3 pb-3 flex justify-center">
            {{ $this->servidores->links('vendor.pagination.custom') }}
        </div>
    </div>

    <div class="mt-4 text-xs text-gray-600 space-y-1">
        <p><span class="text-green-700 font-bold">✔</span> Aprovado.</p>
        <p><span class="text-yellow-700 font-bold">⏳</span> Pendente.</p>
        <p><span class="text-red-700 font-bold">❌</span> Rejeitado.</p>
        <p><span class="text-gray-400 font-bold">—</span> Não enviado.</p>
    </div>
</x-filament-panels::page>
