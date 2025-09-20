<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\TestAtaResource\Pages;
use App\Filament\App\Resources\Gestao\TestAtaResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestAtaResource extends Resource
{
    protected static ?string $model = Test::class;
    
    protected static ?string $modelLabel = 'consu ata';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canViewAny(): bool
    {
        return auth()->user()->types()->where('name', 'consu_ata')->exists();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'consu_ata');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255),
                TextInput::make('description')
                    ->maxLength(255),
                TextInput::make('year')
                    ->numeric(),
                TextInput::make('metadata.issuer')
                    ->string()
                    ->required(),
                DatePicker::make('metadata.issuance_date')
                    ->date()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('metadata.issuer'),
                Tables\Columns\TextColumn::make('metadata.issuance_date'),
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
