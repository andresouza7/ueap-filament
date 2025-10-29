<?php

namespace App\Filament\Resources\Groups\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->label('Nome')
                        ->maxLength(255),
                    TextInput::make('description')
                        ->label('Descrição')
                        ->maxLength(255),
                    Select::make('group_parent_id')
                        ->label('Pertence a')
                        ->relationship('parent', 'description')
                        ->searchable()
                        ->preload(),
                ])
            ]);
    }
}
