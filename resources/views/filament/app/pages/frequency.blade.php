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
                User details
            </x-slot>

            <x-slot name="description">
                This is all the information we hold about the user.
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
