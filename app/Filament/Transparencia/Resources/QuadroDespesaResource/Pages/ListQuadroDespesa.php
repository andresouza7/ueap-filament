<?php

namespace App\Filament\Transparencia\Resources\QuadroDespesaResource\Pages;

use App\Filament\Transparencia\Resources\QuadroDespesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuadroDespesa extends ListRecords
{
    protected static string $resource = QuadroDespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
