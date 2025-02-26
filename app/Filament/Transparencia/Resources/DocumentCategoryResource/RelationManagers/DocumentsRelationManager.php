<?php

namespace App\Filament\Transparencia\Resources\DocumentCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->heading('Gerenciar Publicações')
            ->description('Mídia armazenada nos servidores da UEAP para exposição no portal da transparência.')
            ->defaultSort('year', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Título'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->words(4),
                Tables\Columns\TextColumn::make('year')
                    ->sortable()
                    ->label('Ano'),
                Tables\Columns\TextColumn::make('user_created.login')
                    ->searchable()
                    ->label('Autor'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->label('Data Publicação'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Publicar Documento'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
