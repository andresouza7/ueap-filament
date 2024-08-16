<?php

namespace App\Filament\Resources\SocialUserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdinancesRelationManager extends RelationManager
{
    protected static string $relationship = 'ordinances';
    protected static ?string $modelLabel = 'Portaria';
    protected static ?string $title = 'Portarias';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('number')->label('Número')->searchable(),
                Tables\Columns\TextColumn::make('year')->label('Ano')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Assunto')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Descrição')->searchable(),
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
