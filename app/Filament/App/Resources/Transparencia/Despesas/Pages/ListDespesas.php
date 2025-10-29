<?php

namespace App\Filament\App\Resources\Transparencia\Despesas\Pages;

use App\Filament\App\Resources\Transparencia\Despesas\DespesaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDespesas extends ListRecords
{
    protected static string $resource = DespesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
