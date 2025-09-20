<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\TestPortariaResource\Pages;
use App\Filament\App\Resources\Gestao\TestPortariaResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestPortariaResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $modelLabel = 'teste portaria';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canViewAny(): bool
    {
        return auth()->user()->types()->where('name', 'portaria')->exists();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'portaria');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->string()
                    ->maxLength(10),
                TextInput::make('description')
                    ->string(),
                TextInput::make('metadata.number')
                    ->numeric(),
                TextInput::make('metadata.origin')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Descrição')->searchable(),
                TextColumn::make('metadata.number')->label('Número')
                    ->searchable(query: fn($query, $search) => $query->where('metadata->number', 'ILIKE', "%{$search}%")),
                TextColumn::make('metadata.origin')->label('Origem')
                    ->searchable(query: fn($query, $search) => $query->where('metadata->origin', 'ILIKE', "%{$search}%")),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
}
