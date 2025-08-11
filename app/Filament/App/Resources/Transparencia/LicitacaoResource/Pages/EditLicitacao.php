<?php

namespace App\Filament\App\Resources\Transparencia\LicitacaoResource\Pages;

use App\Filament\App\Resources\Transparencia\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLicitacao extends EditRecord
{
    protected static string $resource = LicitacaoResource::class;
    protected static ?string $navigationLabel = 'Editar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
