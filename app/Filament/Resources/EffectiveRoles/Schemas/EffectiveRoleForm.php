<?php

namespace App\Filament\Resources\EffectiveRoles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EffectiveRoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->label('Descrição')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
