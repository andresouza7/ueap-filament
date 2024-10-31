<?php

namespace App\Filament\Site\Resources\WebMenuPlaceResource\Pages;

use App\Filament\Site\Resources\WebMenuPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebMenuPlace extends ViewRecord
{
    protected static string $resource = WebMenuPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
