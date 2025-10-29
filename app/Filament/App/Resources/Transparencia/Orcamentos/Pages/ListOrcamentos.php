<?php

namespace App\Filament\App\Resources\Transparencia\Orcamentos\Pages;

use App\Filament\App\Resources\Transparencia\Orcamentos\OrcamentoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrcamentos extends ListRecords
{
    protected static string $resource = OrcamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
