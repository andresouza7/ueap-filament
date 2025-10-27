<?php

namespace App\Filament\App\Resources\Transparencia\Documents\Pages;

use App\Filament\App\Resources\Transparencia\Documents\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
