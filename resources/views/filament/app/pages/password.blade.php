<x-filament-panels::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <br />
        <x-filament::button type="submit">
            Redefinir
        </x-filament::button>
    </form>
</x-filament-panels::page>
