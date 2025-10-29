<?php

namespace App\Filament\App\Resources\Transparencia\Contratos\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Transparencia\Contratos\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContrato extends ListRecords
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
