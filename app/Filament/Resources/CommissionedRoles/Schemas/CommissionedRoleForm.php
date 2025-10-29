<?php

namespace App\Filament\Resources\CommissionedRoles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CommissionedRoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->label('Descrição')
                    ->required()
                    ->maxLength(255),
                TextInput::make('position')
                    ->label('Ordem')
                    ->numeric(),
            ]);
    }
}
