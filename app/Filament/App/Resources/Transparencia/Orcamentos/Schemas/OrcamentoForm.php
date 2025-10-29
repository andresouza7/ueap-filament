<?php

namespace App\Filament\App\Resources\Transparencia\Orcamentos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrcamentoForm
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
