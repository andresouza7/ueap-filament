<?php

namespace App\Filament\Resources\ServiceAccessLogs\Pages;

use App\Filament\Resources\ServiceAccessLogs\ServiceAccessLogResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceAccessLog extends EditRecord
{
    protected static string $resource = ServiceAccessLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
        ];
    }
}
