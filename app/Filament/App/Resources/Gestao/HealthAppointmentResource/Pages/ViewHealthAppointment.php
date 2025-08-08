<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointmentResource\Pages;

use App\Filament\App\Resources\Gestao\HealthAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHealthAppointment extends ViewRecord
{
    protected static string $resource = HealthAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
