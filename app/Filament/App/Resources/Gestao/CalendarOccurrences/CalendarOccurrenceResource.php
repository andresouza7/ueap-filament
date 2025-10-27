<?php

namespace App\Filament\App\Resources\Gestao\CalendarOccurrences;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Gestao\CalendarOccurrences\Pages\ListCalendarOccurrences;
use App\Filament\App\Resources\Gestao\CalendarOccurrences\Pages\CreateCalendarOccurrence;
use App\Filament\App\Resources\Gestao\CalendarOccurrences\Pages\EditCalendarOccurrence;
use App\Filament\App\Resources\Gestao\CalendarOccurrenceResource\Pages;
use App\Filament\App\Resources\Gestao\CalendarOccurrenceResource\RelationManagers;
use App\Models\CalendarOccurrence;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
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
        return $schema
            ->components([
                Section::make([
                    TextInput::make('description')
                        ->label('Descrição')
                        ->columnSpanFull()
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('start_date')
                        ->label('Data Início')
                        ->required(),
                    DatePicker::make('end_date')
                        ->label('Data Fim'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Data Início')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Data Fim')
                    ->date('d/m/Y')
                    ->sortable(),
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
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
