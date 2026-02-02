<?php

namespace App\Filament\Resources\Social\WebPosts\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class WebPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Central de Publicações')
            ->description('Administre notícias, eventos e páginas do portal. Utilize os filtros de status e tipo para gerenciar o fluxo de publicações.')
            ->defaultSort('id', 'desc')
            ->columns([
                ImageColumn::make('image_url')->label('#'),
                TextColumn::make('title')
                    ->label('Título')
                    ->words(7)
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'news' => 'Notícia',
                        'event' => 'Evento',
                        'page' => 'Página',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'news' => 'success',
                        'event' => 'gray',
                        'page' => 'danger',
                    }),
                TextColumn::make('hits')
                    ->label('Acessos')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Data')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                TextColumn::make('user_created')
                    ->label('Editor')
                    ->formatStateUsing(fn($record) => $record->user_updated?->login ?? $record->user_created->login),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'gray',
                        'unpublished' => 'danger',
                    }),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'news' => 'Notícia',
                        'event' => 'Evento',
                        'page' => 'Página'
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'published' => 'Publicado',
                        'unpublished' => 'Não Publicado'
                    ]),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
                Action::make('download')
                    ->url(fn($record) => $record->image_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->image_url)
            ]);
    }
}
