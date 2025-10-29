<?php

namespace App\Filament\App\Resources\Transparencia\Licitacaos\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Transparencia\Licitacaos\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLicitacao extends ListRecords
{
    protected static string $resource = LicitacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
