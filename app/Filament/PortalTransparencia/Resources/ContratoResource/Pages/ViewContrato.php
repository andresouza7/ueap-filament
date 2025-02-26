<?php

namespace App\Filament\PortalTransparencia\Resources\ContratoResource\Pages;

use App\Filament\PortalTransparencia\Resources\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContrato extends ViewRecord
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
