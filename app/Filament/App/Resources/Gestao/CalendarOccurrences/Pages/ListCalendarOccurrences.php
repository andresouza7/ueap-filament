<?php

namespace App\Filament\App\Resources\Gestao\CalendarOccurrences\Pages;

use Filament\Actions\CreateAction;
use App\Filament\App\Resources\Gestao\CalendarOccurrences\CalendarOccurrenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalendarOccurrences extends ListRecords
{
    protected static string $resource = CalendarOccurrenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
