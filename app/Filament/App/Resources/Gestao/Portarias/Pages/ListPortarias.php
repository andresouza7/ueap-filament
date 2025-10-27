<?php

namespace App\Filament\App\Resources\Gestao\Portarias\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Gestao\Portarias\PortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortarias extends ListRecords
{
    protected static string $resource = PortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
