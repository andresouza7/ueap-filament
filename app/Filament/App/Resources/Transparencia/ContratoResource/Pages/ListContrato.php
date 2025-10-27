<?php

namespace App\Filament\App\Resources\Transparencia\ContratoResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Transparencia\ContratoResource;
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
