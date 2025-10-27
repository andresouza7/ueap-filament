<?php

namespace App\Filament\Resources\EffectiveRoles;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\Resources\EffectiveRoles\Pages\ListEffectiveRoles;
use App\Filament\Resources\EffectiveRoles\Pages\CreateEffectiveRole;
use App\Filament\Resources\EffectiveRoles\Pages\EditEffectiveRole;
use App\Filament\Resources\EffectiveRoleResource\Pages;
use App\Filament\Resources\EffectiveRoleResource\RelationManagers;
use App\Models\EffectiveRole;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EffectiveRoleResource extends Resource
{
    protected static ?string $model = EffectiveRole::class;
    protected static ?string $modelLabel = 'Cargo Efetivo';
    protected static ?string $pluralModelLabel = 'Cargos Efetivos';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $slug = 'cargo-efetivo';
    protected static string | \UnitEnum | null $navigationGroup = 'Gerência';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->label('Descrição')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('description')
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEffectiveRoles::route('/'),
            'create' => CreateEffectiveRole::route('/create'),
            'edit' => EditEffectiveRole::route('/{record}/edit'),
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
