<?php

namespace App\Filament\Rh\Resources\CalendarOccurrenceResource\Pages;

use App\Filament\Rh\Resources\CalendarOccurrenceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCalendarOccurrence extends CreateRecord
{
    protected static string $resource = CalendarOccurrenceResource::class;

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = null;
        $data['type'] = 1;

        return $data;
    }
}
