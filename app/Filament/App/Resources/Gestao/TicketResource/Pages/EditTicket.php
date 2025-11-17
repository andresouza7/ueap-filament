<?php

namespace App\Filament\App\Resources\Gestao\TicketResource\Pages;

use App\Filament\App\Resources\Gestao\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('view')
                ->label('Visualizar')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) => TicketResource::getUrl('view', ['record' => $record])),

            Actions\DeleteAction::make(),
        ];
    }
}
