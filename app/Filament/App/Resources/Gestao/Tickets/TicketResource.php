<?php

namespace App\Filament\App\Resources\Gestao\Tickets;

use App\Filament\App\Resources\Gestao\Tickets\Pages;
use App\Filament\App\Resources\Gestao\Tickets\Schemas\TicketForm;
use App\Filament\App\Resources\Gestao\Tickets\Schemas\TicketInfolist;
use App\Filament\App\Resources\Gestao\Tickets\Tables\TicketsTable;
use App\Models\Ticket;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;
    protected static ?int $navigationSort = 8;
    protected static bool $shouldRegisterNavigation = false;

    public static function getModelLabel(): string
    {
        return 'Encaminhamento de Ponto';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Encaminhamento de Ponto';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Gestão';
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-rectangle-stack';
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketInfolist::configure($schema);
    }

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTicket::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
