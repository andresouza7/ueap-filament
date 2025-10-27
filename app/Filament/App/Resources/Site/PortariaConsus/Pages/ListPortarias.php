<?php

namespace App\Filament\App\Resources\Site\PortariaConsus\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\PortariaConsus\PortariaConsuResource;
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
