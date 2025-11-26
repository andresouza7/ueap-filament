<?php

namespace App\Filament\App\Resources\Gestao\Portarias\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PortariasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort(fn($query) => $query->orderBy('year', 'desc')->orderBy('number', 'desc'))
            ->columns([
                // Tables\Columns\TextColumn::make('id')->searchable(),
                TextColumn::make('number')
                    ->label('Nº')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Assunto/Descrição')
                    ->limit(70)
                    ->formatStateUsing(function ($state, $record) {
                        return sprintf("%s - %s", $record->subject, $state);
                    })
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
                TextColumn::make('origin')
                    ->label('Origem')
                    ->limit(30)
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
                Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
            ])
            ->toolbarActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
