<?php

namespace App\Filament\App\Resources\Transparencia\Licitacaos\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Transparencia\Licitacaos\LicitacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLicitacao extends EditRecord
{
    protected static string $resource = LicitacaoResource::class;
    protected static ?string $navigationLabel = 'Editar';

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'update', class_basename($this->record) . ":{$this->record->id}");
    }
}
