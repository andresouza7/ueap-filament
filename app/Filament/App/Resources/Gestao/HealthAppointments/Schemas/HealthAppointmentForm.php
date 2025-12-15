<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HealthAppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('uuid')
                        ->label('UUID')
                        ->required(),
                    TextInput::make('user_id')
                        ->required()
                        ->numeric(),
                    TextInput::make('agent_role')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('requested_date')
                        ->required(),
                    Textarea::make('patient_note')
                        ->columnSpanFull(),
                    Textarea::make('cancellation_note')
                        ->columnSpanFull(),
                    TextInput::make('status')
                        ->required()
                        ->maxLength(255)
                        ->default('Novo'),
                ])
            ]);
    }
}
