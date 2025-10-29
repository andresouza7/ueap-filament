<?php

namespace App\Filament\App\Resources\Transparencia\Despesas;

use App\Filament\App\Resources\Transparencia\Despesas\Pages\CreateDespesa;
use App\Filament\App\Resources\Transparencia\Despesas\Pages\EditDespesa;
use App\Filament\App\Resources\Transparencia\Despesas\Pages\ListDespesas;
use App\Filament\App\Resources\Transparencia\Despesas\Schemas\DespesaForm;
use App\Filament\App\Resources\Transparencia\Despesas\Tables\DespesasTable;
use App\Models\TransparencyOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DespesaResource extends Resource
{
    protected static ?string $model = TransparencyOrder::class;

    protected static ?string $modelLabel = 'Despesa';
    protected static ?string $pluralModelLabel = 'Despesas';
    protected static ?string $slug = 'despesa';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'title';

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole('uf');
    }

    public static function form(Schema $schema): Schema
    {
        return DespesaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DespesasTable::configure($table);
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
            'index' => ListDespesas::route('/'),
            'create' => CreateDespesa::route('/create'),
            'edit' => EditDespesa::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
