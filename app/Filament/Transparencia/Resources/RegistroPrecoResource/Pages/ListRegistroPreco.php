<?php

namespace App\Filament\Transparencia\Resources\RegistroPrecoResource\Pages;

use App\Filament\Transparencia\Resources\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegistroPreco extends ListRecords
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
