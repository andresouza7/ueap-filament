<?php

namespace App\Filament\App\Resources\Transparencia\Despesas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DespesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->numeric(),
                TextInput::make('month')
                    ->numeric(),
                TextInput::make('year')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('description'),
            ]);
    }
}
