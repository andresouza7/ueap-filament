<?php

namespace App\Filament\App\Resources\Gestao\CalendarOccurrenceResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\App\Resources\Gestao\CalendarOccurrenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalendarOccurrence extends EditRecord
{
    protected static string $resource = CalendarOccurrenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
