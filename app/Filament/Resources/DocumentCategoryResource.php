<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentCategoryResource\Pages;
use App\Filament\Resources\DocumentCategoryResource\RelationManagers;
use App\Filament\Resources\DocumentCategoryResource\RelationManagers\GroupsRelationManager;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $slug = 'categoria-documento';

    protected static ?string $navigationGroup = 'Gerência';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('description')
                //     ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado'
                    ])
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Tipo')
                    ->required()
                    ->options([
                        'general' => 'Geral',
                        'transparency' => 'Transparência'
                    ])
                    ->default('general'),
                Forms\Components\Select::make('groups')
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
                // Tables\Columns\TextColumn::make('id')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                // New column for displaying group names
                Tables\Columns\TextColumn::make('groups.name')
                    ->label('Acesso liberado para')
                    ->wrap()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->groups->pluck('name')->join(', ');
                    })
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
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'transparency' => 'Transparência',
                        'general' => 'Geral'
                    ])
            ])
            ->actions([
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
            // GroupsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentCategories::route('/'),
            'create' => Pages\CreateDocumentCategory::route('/create'),
            'edit' => Pages\EditDocumentCategory::route('/{record}/edit'),
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
