<?php

namespace App\Filament\App\Resources\Transparencia\QuadroDespesas\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Transparencia\QuadroDespesas\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuadroDespesa extends ListRecords
{
    protected static string $resource = QuadroDespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
