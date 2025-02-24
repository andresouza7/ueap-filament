<div>
    <form wire:submit.prevent="create">
        {{ $this->form }}
        <br />

        <x-filament::button type="submit" class="w-1/2">
            Emitir Ponto
        </x-filament::button>
    </form>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-new-tab', (url) => {
                window.open(url, '_blank');
            });
        });
    </script>
</div>
