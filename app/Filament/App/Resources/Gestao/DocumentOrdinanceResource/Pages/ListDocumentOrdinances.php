<?php

namespace App\Filament\App\Resources\Gestao\DocumentOrdinanceResource\Pages;

use App\Filament\App\Resources\Gestao\DocumentOrdinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentOrdinances extends ListRecords
{
    protected static string $resource = DocumentOrdinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
