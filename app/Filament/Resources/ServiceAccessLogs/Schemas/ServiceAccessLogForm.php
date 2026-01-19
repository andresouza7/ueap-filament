<?php

namespace App\Filament\Resources\ServiceAccessLogs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceAccessLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('service')
                    ->required(),
                TextInput::make('action_type')
                    ->required(),
                TextInput::make('target_record'),
                TextInput::make('details'),
            ]);
    }
}
