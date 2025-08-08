<?php

namespace App\Filament\Rh\Resources\CalendarOccurrenceResource\Pages;

use App\Filament\Rh\Resources\CalendarOccurrenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalendarOccurrence extends EditRecord
{
    protected static string $resource = CalendarOccurrenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
