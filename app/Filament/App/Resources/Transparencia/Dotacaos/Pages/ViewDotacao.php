<?php

namespace App\Filament\App\Resources\Transparencia\Dotacaos\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\Dotacaos\DotacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDotacao extends ViewRecord
{
    protected static string $resource = DotacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
