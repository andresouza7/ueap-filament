<?php

namespace App\Filament\Site\Resources;

use App\Filament\Site\Resources\WebPageResource\Pages;
use App\Filament\Site\Resources\WebPageResource\RelationManagers;
use App\Filament\Site\Resources\WebPageResource\RelationManagers\MenuItemsRelationManager;
use App\Models\WebMenu;
use App\Models\WebMenuItem;
use App\Models\WebMenuPlace;
use App\Models\WebPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class WebPageResource extends Resource
{
    protected static ?string $model = WebPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Site';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state) . '.html'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->suffixIcon('heroicon-m-globe-alt')
                    ->prefix('campo automático')
                    ->maxLength(255),
                Forms\Components\Select::make('web_category_id')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable()
                    ->label('Categoria'),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'draft' => 'Rascunho',
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado'
                    ]),
                Forms\Components\RichEditor::make('text')
                    ->label('Texto')
                    ->required()
                    ->extraInputAttributes(['style' => 'min-height: 20rem; max-height: 50vh; overflow-y: auto;'])
                    ->columnSpanFull(),
                Forms\Components\Select::make('web_menu_id')
                    ->hiddenOn('create')
                    ->label('Exibir menu nesta página?')
                    ->helperText('Escolha um menu lateral para esta página ou crie um novo.')
                    ->searchable()
                    ->preload()
                    ->relationship('web_menu', 'name', function ($query) {
                        $query->whereHas('web_menu_place', function ($query) {
                            $query->where('slug', 'pagina');
                        });
                    })
                    // ->getOptionLabelFromRecordUsing(fn($record) => "{$record->name} xxx")
                    ->createOptionModalHeading('Criar menu para esta página')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->unique('web_menus', 'slug')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data): int {
                        $menu_place_pagina = WebMenuPlace::where('slug', 'pagina')->first();
                        $data['web_menu_place_id'] = $menu_place_pagina->id;
                        $data['status'] = 'published';

                        $last_menu = WebMenu::latest('id')->first();
                        $data['position'] = $last_menu ? $last_menu->id : 1;

                        $data['uuid'] = Str::uuid();
                        return WebMenu::create($data)->getKey();
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->limit(50)
                    ->description(fn(WebPage $record): string => Str::limit($record->slug, 20))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('hits')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_updated.login')
                    ->label('Editado Por')
                    ->sortable(),
                Tables\Columns\TextColumn::make('web_category_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('web_menu_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('user_updated.login')
                    ->label('Editado Por'),
                SelectFilter::make('status')
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            // WebMenuRelationManager::class
            MenuItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebPages::route('/'),
            'create' => Pages\CreateWebPage::route('/create'),
            // 'view' => Pages\ViewWebPage::route('/{record}'),
            'edit' => Pages\EditWebPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
