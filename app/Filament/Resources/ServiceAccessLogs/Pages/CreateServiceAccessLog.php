<?php

namespace App\Filament\Resources\ServiceAccessLogs\Pages;

use App\Filament\Resources\ServiceAccessLogs\ServiceAccessLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceAccessLog extends CreateRecord
{
    protected static string $resource = ServiceAccessLogResource::class;
}
