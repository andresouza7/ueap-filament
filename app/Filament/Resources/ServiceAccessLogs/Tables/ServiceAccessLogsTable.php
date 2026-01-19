<?php

namespace App\Filament\Resources\ServiceAccessLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceAccessLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.login')
                    ->label('Usuário')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('service')
                    ->label('Serviço')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('action_type')
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
                TextColumn::make('target_record')
                    ->label('Alvo')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('created_at')
                    ->label('Data/Hora')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }
}
