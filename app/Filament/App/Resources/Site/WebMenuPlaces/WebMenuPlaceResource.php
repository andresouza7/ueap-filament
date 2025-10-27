<?php

namespace App\Filament\App\Resources\Site\WebMenuPlaces;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Site\WebMenuPlaces\Pages\ListWebMenuPlaces;
use App\Filament\App\Resources\Site\WebMenuPlaces\Pages\CreateWebMenuPlace;
use App\Filament\App\Resources\Site\WebMenuPlaces\Pages\ViewWebMenuPlace;
use App\Filament\App\Resources\Site\WebMenuPlaces\Pages\EditWebMenuPlace;
use App\Filament\App\Resources\Site\WebMenuPlaceResource\Pages;
use App\Filament\App\Resources\Site\WebMenuPlaceResource\RelationManagers;
use App\Filament\App\Resources\Site\WebMenuPlaces\RelationManagers\MenusRelationManager;
use App\Models\WebMenuPlace;
use Filament\Forms;
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

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('web_id')
                    ->required()
                    ->numeric(),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('description')
                    ->maxLength(255),
                TextInput::make('uuid')
                    ->label('UUID')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('menus_count')
                    ->label('Menus Filhos')
                    ->counts('menus')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('web_id')
                    ->numeric()
                    ->sortable(),
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
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
            'index' => ListWebMenuPlaces::route('/'),
            'create' => CreateWebMenuPlace::route('/create'),
            'view' => ViewWebMenuPlace::route('/{record}'),
            'edit' => EditWebMenuPlace::route('/{record}/edit'),
        ];
    }
}
