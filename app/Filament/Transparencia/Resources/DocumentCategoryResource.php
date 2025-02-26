<?php

namespace App\Filament\Transparencia\Resources;

use App\Filament\Transparencia\Resources\DocumentCategoryResource\Pages;
use App\Filament\Transparencia\Resources\DocumentCategoryResource\RelationManagers\DocumentsRelationManager;
use App\Models\DocumentCategory;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentCategoryResource extends Resource
{
    protected static ?string $model = DocumentCategory::class;
    protected static ?string $modelLabel = 'Documento';
    // protected static ?string $pluralModelLabel = 'Documentos Transparência';
    protected static ?string $slug = 'documentos';
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name')
            ->modifyQueryUsing(function (Builder $query) {
                // filtrar categorias de documentos da transparencia
                $query->where('type', 'transparency');

                // filtrar se o usuario tem a permissao do grupo que pode acessar essas categorias 
                $query->whereHas('groups', function ($query) {
                    // Get the IDs of the groups the user belongs to
                    $userGroupIds = auth()->user()->groups->pluck('id')->toArray();
                    $query->whereIn('group_id', $userGroupIds);
                });
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Categoria')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->badge(),
                Tables\Columns\TextColumn::make('documents_count')
                    ->label('Documentos')
                    ->counts('documents'),
                Tables\Columns\TextColumn::make('groups.name')
                    ->label('Acesso liberado para')
                    ->wrap()
                    ->formatStateUsing(function ($state, $record) {
                        return $record->groups->pluck('name')->join(', ');
                    })
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            DocumentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentCategories::route('/'),
            'edit' => Pages\EditDocumentCategory::route('/{record}/edit'),
        ];
    }
}
