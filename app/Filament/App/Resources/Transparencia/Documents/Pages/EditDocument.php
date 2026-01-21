<?php

namespace App\Filament\App\Resources\Transparencia\Documents\Pages;

use App\Filament\App\Resources\Transparencia\Documents\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

    protected function afterSave(): void
    {
        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'update', class_basename($this->record) . ":{$this->record->id}");
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }


    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()->name;
    }
}
