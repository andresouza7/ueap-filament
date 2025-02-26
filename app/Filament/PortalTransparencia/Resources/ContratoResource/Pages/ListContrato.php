<?php

namespace App\Filament\PortalTransparencia\Resources\ContratoResource\Pages;

use App\Filament\PortalTransparencia\Resources\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContrato extends ListRecords
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
