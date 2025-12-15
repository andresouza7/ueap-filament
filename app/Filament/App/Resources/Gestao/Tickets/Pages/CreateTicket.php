<?php

namespace App\Filament\App\Resources\Gestao\Tickets\Pages;

use App\Filament\App\Resources\Gestao\Tickets\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}
