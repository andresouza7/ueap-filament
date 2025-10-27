<?php

namespace App\Filament\Resources\DocumentCategories\Pages;

use App\Filament\Resources\DocumentCategories\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocumentCategory extends CreateRecord
{
    protected static string $resource = DocumentCategoryResource::class;
}
