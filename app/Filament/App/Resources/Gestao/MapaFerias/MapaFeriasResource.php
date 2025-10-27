<?php

namespace App\Filament\App\Resources\Gestao\MapaFerias;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Throwable;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Gestao\MapaFerias\Pages\ListFerias;
use App\Filament\App\Resources\Gestao\MapaFerias\Pages\CreateFerias;
use App\Filament\App\Resources\Gestao\MapaFerias\Pages\EditFerias;
use App\Filament\App\Resources\Gestao\MapaFeriasResource\Pages;
use App\Filament\App\Resources\Gestao\MapaFeriasResource\RelationManagers;
use App\Models\CalendarOccurrence;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class MapaFeriasResource extends Resource
{
    protected static ?string $model = CalendarOccurrence::class;

    protected static ?string $modelLabel = 'Mapa de Férias';

    protected static string | \UnitEnum | null $navigationGroup = 'Gestão';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-table-cells';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Select::make('user_id')
                        ->disabledOn('edit')
                        ->label('Usuário')
                        ->columnSpanFull()
                        ->required()
                        ->options(
                            fn() =>
                            User::active()
                                ->with('person')
                                ->orderBy('login')
                                ->get()
                                ->mapWithKeys(fn($user) => [
                                    $user->id => $user->person?->name ?? 'Sem nome',
                                ])
                        )
                        ->searchable()
                        ->preload(),

                    Group::make([

                        TextInput::make('description')
                            ->label('Descrição')
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('start_date')
                            ->label('Data Início')
                            ->live()
                            ->required(),

                        TextInput::make('days_count')
                            ->label('Quantidade de Dias')
                            ->numeric()
                            ->minValue(1)
                            ->live()
                            ->debounce()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $endDate = self::calculateEndDate($get('start_date'), $state);
                                $set('end_date', $endDate);
                            })
                            ->required(),

                        DatePicker::make('end_date')
                            ->label('Data Fim')
                            ->live()
                            ->required()
                    ])->columns(3)
                ])
            ]);
    }

    private static function calculateEndDate($start, $days)
    {
        try {
            return \Carbon\Carbon::parse($start)
                ->addDays(max((int)$days - 1, 0))
                ->format('Y-m-d');
        } catch (Throwable $th) {
            log($th->getMessage());
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Pesquise por palavra-chave ou filtre por período.')
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(80)
                    ->searchable(isIndividual: true),
                TextColumn::make('user.login')
                    ->label('Usuário')
                    ->searchable(isIndividual: true),
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
                Filter::make('date_range')
                    ->schema([
                        DatePicker::make('from')->label('Data início'),
                        DatePicker::make('until')->label('Data fim'),
                    ])
                    ->query(function ($query, array $data): void {
                        $query
                            ->when(
                                $data['from'],
                                fn($q, $date) => $q->whereDate('start_date', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn($q, $date) => $q->whereDate('end_date', '<=', $date)
                            );
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ListFerias::route('/'),
            'create' => CreateFerias::route('/create'),
            'edit' => EditFerias::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 2)->whereYear('start_date', '>=', Carbon::now()->year);
    }
}
