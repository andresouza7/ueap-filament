<?php

namespace App\Filament\App\Resources\Site\WebMenuPlaceResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\WebMenuPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebMenuPlaces extends ListRecords
{
    protected static string $resource = WebMenuPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
