<?php

namespace App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages;

use App\Filament\App\Resources\Transparencia\LicitacaoResource;
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
