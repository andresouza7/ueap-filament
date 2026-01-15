<?php

namespace App\Filament\App\Resources\Gestao\Tickets\Pages;

use App\Filament\App\Resources\Gestao\Tickets\TicketResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTicket extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // habilite se quiser permitir criação:
            // CreateAction::make(),
        ];
    }
}
