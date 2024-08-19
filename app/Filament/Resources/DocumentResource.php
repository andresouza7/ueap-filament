<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Filament\Resources\DocumentResource\RelationManagers;
use App\Models\Document;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    protected static ?string $modelLabel = 'Documento';
    // protected static ?string $pluralModelLabel = 'Setores';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $slug = 'documentos';

    protected static ?string $navigationGroup = 'Site';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Tipo')
                    ->options(DocumentCategory::pluck('name', 'slug')->toArray())
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Rascunho',
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('year')
                    ->label('Ano')
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('anexo')
                    ->openable()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->limit(60)
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_updated.login')
                    ->label('Editado Por')
                    ->sortable(),
                // SpatieMediaLibraryImageColumn::make('anexo'),
                Tables\Columns\TextColumn::make('user_created.login')
                    ->toggleable(isToggledHiddenByDefault: true)
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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('anexo')
                    ->label('Baixar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Model $record) => $record->getFirstMediaUrl()) // Adjust to your media method
                    ->openUrlInNewTab()
                    ->disabled(fn(Model $record) => empty($record->getFirstMediaUrl())),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
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
