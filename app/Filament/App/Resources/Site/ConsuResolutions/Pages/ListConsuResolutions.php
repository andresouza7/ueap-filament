<?php

namespace App\Filament\App\Resources\Site\ConsuResolutions\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\ConsuResolutions\ConsuResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsuResolutions extends ListRecords
{
    protected static string $resource = ConsuResolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
