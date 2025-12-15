<?php

namespace App\Filament\App\Resources\Social\ProtocolProcesses\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProtocolProcessesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('number')
                    ->label('Processo')
                    ->searchable(isIndividual: true),
                TextColumn::make('subject.description')
                    ->label('Serviço')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                TextColumn::make('person.name')
                    ->label('Interessado')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(isIndividual: true),
                TextColumn::make('group_received.description')
                    ->label('Último Trâmite')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ]);
    }
}
