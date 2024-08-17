<?php

namespace App\Filament\Resources\WebPostResource\Pages;

use App\Filament\Resources\WebPostResource;
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
