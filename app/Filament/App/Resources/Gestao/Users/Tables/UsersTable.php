<?php

namespace App\Filament\Resources\Gestao\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('login')
            ->columns([
                TextColumn::make('person.name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('group.name')
                    ->label('Lotação')
                    ->sortable(),
                TextColumn::make('effective_role.description')
                    ->label('Cargo Efetivo')
                    ->limit(30)
                    ->sortable(),
                TextColumn::make('commissioned_role.description')
                    ->label('Cargo Comissionado')
                    ->badge()
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
                // Tables\Filters\TrashedFilter::make(),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                Action::make('imprimirPonto')
                    ->label('Ponto')
                    ->icon('heroicon-o-document')
                    ->url(fn($record) => route('filament.app.pages.print-frequency', ['user' => $record->id]))
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }
}
