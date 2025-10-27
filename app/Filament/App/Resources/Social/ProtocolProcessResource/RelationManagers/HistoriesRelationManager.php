<?php

namespace App\Filament\App\Resources\Social\ProtocolProcessResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->heading('Movimentação')
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('group_sent.name')
                    ->label('Origem')
                    ->weight('medium'),
                TextColumn::make('group_received.name')
                    ->label('Destino')
                    ->weight('medium'),
                TextColumn::make('user_sent.person.name')
                    ->label('Tramitado por')
                    ->html()
                    ->formatStateUsing(fn($record) => '
                        <div style="font-size:11px;">
                            <b>' . e($record->date_sent) . '</b> - <i>Tramitado por:</i> <b>' . e(optional($record->user_sent->person)->name) . '</b>
                            <br>
                            ' . ($record->user_received
                                        ? '<b>' . e($record->date_received) . '</b> - <i>Recebido por:</i> <b>' . e(optional($record->user_received->person)->name) . '</b>'
                                        : ''
                                    ) . '
                        </div>
                    ')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-md break-words',
                    ]),
                TextColumn::make('parecer')
                    ->label('Despacho')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
