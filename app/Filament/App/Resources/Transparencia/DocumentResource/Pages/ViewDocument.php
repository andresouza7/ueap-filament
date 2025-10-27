<?php

namespace App\Filament\App\Resources\Transparencia\DocumentResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDocument extends ViewRecord
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
