<?php

namespace App\Filament\Resources\WebPageResource\Pages;

use App\Filament\Resources\WebPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebPage extends ViewRecord
{
    protected static string $resource = WebPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
