<?php

namespace App\Filament\Transparencia\Resources\LicitacaoResource\Pages;

use App\Filament\Transparencia\Resources\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLicitacao extends ViewRecord
{
    protected static string $resource = LicitacaoResource::class;
    protected static ?string $navigationLabel = 'Visualizar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
