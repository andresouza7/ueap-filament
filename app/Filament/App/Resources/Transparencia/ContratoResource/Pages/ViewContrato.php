<?php

namespace App\Filament\App\Resources\Transparencia\ContratoResource\Pages;

use App\Filament\App\Resources\Transparencia\ContratoResource;
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
