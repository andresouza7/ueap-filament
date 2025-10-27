<?php

namespace App\Filament\App\Resources\Site\WebPageResource\Pages;

use Filament\Actions\EditAction;
use App\Filament\App\Resources\Site\WebPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebPage extends ViewRecord
{
    protected static string $resource = WebPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
