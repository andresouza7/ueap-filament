<?php

namespace App\Filament\App\Resources\Site\WebMenuPlaces\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\WebMenuPlaces\WebMenuPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebMenuPlace extends EditRecord
{
    protected static string $resource = WebMenuPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'update', class_basename($this->record) . ":{$this->record->id}");
    }
}
