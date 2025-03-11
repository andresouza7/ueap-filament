<?php

namespace App\Filament\App\Resources\PontoResource\Pages;

use App\Filament\App\Resources\PontoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPonto extends ListRecords
{
    protected static string $resource = PontoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
