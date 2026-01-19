<?php

namespace App\Filament\App\Resources\Gestao\MapaFerias\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Gestao\MapaFerias\MapaFeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFerias extends EditRecord
{
    protected static string $resource = MapaFeriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'mapa_ferias', 'edit', "MapaFerias:{$this->record->id}");
    }
}
