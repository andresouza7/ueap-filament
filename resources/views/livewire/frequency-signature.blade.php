<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <form wire:submit.prevent="create">
        {{ $this->form }}
        <br />

        <x-filament::button type="submit" class="w-1/2">
            Salvar Assinatura
        </x-filament::button>
    </form>
</div>
