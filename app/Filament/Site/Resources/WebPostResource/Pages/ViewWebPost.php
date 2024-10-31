<?php

namespace App\Filament\Site\Resources\WebPostResource\Pages;

use App\Filament\Site\Resources\WebPostResource;
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
