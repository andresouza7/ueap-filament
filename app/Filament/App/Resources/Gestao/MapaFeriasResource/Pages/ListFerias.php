<?php

namespace App\Filament\App\Resources\Gestao\MapaFeriasResource\Pages;

use App\Filament\App\Resources\Gestao\MapaFeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFerias extends ListRecords
{
    protected static string $resource = MapaFeriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Cadastrar Férias'),
        ];
    }
}
