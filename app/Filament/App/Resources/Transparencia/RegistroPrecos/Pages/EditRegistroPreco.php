<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecos\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Transparencia\RegistroPrecos\RegistroPrecoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistroPreco extends EditRecord
{
    protected static string $resource = RegistroPrecoResource::class;

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
