<?php

namespace App\Filament\Resources\DocumentCategoryUserResource\Pages;

use App\Filament\Resources\DocumentCategoryUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocumentCategoryUser extends ViewRecord
{
    protected static string $resource = DocumentCategoryUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
