<?php

namespace App\Filament\Site\Resources\WebMenuPlaceResource\Pages;

use App\Filament\Site\Resources\WebMenuPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebMenuPlaces extends ListRecords
{
    protected static string $resource = WebMenuPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
