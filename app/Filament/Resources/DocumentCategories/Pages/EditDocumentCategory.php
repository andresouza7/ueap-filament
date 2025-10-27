<?php

namespace App\Filament\Resources\DocumentCategories\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use App\Filament\Resources\DocumentCategories\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentCategory extends EditRecord
{
    protected static string $resource = DocumentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
