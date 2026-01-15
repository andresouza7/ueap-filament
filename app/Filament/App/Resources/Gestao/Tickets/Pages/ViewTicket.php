<?php

namespace App\Filament\App\Resources\Gestao\Tickets\Pages;

use App\Filament\App\Resources\Gestao\Tickets\TicketResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
