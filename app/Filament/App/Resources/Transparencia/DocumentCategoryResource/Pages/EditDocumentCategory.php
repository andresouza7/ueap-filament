<?php

namespace App\Filament\Transparencia\Resources\DocumentCategoryResource\Pages;

use App\Filament\Transparencia\Resources\DocumentCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentCategory extends EditRecord
{
    protected static string $resource = DocumentCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [];
    }

 public function getTitle(): string
    {
        return $this->record->name;
    }

    public function getBreadcrumb(): string
    {
        return $this->record->slug;
    }

}
