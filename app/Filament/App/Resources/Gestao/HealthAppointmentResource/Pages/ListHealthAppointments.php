<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointmentResource\Pages;

use App\Filament\App\Resources\Gestao\HealthAppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHealthAppointments extends ListRecords
{
    protected static string $resource = HealthAppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
