<?php

namespace App\Filament\Transparencia\Resources\DotacaoResource\Pages;

use App\Filament\Transparencia\Resources\DotacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDotacao extends ListRecords
{
    protected static string $resource = DotacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
