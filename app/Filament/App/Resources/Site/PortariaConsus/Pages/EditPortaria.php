<?php

namespace App\Filament\App\Resources\Site\PortariaConsus\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\PortariaConsus\PortariaConsuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortaria extends EditRecord
{
    protected static string $resource = PortariaConsuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'update', class_basename($this->record) . ":{$this->record->id}");
    }
}
