<?php

namespace App\Filament\Resources\ServiceAccessLogs\Pages;

use App\Filament\Resources\ServiceAccessLogs\ServiceAccessLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceAccessLogs extends ListRecords
{
    protected static string $resource = ServiceAccessLogResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
