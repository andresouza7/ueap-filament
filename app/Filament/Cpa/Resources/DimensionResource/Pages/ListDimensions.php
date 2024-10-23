<?php

namespace App\Filament\Cpa\Resources\DimensionResource\Pages;

use App\Filament\Cpa\Resources\DimensionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDimensions extends ListRecords
{
    protected static string $resource = DimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
