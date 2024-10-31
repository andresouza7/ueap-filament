<?php

namespace App\Filament\Site\Resources;

use App\Filament\Site\Resources\WebMenuResource\Pages;
use App\Filament\Site\Resources\WebMenuResource\RelationManagers;
use App\Filament\Site\Resources\WebMenuResource\RelationManagers\ItemsRelationManager;
use App\Models\WebMenu;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebMenuResource extends Resource
{
    protected static ?string $model = WebMenu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Site';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('web_menu_place_id')
                    ->label('Local')
                    ->searchable()
                    ->preload()
                    ->relationship('web_menu_place', 'name'),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->maxLength(255),
                Select::make('status')
                    ->default('published')
                    ->options([
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado'
                    ])
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
                Tables\Columns\TextColumn::make('web_menu_place.name')
                    ->label('Local')
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Itens')
                    ->counts('items')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
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
                SelectFilter::make('web_menu_place_id')
                    ->label('Local')
                    ->relationship('menu_place', 'name')
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
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebMenus::route('/'),
            'create' => Pages\CreateWebMenu::route('/create'),
            'view' => Pages\ViewWebMenu::route('/{record}'),
            'edit' => Pages\EditWebMenu::route('/{record}/edit'),
        ];
    }
}
