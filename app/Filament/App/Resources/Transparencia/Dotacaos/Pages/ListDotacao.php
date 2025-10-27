<?php

namespace App\Filament\App\Resources\Transparencia\Dotacaos\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Transparencia\Dotacaos\DotacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDotacao extends ListRecords
{
    protected static string $resource = DotacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
