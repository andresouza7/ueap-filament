<x-filament-panels::page>
    <div class="space-y-4">
        {{-- Account widget ocupando toda a largura --}}
        <div class="w-full">
            @livewire(\Filament\Widgets\AccountWidget::class)
        </div>

        {{-- Linha com duas colunas: LatestPosts e OcorrenciasPonto --}}
        <div class="grid gap-4 md:grid-cols-12">
            {{-- Esquerda (2/3) --}}
            <div class="md:col-span-9">
                @livewire(\App\Filament\App\Widgets\LatestPosts::class)
            </div>

            {{-- Direita (1/3) --}}
            <div class="md:col-span-3">
                @livewire(\App\Filament\App\Widgets\OcorrenciasPonto::class)
            </div>
        </div>
    </div>
</x-filament-panels::page>
