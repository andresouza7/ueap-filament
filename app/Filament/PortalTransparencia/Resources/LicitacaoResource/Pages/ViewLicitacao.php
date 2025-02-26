<?php

namespace App\Filament\PortalTransparencia\Resources\LicitacaoResource\Pages;

use App\Filament\PortalTransparencia\Resources\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLicitacao extends ViewRecord
{
    protected static string $resource = LicitacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
