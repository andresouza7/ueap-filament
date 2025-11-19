<x-filament-panels::page>
    {{ $this->form }}

    @if ($userId)
        <livewire:frequency-submit :userId="$userId" />
    @endif
</x-filament-panels::page>
