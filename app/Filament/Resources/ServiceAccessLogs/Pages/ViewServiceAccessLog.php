<?php

namespace App\Filament\Resources\ServiceAccessLogs\Pages;

use App\Filament\Resources\ServiceAccessLogs\ServiceAccessLogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceAccessLog extends ViewRecord
{
    protected static string $resource = ServiceAccessLogResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
