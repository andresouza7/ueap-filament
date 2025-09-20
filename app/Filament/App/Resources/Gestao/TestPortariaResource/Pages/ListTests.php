<?php

namespace App\Filament\App\Resources\Gestao\TestPortariaResource\Pages;

use App\Filament\App\Resources\Gestao\TestPortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTests extends ListRecords
{
    protected static string $resource = TestPortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
