<?php

namespace App\Filament\App\Resources\Transparencia\Licitacaos\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\Licitacaos\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLicitacao extends ViewRecord
{
    protected static string $resource = LicitacaoResource::class;
    protected static ?string $navigationLabel = 'Visualizar';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
