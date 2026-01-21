<?php

namespace App\Filament\App\Resources\Transparencia\Despesas\Pages;

use App\Filament\App\Resources\Transparencia\Despesas\DespesaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditDespesa extends EditRecord
{
    protected static string $resource = DespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'update', class_basename($this->record) . ":{$this->record->id}");
    }
}
