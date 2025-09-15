<?php

namespace App\Filament\App\Resources\Transparencia;

use App\Filament\App\Resources\Transparencia\DocumentResource\Pages;
use App\Filament\Resources\DocumentCategoryResource\RelationManagers\DocumentsRelationManager;
use App\Models\DocumentCategory;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DocumentResource extends Resource
{
    protected static ?string $model = DocumentCategory::class;
    protected static ?string $modelLabel = 'Documento';
    protected static ?string $pluralModelLabel = 'Documentos';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $slug = 'documentos-transparencia';

    protected static ?string $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 0;

    public static function canAccess(): bool
    {
        return Auth::user()->hasDocumentCategory('transparency');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->heading('Categorias de Documentos')
            ->description('Você tem acesso às categorias abaixo. Selecione uma delas para visualizar e gerenciar os documentos.')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'transparency'))
            ->columns([
                //
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('slug')
                    ->badge(),
                // TextColumn::make('type')
                //     ->label('Tipo')
                //     ->badge()
                //     ->color(Color::Slate),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
            DocumentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            // 'create' => Pages\CreateDocumentCategoryUser::route('/create'),
            // 'view' => Pages\ViewDocumentCategoryUser::route('/{record}'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $userGroupIds = Auth::user()->groups->pluck('id')->toArray();

        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            // ->where('type', 'general')
            ->whereHas('groups', function ($query) use ($userGroupIds) {
                $query->whereIn('group_id', $userGroupIds);
            });
    }
}
