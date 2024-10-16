<div>
    {{-- Be like water. --}}
    <form wire:submit.prevent="create">
        {{ $this->form }}
        <br />

        <x-filament::button type="submit" class="w-1/2">
            Emitir Ponto
        </x-filament::button>
    </form>
</div>
