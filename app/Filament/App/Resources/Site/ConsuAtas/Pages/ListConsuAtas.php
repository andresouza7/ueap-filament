<?php

namespace App\Filament\App\Resources\Site\ConsuAtas\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Site\ConsuAtas\ConsuAtaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsuAtas extends ListRecords
{
    protected static string $resource = ConsuAtaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
