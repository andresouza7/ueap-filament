<?php

namespace App\Filament\App\Resources\Site\ConsuResolutionResource\Pages;

use App\Filament\App\Resources\Site\ConsuResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsuResolution extends EditRecord
{
    protected static string $resource = ConsuResolutionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
