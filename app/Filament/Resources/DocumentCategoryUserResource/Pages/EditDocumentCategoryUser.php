<?php

namespace App\Filament\Resources\DocumentCategoryUserResource\Pages;

use App\Filament\Resources\DocumentCategoryUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentCategoryUser extends EditRecord
{
    protected static string $resource = DocumentCategoryUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
        ];
    }
}
