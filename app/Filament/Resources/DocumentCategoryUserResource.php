<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentCategoryResource\RelationManagers\DocumentsRelationManager;
use App\Filament\Resources\DocumentCategoryUserResource\Pages;
use App\Filament\Resources\DocumentCategoryUserResource\RelationManagers;
use App\Models\DocumentCategory;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DocumentCategoryUserResource extends Resource
{
    protected static ?string $model = DocumentCategory::class;
    protected static ?string $modelLabel = 'Documento';
    protected static ?string $pluralModelLabel = 'Documentos';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $slug = 'documentos-usuario';

    protected static ?string $navigationGroup = 'Documentos';
    // protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->label('Nome Categoria')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                //
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('slug')
                    ->badge(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge()
                    ->color(Color::Slate),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDocumentCategoryUsers::route('/'),
            // 'create' => Pages\CreateDocumentCategoryUser::route('/create'),
            'view' => Pages\ViewDocumentCategoryUser::route('/{record}'),
            'edit' => Pages\EditDocumentCategoryUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $userGroupIds = Auth::user()->groups->pluck('id')->toArray();

        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])->whereHas('groups', function ($query) use ($userGroupIds) {
                $query->whereIn('group_id', $userGroupIds);
            });
    }
}
