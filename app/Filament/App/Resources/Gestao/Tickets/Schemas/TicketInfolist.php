<?php

namespace App\Filament\App\Resources\Gestao\Tickets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.person.name'),
                TextEntry::make('month'),
                TextEntry::make('year'),
                TextEntry::make('user_notes'),
            ]);
    }
}
