<?php

namespace App\Filament\Resources\DocumentCategories\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\DocumentCategories\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentCategories extends ListRecords
{
    protected static string $resource = DocumentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
