<?php

namespace App\Filament\PortalTransparencia\Resources\ServidorResource\Pages;

use App\Filament\PortalTransparencia\Resources\ServidorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServidor extends ViewRecord
{
    protected static string $resource = ServidorResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
