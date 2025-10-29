<?php

namespace App\Filament\App\Resources\Gestao\MapaFerias\Pages;

use Filament\Actions\CreateAction;
use Filament\Support\Enums\Width;
use App\Filament\App\Resources\Gestao\MapaFerias\MapaFeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFerias extends ListRecords
{
    protected static string $resource = MapaFeriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Cadastrar Férias'),
        ];
    }

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }
}
