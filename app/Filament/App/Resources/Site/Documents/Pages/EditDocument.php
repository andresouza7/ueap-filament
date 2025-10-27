<?php

namespace App\Filament\App\Resources\Site\Documents\Pages;

use App\Filament\App\Resources\Site\Documents\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditDocument extends EditRecord
{
    protected static string $resource = DocumentResource::class;

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
