<?php

namespace App\Filament\App\Resources\Gestao\CalendarOccurrences\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CalendarOccurenceForm
{
    public static function configure(Schema $schema): Schema
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
}
