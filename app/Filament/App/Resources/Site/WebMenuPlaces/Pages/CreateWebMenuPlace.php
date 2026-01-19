<?php

namespace App\Filament\App\Resources\Site\WebMenuPlaces\Pages;

use App\Filament\App\Resources\Site\WebMenuPlaces\WebMenuPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWebMenuPlace extends CreateRecord
{
    protected static string $resource = WebMenuPlaceResource::class;

    protected function afterCreate(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_site', 'create', class_basename($this->record) . ":{$this->record->id}");
    }
}
