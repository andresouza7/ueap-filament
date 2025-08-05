<?php

namespace App\Filament\Site\Resources;

use App\Filament\Site\Resources\WebMenuPlaceResource\Pages;
use App\Filament\Site\Resources\WebMenuPlaceResource\RelationManagers;
use App\Filament\Site\Resources\WebMenuPlaceResource\RelationManagers\MenusRelationManager;
use App\Models\WebMenuPlace;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebMenuPlaceResource extends Resource
{
    protected static ?string $model = WebMenuPlace::class;
    protected static ?string $modelLabel = 'Posição de Menu';
    protected static ?string $pluralModelLabel = 'Posições de Menu';
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Site';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('web_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                Tables\Columns\TextColumn::make('menus_count')
                    ->label('Menus Filhos')
                    ->counts('menus')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('web_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            MenusRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebMenuPlaces::route('/'),
            'create' => Pages\CreateWebMenuPlace::route('/create'),
            'view' => Pages\ViewWebMenuPlace::route('/{record}'),
            'edit' => Pages\EditWebMenuPlace::route('/{record}/edit'),
        ];
    }
}
