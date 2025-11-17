<?php

namespace App\Filament\App\Resources\Gestao\TicketResource\Pages;

use App\Filament\App\Resources\Gestao\TicketResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
