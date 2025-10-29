<?php

namespace App\Filament\Resources\Transparencia\Contratos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContratoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make([
                    Flex::make([
                        Select::make('person_type')
                            ->label('Tipo de Pessoa')
                            ->options([
                                'juridica' => 'JURÍDICA',
                                'fisica' => 'FÍSICA'
                            ]),
                        TextInput::make('number')
                            ->label('Número')
                            ->maxLength(255),
                        TextInput::make('year')
                            ->label('Ano')
                            ->maxLength(255),
                        DatePicker::make('start_date')
                            ->label('Data de Abertura')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Data Final')
                            ->required(),
                    ]),

                    Textarea::make('description')
                        ->label('Objeto')
                        ->required(),
                    TextInput::make('location')
                        ->label('Local da Publicação')
                        ->maxLength(255),
                    TextInput::make('link')
                        ->maxLength(255),
                    Textarea::make('observation')
                        ->label('Observação'),
                ])
            ]);
    }
}
