<?php

namespace App\Filament\App\Resources\Transparencia\DotacaoResource\Pages;

use App\Filament\App\Resources\Transparencia\DotacaoResource;
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
