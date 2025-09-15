<?php

namespace App\Filament\App\Resources\Site\ConsuAtaResource\Pages;

use App\Filament\App\Resources\Site\ConsuAtaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsuAtas extends ListRecords
{
    protected static string $resource = ConsuAtaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
