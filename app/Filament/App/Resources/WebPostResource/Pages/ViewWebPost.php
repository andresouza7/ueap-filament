<?php

namespace App\Filament\App\Resources\WebPostResource\Pages;

use App\Filament\App\Resources\WebPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewWebPost extends ViewRecord
{
    protected static string $resource = WebPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
