<x-filament-panels::page>

    <div x-data="{ tab: 'tab1' }">
        <x-filament::tabs label="Content tabs" class="mb-2">
            <x-filament::tabs.item @click="tab = 'tab1'" :alpine-active="'tab === \'tab1\''">
                Emitir Ponto
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'tab2'" :alpine-active="'tab === \'tab2\''">
                Upload Assinatura
            </x-filament::tabs.item>

        </x-filament::tabs>

        <x-filament::section>
            <x-slot name="heading">
                Preencher folha de ponto
            </x-slot>

            <x-slot name="description">
                Selecione o tipo de ponto, o mês, e o ano desejado. Informe os horários de entrada e saída para cada turno do dia. Você também pode optar por usar sua assinatura cadastrada.
            </x-slot>

            {{-- Content --}}
            <div>
                <div x-show="tab === 'tab1'">
                    @livewire('frequency-emit')
                   
                </div>
    
                <div x-show="tab === 'tab2'">
                    @livewire('frequency-signature')
                </div>
            </div>

        </x-filament::section>
    </div>

    <div class="mt-4">
        {{ $this->table }}
    </div>
</x-filament-panels::page>
