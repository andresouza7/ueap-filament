<?php

namespace App\Filament\App\Resources\Site\ConsuResolutionResource\Pages;

use App\Filament\App\Resources\Site\ConsuResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsuResolutions extends ListRecords
{
    protected static string $resource = ConsuResolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
