<?php

namespace App\Filament\App\Resources\Site\WebMenuPlaceResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Site\WebMenuPlaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebMenuPlace extends ViewRecord
{
    protected static string $resource = WebMenuPlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
