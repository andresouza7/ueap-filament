<?php

namespace App\Filament\App\Resources\Social\ProtocolProcessResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
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
                Tables\Columns\TextColumn::make('group_sent.name')
                    ->label('Origem')
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('group_received.name')
                    ->label('Destino')
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('user_sent.person.name')
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
                Tables\Columns\TextColumn::make('parecer')
                    ->label('Despacho')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
