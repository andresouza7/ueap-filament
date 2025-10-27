<?php

namespace App\Filament\App\Resources\Gestao\CalendarOccurrences;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Gestao\CalendarOccurrences\Pages\ListCalendarOccurrences;
use App\Filament\App\Resources\Gestao\CalendarOccurrences\Pages\CreateCalendarOccurrence;
use App\Filament\App\Resources\Gestao\CalendarOccurrences\Pages\EditCalendarOccurrence;
use App\Filament\Resources\Gestao\CalendarOccurrences\Schemas\CalendarOccurenceForm;
use App\Filament\Resources\Gestao\CalendarOccurrences\Tables\CalendarOccurrencesTable;
use App\Models\CalendarOccurrence;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

// TIPOS DE OCORRENCIA:
// type 1 = ocorrencia geral cadastrada pela urh
// type 2 = afastamento de usuario cadastrado pela urh (ferias, licenca, ect)
// type 3 = ocorrencia geral cadastrada pelo usuario

class CalendarOccurrenceResource extends Resource
{
    protected static ?string $model = CalendarOccurrence::class;
    protected static ?string $modelLabel = 'Ocorrência de Ponto';
    protected static ?string $pluralModelLabel = 'Ocorrências de Ponto';

    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clock';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return CalendarOccurenceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CalendarOccurrencesTable::configure($table);
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
            'index' => ListCalendarOccurrences::route('/'),
            'create' => CreateCalendarOccurrence::route('/create'),
            'edit' => EditCalendarOccurrence::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 1)->whereYear('start_date', Carbon::now()->year);
    }
}
