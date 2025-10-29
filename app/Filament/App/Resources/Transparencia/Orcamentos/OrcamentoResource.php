<?php

namespace App\Filament\App\Resources\Transparencia\Orcamentos;

use App\Filament\App\Resources\Transparencia\Orcamentos\Pages\CreateOrcamento;
use App\Filament\App\Resources\Transparencia\Orcamentos\Pages\EditOrcamento;
use App\Filament\App\Resources\Transparencia\Orcamentos\Pages\ListOrcamentos;
use App\Filament\App\Resources\Transparencia\Orcamentos\Schemas\OrcamentoForm;
use App\Filament\App\Resources\Transparencia\Orcamentos\Tables\OrcamentosTable;
use App\Models\TransparencyOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class OrcamentoResource extends Resource
{
    protected static ?string $model = TransparencyOrder::class;

    protected static ?string $modelLabel = 'Orçamento';
    protected static ?string $pluralModelLabel = 'Orçamentos';
    protected static ?string $slug = 'orcamentos';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'title';

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole('uc');
    }

    public static function form(Schema $schema): Schema
    {
        return OrcamentoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrcamentosTable::configure($table);
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
            'index' => ListOrcamentos::route('/'),
            'create' => CreateOrcamento::route('/create'),
            'edit' => EditOrcamento::route('/{record}/edit'),
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
