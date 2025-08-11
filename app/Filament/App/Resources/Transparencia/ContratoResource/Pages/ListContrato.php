<?php

namespace App\Filament\App\Resources\Transparencia\ContratoResource\Pages;

use App\Filament\App\Resources\Transparencia\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContrato extends ListRecords
{
    protected static string $resource = ContratoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
