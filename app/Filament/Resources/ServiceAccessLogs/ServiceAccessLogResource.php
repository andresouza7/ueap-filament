<?php

namespace App\Filament\Resources\ServiceAccessLogs;

// use App\Filament\Resources\ServiceAccessLogs\Pages\CreateServiceAccessLog;
// use App\Filament\Resources\ServiceAccessLogs\Pages\EditServiceAccessLog;
use App\Filament\Resources\ServiceAccessLogs\Pages\ListServiceAccessLogs;
use App\Filament\Resources\ServiceAccessLogs\Pages\ViewServiceAccessLog;
use App\Filament\Resources\ServiceAccessLogs\Schemas\ServiceAccessLogForm;
use App\Filament\Resources\ServiceAccessLogs\Schemas\ServiceAccessLogInfolist;
use App\Filament\Resources\ServiceAccessLogs\Tables\ServiceAccessLogsTable;
use App\Models\ServiceAccessLog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ServiceAccessLogResource extends Resource
{
    protected static ?string $model = ServiceAccessLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEye;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ServiceAccessLogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceAccessLogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceAccessLogsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected static ?string $navigationLabel = 'Logs de Acesso';
    protected static UnitEnum|string|null $navigationGroup = 'Gerência';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceAccessLogs::route('/'),
            'view' => ViewServiceAccessLog::route('/{record}'),
        ];
    }
}
