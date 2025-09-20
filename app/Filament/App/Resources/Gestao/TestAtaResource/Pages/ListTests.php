<?php

namespace App\Filament\App\Resources\Gestao\TestAtaResource\Pages;

use App\Filament\App\Resources\Gestao\TestAtaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTests extends ListRecords
{
    protected static string $resource = TestAtaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
