<?php

namespace App\Filament\Resources\DocumentCategories;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\Resources\DocumentCategories\Pages\ListDocumentCategories;
use App\Filament\Resources\DocumentCategories\Pages\CreateDocumentCategory;
use App\Filament\Resources\DocumentCategories\Pages\EditDocumentCategory;
use App\Filament\Resources\DocumentCategoryResource\Pages;
use App\Filament\Resources\DocumentCategoryResource\RelationManagers;
use App\Filament\Resources\DocumentCategories\RelationManagers\GroupsRelationManager;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentCategoryResource extends Resource
{
    protected static ?string $model = DocumentCategory::class;
    protected static ?string $modelLabel = 'Categoria de Documento';
    protected static ?string $pluralModelLabel = 'Categorias de Documentos';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $slug = 'categoria-documento';
    protected static string | \UnitEnum | null $navigationGroup = 'Gerência';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('description')
                //     ->maxLength(255),
                Select::make('status')
                    ->options([
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado'
                    ])
                    ->required(),
                Select::make('type')
                    ->label('Tipo')
                    ->required()
                    ->options([
                        'general' => 'Geral',
                        'transparency' => 'Transparência'
                    ])
                    ->default('general'),
                Select::make('groups')
                    ->label('Liberar acesso para')
                    ->relationship('groups', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->columns([
                TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                // New column for displaying group names
                TextColumn::make('groups.name')
                    ->label('Acesso liberado para')
                    ->wrap()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->groups->pluck('name')->join(', ');
                    })
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
                TrashedFilter::make(),
                SelectFilter::make('type')
                    ->options([
                        'transparency' => 'Transparência',
                        'general' => 'Geral'
                    ])
            ])
            ->recordActions([
                EditAction::make(),
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
            // GroupsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDocumentCategories::route('/'),
            'create' => CreateDocumentCategory::route('/create'),
            'edit' => EditDocumentCategory::route('/{record}/edit'),
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
