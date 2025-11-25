<div class="space-y-4">
    @if ($impediments->isEmpty())
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
                @foreach ($impediments as $imp)
                    <tr class="border-t">
                        <td class="py-2">{{ $imp->description }}</td>
                        <td class="py-2">{{ optional($imp->start_date)->format('d/m/Y') ?? '—' }}</td>
                        <td class="py-2">{{ optional($imp->end_date)->format('d/m/Y') ?? '—' }}</td>
                        <td class="py-2">
                            @if ($imp->ordinance)
                                {{ $imp->ordinance->number }}/{{ $imp->ordinance->year }}
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
