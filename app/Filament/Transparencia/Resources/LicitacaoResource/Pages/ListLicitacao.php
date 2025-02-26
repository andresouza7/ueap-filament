<?php

namespace App\Filament\Transparencia\Resources\LicitacaoResource\Pages;

use App\Filament\Transparencia\Resources\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLicitacao extends ListRecords
{
    protected static string $resource = LicitacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
