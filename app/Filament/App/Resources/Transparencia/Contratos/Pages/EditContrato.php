<?php

namespace App\Filament\App\Resources\Transparencia\Contratos\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Transparencia\Contratos\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContrato extends EditRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'update', class_basename($this->record) . ":{$this->record->id}");
    }
}
