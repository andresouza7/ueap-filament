<?php

namespace App\Filament\App\Resources\Site\WebMenus;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Site\WebMenus\Pages\ListWebMenus;
use App\Filament\App\Resources\Site\WebMenus\Pages\CreateWebMenu;
use App\Filament\App\Resources\Site\WebMenus\Pages\ViewWebMenu;
use App\Filament\App\Resources\Site\WebMenus\Pages\EditWebMenu;
use App\Filament\App\Resources\Site\WebMenus\RelationManagers\ItemsRelationManager;
use App\Models\WebMenu;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebMenuResource extends Resource
{
    protected static ?string $model = WebMenu::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Select::make('web_menu_place_id')
                        ->label('Local')
                        ->searchable()
                        ->preload()
                        ->relationship('web_menu_place', 'name'),
                    TextInput::make('slug')
                        ->disabledOn('edit')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('description')
                        ->label('Descrição')
                        ->maxLength(255),
                    Select::make('status')
                        ->default('published')
                        ->options([
                            'published' => 'Publicado',
                            'unpublished' => 'Despublicado'
                        ])
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('web_menu_place.name')
                    ->label('Local')
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('items_count')
                    ->label('Itens')
                    ->counts('items')
                    ->numeric(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
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
                SelectFilter::make('web_menu_place_id')
                    ->label('Local')
                    ->relationship('menu_place', 'name')
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
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebMenus::route('/'),
            'create' => CreateWebMenu::route('/create'),
            'view' => ViewWebMenu::route('/{record}'),
            'edit' => EditWebMenu::route('/{record}/edit'),
        ];
    }
}
