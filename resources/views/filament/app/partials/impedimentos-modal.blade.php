<div class="space-y-4">
    @if (!count($impediments))
        <p class="text-sm text-gray-500">Nenhum impedimento registrado.</p>
    @else
        <table class="w-full text-left text-sm">
            <thead>
                <tr>
                    <th class="py-2">Descrição</th>
                    <th class="py-2">Início</th>
                    <th class="py-2">Fim</th>
                    <th class="py-2">Portaria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($impediments as $portaria)
                    @php
                        $imp = $portaria->impediments[0] ?? null;
                    @endphp

                    <tr class="border-t">
                        <td class="py-2">
                            {{ $imp['description'] ?? '—' }}
                        </td>

                        <td class="py-2">
                            {{ isset($imp['start_date']) ? \Carbon\Carbon::parse($imp['start_date'])->format('d/m/Y') : '—' }}
                        </td>

                        <td class="py-2">
                            {{ isset($imp['end_date']) ? \Carbon\Carbon::parse($imp['end_date'])->format('d/m/Y') : '—' }}
                        </td>

                        <td class="py-2">
                            {{ $portaria->number }}/{{ $portaria->year }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
