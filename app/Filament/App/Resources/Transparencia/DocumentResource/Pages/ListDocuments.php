<?php

namespace App\Filament\App\Resources\Transparencia\DocumentResource\Pages;

use App\Filament\App\Resources\Transparencia\DocumentResource;
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
