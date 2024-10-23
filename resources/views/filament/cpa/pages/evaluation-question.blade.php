<x-filament-panels::page>
    <h1 class="font-semibold">{{ $data['title'] }}</h1>
   
    {{ $this->form }}

    <div class="flex gap-4">
        <x-filament::link wire:click="onAnswerQuestion" tag="button">
            Anterior
        </x-filament::link>
        <x-filament::link wire:click="onGoBack" tag="button">
            Próxima
        </x-filament::link>
    </div>
</x-filament-panels::page>
