<?php

namespace App\Filament\Transparencia\Resources\ContratoResource\Pages;

use App\Filament\Transparencia\Resources\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContrato extends EditRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
