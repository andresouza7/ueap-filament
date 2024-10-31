<?php

namespace App\Filament\Rh\Resources\DocumentOrdinanceResource\Pages;

use App\Filament\Rh\Resources\DocumentOrdinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocumentOrdinance extends ViewRecord
{
    protected static string $resource = DocumentOrdinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
