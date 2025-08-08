<?php

namespace App\Filament\App\Resources\Social\PontoResource\Pages;

use App\Filament\App\Resources\Social\PontoResource;
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
