<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointments\Pages;

use App\Filament\App\Resources\Gestao\HealthAppointments\HealthAppointmentResource;
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
