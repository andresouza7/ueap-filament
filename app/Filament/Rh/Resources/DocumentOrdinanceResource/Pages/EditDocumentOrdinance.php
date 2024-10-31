<?php

namespace App\Filament\Rh\Resources\DocumentOrdinanceResource\Pages;

use App\Filament\Rh\Resources\DocumentOrdinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentOrdinance extends EditRecord
{
    protected static string $resource = DocumentOrdinanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
