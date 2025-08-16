<x-filament-panels::page>

    <div x-data="{ tab: 'tab1' }">
        <x-filament::tabs label="Content tabs" class="mb-2 tabs-header">
            <x-filament::tabs.item @click="tab = 'tab1'" :alpine-active="'tab === \'tab1\''">
                Emitir Ponto
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'tab2'" :alpine-active="'tab === \'tab2\''">
                Ocorrências do Ponto
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'tab3'" :alpine-active="'tab === \'tab3\''">
                Upload Assinatura
            </x-filament::tabs.item>

        </x-filament::tabs>

        <div>
            <div x-show="tab === 'tab1'">
                @livewire('frequency-emit')
            </div>

            <div x-show="tab === 'tab2'">
                @livewire('frequency-occurrences')
            </div>

            <div x-show="tab === 'tab3'">
                @livewire('frequency-signature')
            </div>
        </div>
    </div>

</x-filament-panels::page>
