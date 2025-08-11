<x-filament-panels::page>
    <div class="grid gap-4 md:grid-cols-2">
        @livewire(\Filament\Widgets\AccountWidget::class)
        @livewire(\App\Filament\App\Widgets\LatestPosts::class)
    </div>
</x-filament-panels::page>
