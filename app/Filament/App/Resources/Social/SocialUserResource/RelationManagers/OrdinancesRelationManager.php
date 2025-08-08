<?php

namespace App\Filament\App\Resources\Social\SocialUserResource\RelationManagers;

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
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('year', 'DESC')->orderBy('number', 'DESC'))
            ->columns([
                Tables\Columns\TextColumn::make('number')->label('Número')->searchable(),
                Tables\Columns\TextColumn::make('year')->label('Ano')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Assunto')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Descrição')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Abrir')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
