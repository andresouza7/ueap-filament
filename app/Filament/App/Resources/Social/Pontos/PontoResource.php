<?php

namespace App\Filament\App\Resources\Social\Pontos;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Social\Pontos\Pages\ListPonto;
use App\Filament\App\Resources\Social\Pontos\Pages\CreatePonto;
use App\Filament\App\Resources\Social\Pontos\Pages\EditPonto;
use App\Filament\Resources\Social\Pontos\Schemas\PontoForm;
use App\Filament\Resources\Social\Pontos\Tables\PontosTable;
use App\Models\CalendarOccurrence;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PontoResource extends Resource
{
    // o unico recurso gerenciavel será o das ocorrencias de ponto
    protected static ?string $model = CalendarOccurrence::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Ocorrência do Ponto';
    protected static ?string $pluralModelLabel = 'Ocorrências do Ponto';
    protected static bool $shouldRegisterNavigation = false;
    protected static bool $shouldSkipAuthorization = true;

    public static function form(Schema $schema): Schema
    {
        return PontoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PontosTable::configure($table);
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
            'index' => ListPonto::route('/'),
            'create' => CreatePonto::route('/create'),
            'edit' => EditPonto::route('/{record}/edit'),
        ];
    }
}
