<?php

namespace App\Filament\Cpa\Resources\DimensionResource\Pages;

use App\Filament\Cpa\Resources\DimensionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDimension extends EditRecord
{
    protected static string $resource = DimensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
