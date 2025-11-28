<?php

namespace App\Filament\App\Resources\Gestao\HealthAppointments\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HealthAppointmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns(2)
                    ->heading('Dados do Agendamento')
                    ->schema([
                        TextEntry::make('user.person.name')
                            ->label('Nome'),
                        TextEntry::make('user.person.birthdate')
                            ->label('Idade')
                            ->formatStateUsing(fn($state) => Carbon::parse($state)->age),
                        TextEntry::make('user.group.name')
                            ->label('Setor'),
                        TextEntry::make('user.person.email')
                            ->label('Email'),
                        TextEntry::make('user.person.phone')
                            ->label('Telefone'),
                        TextEntry::make('user.record.local')
                            ->label('Local de Atendimento'),
                        TextEntry::make('created_at')
                            ->label('Data da Solicitação')
                            ->date('d/m/y H:i'),
                        TextEntry::make('agent_role')
                            ->label('Especialidade')
                            ->badge(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
