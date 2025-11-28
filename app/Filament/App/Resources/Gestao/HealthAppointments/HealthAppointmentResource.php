<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointments;

use Filament\Schemas\Schema;
use App\Filament\App\Resources\Gestao\HealthAppointments\Pages\ListHealthAppointments;
use App\Filament\App\Resources\Gestao\HealthAppointments\Pages\CreateHealthAppointment;
use App\Filament\App\Resources\Gestao\HealthAppointments\Pages\ViewHealthAppointment;
use App\Filament\App\Resources\Gestao\HealthAppointments\Schemas\HealthAppointmentForm;
use App\Filament\App\Resources\Gestao\HealthAppointments\Schemas\HealthAppointmentInfolist;
use App\Filament\App\Resources\Gestao\HealthAppointments\Tables\HealthAppointmentsTable;
use App\Models\HealthAppointment;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HealthAppointmentResource extends Resource
{
    protected static ?string $model = HealthAppointment::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-heart';
    protected static ?string $modelLabel = 'Saúde e Bem-Estar';
    protected static ?string $pluralModelLabel = 'Saúde e Bem-Estar';
    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';
    protected static ?int $navigationSort = 7;

    public static function infolist(Schema $schema): Schema
    {
        return HealthAppointmentInfolist::configure($schema);
    }

    public static function form(Schema $schema): Schema
    {
        return HealthAppointmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HealthAppointmentsTable::configure($table);
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
            'index' => ListHealthAppointments::route('/'),
            'create' => CreateHealthAppointment::route('/create'),
            'view' => ViewHealthAppointment::route('/{record}'),
            // 'edit' => Pages\EditHealthAppointment::route('/{record}/edit'),
        ];
    }
}
