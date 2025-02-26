<?php

namespace App\Filament\Transparencia\Resources\ContratoResource\Pages;

use App\Filament\Transparencia\Resources\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContrato extends ViewRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
