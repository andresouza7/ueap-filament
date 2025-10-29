<?php

namespace App\Filament\Resources\Social\ProtocolProcesses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProtocolProcessInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados do Processo')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('number')
                            ->label('Nro Processo'),
                        TextEntry::make('external_number')
                            ->label('Código E-DOC'),
                        TextEntry::make('subject.description')
                            ->label('Serviço Solicitado'),
                        TextEntry::make('description')
                            ->label('Descrição'),
                        TextEntry::make('created_at')
                            ->label('Data de Abertura')
                            ->dateTime('d M Y, H:i'),
                        TextEntry::make('group_received.description')
                            ->label('Último Trâmite para'),
                        TextEntry::make('status')
                            ->badge(),
                    ]),

                Section::make('Dados do Interessado')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('person.name')
                            ->label('Nome'),
                        // TextEntry::make('person.cpf_cnpj')
                        //     ->label('CPF')
                    ]),
            ]);
    }
}
