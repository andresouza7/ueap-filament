<?php

namespace App\Filament\Resources\CommissionedRoles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CommissionedRoleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort(fn(Builder $query) => $query->orderBy('position', 'asc')->orderBy('description'))
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('occupant.name')
                    ->label('Ocupante'),
                TextColumn::make('position')
                    ->label('Ordem')
                    ->numeric()
                    ->sortable(),
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
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
