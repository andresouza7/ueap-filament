<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialCommissionedResource\Pages;
use App\Filament\Resources\SocialCommissionedResource\RelationManagers;
use App\Models\CommissionedRole;
use App\Models\SocialCommissioned;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialCommissionedResource extends Resource
{
    protected static ?string $model = CommissionedRole::class;
    protected static ?string $modelLabel = 'Cargo Comissionado';
    protected static ?string $pluralModelLabel = 'Cargos Comissionados';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $slug = 'social-commissioned';

    protected static ?string $navigationGroup = 'Social';
    protected static ?int $navigationSort = 4;

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
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('occupant.login')
                    ->label('Ocupante')
                    ->formatStateUsing(fn($state) => $state ?? '-') // Display '-' if null
                    ->url(fn($record) => $record->occupant ? SocialUserResource::getUrl('view', ['record' => $record->occupant->id]) : null) // Generate URL only if occupant exists
                    ->searchable()
            ])
            ->filters([
                Filter::make('without_occupant')
                    ->label('Cargos Vagos')
                    ->query(fn(Builder $query) => $query->whereDoesntHave('occupant')),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialCommissioneds::route('/'),
            // 'create' => Pages\CreateSocialCommissioned::route('/create'),
            // 'view' => Pages\ViewSocialCommissioned::route('/{record}'),
            // 'edit' => Pages\EditSocialCommissioned::route('/{record}/edit'),
        ];
    }
}
