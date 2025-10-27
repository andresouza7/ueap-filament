<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecoResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Transparencia\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRegistroPreco extends ListRecords
{
    protected static string $resource = RegistroPrecoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
