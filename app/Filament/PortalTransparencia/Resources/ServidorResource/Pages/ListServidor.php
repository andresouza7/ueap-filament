<?php

namespace App\Filament\PortalTransparencia\Resources\ServidorResource\Pages;

use App\Filament\PortalTransparencia\Resources\ServidorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServidor extends ListRecords
{
    protected static string $resource = ServidorResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
