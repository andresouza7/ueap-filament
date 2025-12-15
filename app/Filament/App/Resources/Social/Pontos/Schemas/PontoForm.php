<?php

namespace App\Filament\App\Resources\Social\Pontos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PontoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make([
                    Select::make('description')
                        ->label('Tipo')
                        ->columnSpanFull()
                        ->options([
                            'PONTO FACULTATIVO' => 'PONTO FACULTATIVO',
                            'RECESSO' => 'RECESSO',
                            'ATESTADO MÉDICO' => 'ATESTADO MÉDICO',
                            'FÉRIAS DOCENTE' => 'FÉRIAS DOCENTE',
                            'LUTO OFICIAL' => 'LUTO OFICIAL',
                            'FALTA' => 'FALTA',
                            'SEM VINCULO ATIVO' => 'SEM VINCULO ATIVO',
                        ])
                        ->required(),
                    DatePicker::make('start_date')
                        ->label('Data Início')
                        ->required(),
                    DatePicker::make('end_date')
                        ->label('Data Fim')
                        ->required()
                ])
            ]);
    }
}
