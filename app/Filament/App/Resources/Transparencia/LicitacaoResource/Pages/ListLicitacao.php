<?php

namespace App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Transparencia\LicitacaoResource;
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
