<x-filament::page>

    {{-- FORMULÁRIO --}}
    <div class="mb-6">
        {{ $this->form }}
    </div>

    {{-- SE NENHUM USUÁRIO FOI SELECIONADO --}}
    @if (blank($user_id))
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center text-sm text-gray-600">
            <p class="font-medium text-gray-700">
                Nenhum usuário selecionado
            </p>
            <p class="mt-1">
                Para visualizar os impedimentos, selecione um usuário no formulário acima.
            </p>
        </div>
    @else
        {{-- USUÁRIO SELECIONADO, MAS SEM RESULTADOS --}}
        @if (empty($rows))
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-6 text-center text-sm text-yellow-800">
                <p class="font-medium">
                    Nenhum impedimento encontrado
                </p>
                <p class="mt-1">
                    O usuário selecionado não possui impedimentos registrados em portarias.
                </p>
            </div>
        @else
            {{-- TABELA DE RESULTADOS --}}
            <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                    <h2 class="text-sm font-semibold text-gray-700">
                        Impedimentos encontrados
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead
                            class="bg-gray-100 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                            <tr>
                                <th class="px-6 py-3">Portaria</th>
                                <th class="px-6 py-3">Tipo</th>
                                <th class="px-6 py-3">Início</th>
                                <th class="px-6 py-3">Fim</th>
                                <th class="px-6 py-3">Descrição</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach ($rows as $row)
                                <tr class="hover:bg-gray-50">
                                    @php
                                        $path = 'documents/ordinances/' . $row->id . '.pdf';

                                        // $portaria_url = Storage::exists($path) ? Storage::url($path) : null;
                                        $portaria_url = Storage::url($path);
                                    @endphp
                                    <td class="px-6 py-4 text-gray-800">
                                        <div class="flex items-center gap-2">
                                            <span> {{ $row->number }}/{{ $row->year }} </span>

                                            <a href="{{ $portaria_url }}" target="_blank"
                                                class="text-xs text-blue-600 hover:text-blue-800 underline underline-offset-2">
                                                abrir
                                            </a>
                                        </div>

                                        @php
                                            $portaria = \App\Models\Portaria::find($row->id);
                                            $lastActivity = $portaria
                                                ->activities()
                                                ->whereIn('event', ['created', 'updated'])
                                                ->latest()
                                                ->first();
                                        @endphp

                                        @if ($lastActivity)
                                            <div class="text-xs text-gray-500">
                                                Registrado por {{ $lastActivity->causer?->login ?? 'Sistema' }}
                                                em {{ $lastActivity->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">
                                            {{ ucfirst($row->type) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($row->start_date)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ \Carbon\Carbon::parse($row->end_date)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $row->description }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @endif
    @endif

</x-filament::page>
