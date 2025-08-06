<x-filament-panels::page>

    <div class="max-w-7xl mx-auto space-y-10">

        {{-- Alerta com instruções --}}
        <div class="flex items-start gap-3 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow-sm">
            <x-heroicon-s-check class="text-yellow-500 w-5 h-5 mt-1" />
            <div>
                <p class="text-yellow-700 font-semibold">Leia antes de solicitar</p>
                <p class="text-sm text-gray-800">
                    Acesse a agenda, escolha um horário, preencha a data e confirme sua solicitação.
                </p>
            </div>
        </div>


        {{-- Grade com Agenda e Formulário --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-start">

            {{-- Agenda (Iframe) --}}
            <div class="md:col-span-3">
                <div class="overflow-hidden rounded-lg border border-gray-200 shadow">
                    <iframe src="{{ $this->url }}?gv=true" class="w-full h-[600px] border-0" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- Formulário --}}
            <div class="md:col-span-1">
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-lg border border-white/20 shadow space-y-6">
                    {{ $this->form }}
                </div>
            </div>

        </div>

    </div>

</x-filament-panels::page>
