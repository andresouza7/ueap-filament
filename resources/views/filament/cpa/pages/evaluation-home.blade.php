<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            Formulário de avaliação CPA 2024
        </x-slot>

        <x-slot name="description">
            Informe seu CPF para começar.
        </x-slot>

        {{-- Content --}}
        {{ $this->form }}
        <x-filament::button wire:click="onStartEvaluation" class="mt-2">
            Começar
        </x-filament::button>
    </x-filament::section>
</x-filament-panels::page>
