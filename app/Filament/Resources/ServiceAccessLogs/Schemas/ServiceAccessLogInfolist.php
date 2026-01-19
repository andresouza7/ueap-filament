<?php

namespace App\Filament\Resources\ServiceAccessLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ServiceAccessLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Usuário'),
                TextEntry::make('service')
                    ->label('Serviço'),
                TextEntry::make('action_type')
                    ->label('Ação')
                    ->badge()
                    ->colors([
                        'success' => 'create',
                        'info' => 'read',
                        'warning' => 'edit',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'create' => 'Criação',
                        'read'   => 'Visualização',
                        'edit'   => 'Edição',
                        default  => $state,
                    }),
                TextEntry::make('target_record')
                    ->label('Alvo'),
                \Filament\Infolists\Components\KeyValueEntry::make('details')
                    ->label('Detalhes'),
                TextEntry::make('created_at')
                    ->label('Data/Hora')
                    ->dateTime('d/m/Y H:i:s'),
            ]);
    }
}
