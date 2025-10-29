<?php

namespace App\Filament\App\Resources\Site\ConsuResolutions\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Site\ConsuResolutions\ConsuResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsuResolution extends EditRecord
{
    protected static string $resource = ConsuResolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
