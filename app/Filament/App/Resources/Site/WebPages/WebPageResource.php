<?php

namespace App\Filament\App\Resources\Site\WebPages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Site\WebPages\Pages\ListWebPages;
use App\Filament\App\Resources\Site\WebPages\Pages\CreateWebPage;
use App\Filament\App\Resources\Site\WebPages\Pages\EditWebPage;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\App\Resources\Site\WebPageResource\Pages;
use App\Filament\App\Resources\Site\WebPages\RelationManagers\MenuItemsRelationManager;
use App\Models\WebMenu;
use App\Models\WebMenuPlace;
use App\Models\WebPage;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('title')
                        ->label('Título')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state) . '.html'))
                        ->maxLength(255),
                    TextInput::make('slug')
                        ->required()
                        ->suffixIcon('heroicon-m-globe-alt')
                        ->prefix('pagina/')
                        ->maxLength(255),
                    Select::make('web_category_id')
                        ->relationship('category', 'name')
                        ->preload()
                        ->searchable()
                        ->label('Categoria'),
                    Select::make('status')
                        ->required()
                        ->options([
                            'draft' => 'Rascunho',
                            'published' => 'Publicado',
                            'unpublished' => 'Despublicado'
                        ]),

                    RichEditor::make('text')
                        ->label('Texto')
                        ->required()
                        ->formatStateUsing(fn($state) => clean_text($state))
                        ->extraInputAttributes(['style' => 'min-height: 20rem;'])
                        ->disableToolbarButtons(['attachFiles'])
                        ->columnSpanFull(),
                    FileUpload::make('file')
                        ->label('Imagem JPG')
                        ->directory('web/pages')
                        ->acceptedFileTypes(['image/jpeg'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.jpg'),
                    Select::make('web_menu_id')
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
                            TextInput::make('name')
                                ->label('Nome')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->maxLength(255),
                            TextInput::make('slug')
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
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->words(7)
                    // ->description(fn(WebPage $record): string => Str::limit($record->slug, 20))
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('hits')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user_created')
                    ->label('Editado Por')
                    ->formatStateUsing(fn($record) => $record->user_updated?->login ?? $record->user_created->login),
                TextColumn::make('web_category_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('web_menu_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Última Edição')
                    ->dateTime('d/m/y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('user_created_id')
                    ->relationship('user_created', 'login')
                    ->searchable()
                    ->label('Autor'),
                SelectFilter::make('user_updated_id')
                    ->relationship('user_updated', 'login')
                    ->searchable()
                    ->label('Editado Por'),
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Rascunho',
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado'
                    ])
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
            'index' => ListWebPages::route('/'),
            'create' => CreateWebPage::route('/create'),
            // 'view' => Pages\ViewWebPage::route('/{record}'),
            'edit' => EditWebPage::route('/{record}/edit'),
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
