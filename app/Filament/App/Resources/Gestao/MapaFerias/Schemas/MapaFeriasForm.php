<?php

namespace App\Filament\Resources\Gestao\MapaFerias\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Throwable;

class MapaFeriasForm
{
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

    public static function configure(Schema $schema): Schema
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
}
