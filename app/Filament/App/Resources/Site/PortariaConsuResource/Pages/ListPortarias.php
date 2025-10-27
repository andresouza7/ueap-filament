<?php

namespace App\Filament\App\Resources\Site\PortariaConsuResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\PortariaConsuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortarias extends ListRecords
{
    protected static string $resource = PortariaConsuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
