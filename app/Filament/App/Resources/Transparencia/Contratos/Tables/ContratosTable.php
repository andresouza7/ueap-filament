<?php

namespace App\Filament\App\Resources\Transparencia\Contratos\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ContratosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('year', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'contrato'))
            ->columns([
                TextColumn::make('number')
                    ->label('Número')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->words(20)->wrap(),
                TextColumn::make('hits')
                    ->label('Acessos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
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
            ->filters([
                //
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
