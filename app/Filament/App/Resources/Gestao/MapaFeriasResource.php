<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\MapaFeriasResource\Pages;
use App\Filament\App\Resources\Gestao\MapaFeriasResource\RelationManagers;
use App\Models\CalendarOccurrence;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
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

    protected static ?string $navigationGroup = 'Gestão';

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\Select::make('user_id')
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

                        Forms\Components\TextInput::make('description')
                            ->label('Descrição')
                            ->columnSpanFull()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Data Início')
                            ->live()
                            ->required(),

                        Forms\Components\TextInput::make('days_count')
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

                        Forms\Components\DatePicker::make('end_date')
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
        } catch (\Throwable $th) {
            log($th->getMessage());
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('Pesquise por palavra-chave ou filtre por período.')
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(80)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('user.login')
                    ->label('Usuário')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Data Início')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Data Fim')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Data início'),
                        Forms\Components\DatePicker::make('until')->label('Data fim'),
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListFerias::route('/'),
            'create' => Pages\CreateFerias::route('/create'),
            'edit' => Pages\EditFerias::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 2)->whereYear('start_date', '>=', Carbon::now()->year);
    }
}
