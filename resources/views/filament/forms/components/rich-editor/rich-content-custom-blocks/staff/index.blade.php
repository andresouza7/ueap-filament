<section id="corpo-docente-dinamico" class="scroll-mt-24">
    {{-- Título da seção, como no modelo --}}
    <div class="flex justify-between items-center mb-4 border-b pb-2 border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900">Corpo Docente</h2>
        {{-- Mantenho o link de exemplo, adapte a URL --}}
        <a href="#" class="text-sm text-ueap-green hover:underline">Ver avaliação de desempenho</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nome
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Titulação
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Regime
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Lattes
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                @forelse ($members as $member)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            {{ $member['name'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ $member['title'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ $member['regime'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($member['lattes_url'])
                                <a href="{{ $member['lattes_url'] }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-800 hover:underline">
                                    Currículo Lattes
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">
                            Nenhum membro do corpo docente cadastrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>