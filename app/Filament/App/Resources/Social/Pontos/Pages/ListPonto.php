<?php

namespace App\Filament\App\Resources\Social\Pontos\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Social\Pontos\PontoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPonto extends ListRecords
{
    protected static string $resource = PontoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
