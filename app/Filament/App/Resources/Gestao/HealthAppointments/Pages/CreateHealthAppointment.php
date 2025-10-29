<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointments\Pages;

use App\Filament\App\Resources\Gestao\HealthAppointments\HealthAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHealthAppointment extends CreateRecord
{
    protected static string $resource = HealthAppointmentResource::class;
}
