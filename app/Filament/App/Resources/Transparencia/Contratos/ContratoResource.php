<?php

namespace App\Filament\App\Resources\Transparencia\Contratos;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\ListContrato;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\CreateContrato;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\EditContrato;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\ManageDocumentosContrato;
use App\Filament\App\Resources\Transparencia\Contratos\Pages\ViewContrato;
use App\Filament\Resources\Transparencia\Contratos\Schemas\ContratoForm;
use App\Filament\Resources\Transparencia\Contratos\Tables\ContratosTable;
use App\Models\TransparencyBid;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ContratoResource extends Resource
{
    protected static ?string $model = TransparencyBid::class;
    protected static ?string $modelLabel = 'Contrato';
    protected static ?string $slug = 'contratos';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-check';
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole('ucc');
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewContrato::class,
            EditContrato::class,
            ManageDocumentosContrato::class,
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return ContratoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContratosTable::configure($table);
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
            'index' => ListContrato::route('/'),
            'create' => CreateContrato::route('/create'),
            'view' => ViewContrato::route('/{record}'),
            'edit' => EditContrato::route('/{record}/edit'),
            'documentos' => ManageDocumentosContrato::route('/{record}/documentos'),
        ];
    }
}
