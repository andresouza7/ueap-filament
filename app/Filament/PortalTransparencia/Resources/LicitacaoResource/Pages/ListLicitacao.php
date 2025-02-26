<?php

namespace App\Filament\PortalTransparencia\Resources\LicitacaoResource\Pages;

use App\Filament\PortalTransparencia\Resources\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLicitacao extends ListRecords
{
    protected static string $resource = LicitacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
