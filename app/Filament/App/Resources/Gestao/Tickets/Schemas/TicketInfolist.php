<?php

namespace App\Filament\App\Resources\Gestao\Tickets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalhes da solicitação')
                    ->schema([
                        TextEntry::make('user.person.name')
                            ->label('Nome'),
                        TextEntry::make('month')
                            ->label('Mês'),
                        TextEntry::make('year')
                            ->label('Ano'),
                        TextEntry::make('user_notes')
                            ->label('Observações do usuário')
                            ->columnSpanFull(),
                    ])->columns(3)
            ]);
    }
}
