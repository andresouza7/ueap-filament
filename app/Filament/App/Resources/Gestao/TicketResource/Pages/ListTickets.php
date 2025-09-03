<?php

namespace App\Filament\App\Resources\Gestao\TicketResource\Pages;

use App\Filament\App\Resources\Gestao\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
