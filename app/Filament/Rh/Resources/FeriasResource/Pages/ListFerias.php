<?php

namespace App\Filament\Rh\Resources\FeriasResource\Pages;

use App\Filament\Rh\Resources\FeriasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFerias extends ListRecords
{
    protected static string $resource = FeriasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
