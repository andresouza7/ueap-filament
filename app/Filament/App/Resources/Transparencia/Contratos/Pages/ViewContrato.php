<?php

namespace App\Filament\App\Resources\Transparencia\Contratos\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\Contratos\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContrato extends ViewRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
