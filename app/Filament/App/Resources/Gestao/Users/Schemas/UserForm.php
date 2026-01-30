<?php

namespace App\Filament\App\Resources\Gestao\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                self::getUserTab(),
                                self::getPersonTab(),
                                self::getUserDetails()
                            ]),
                    ])
            ]);
    }

    private static function getUserTab()
    {
        return Tab::make('Usuário')
            ->columns(2)
            ->schema([
                // ...
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('login')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                TextInput::make('enrollment')
                    ->label('Matrícula')
                    ->maxLength(255),
                Select::make('group_id')
                    ->label('Setor')
                    ->required()
                    ->relationship('group', 'description')
                    ->searchable()
                    ->preload(),
                Select::make('effective_role_id')
                    ->label('Cargo Efetivo')
                    ->relationship('effective_role', 'description')
                    ->searchable()
                    ->preload(),
                Select::make('commissioned_role_id')
                    ->label('Cargo Comissionado')
                    ->relationship('commissioned_role', 'description')
                    ->searchable()
                    ->preload(),
                Select::make('roles')
                    ->label('Permissões')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->searchable()
                    ->helperText('*Informar apenas para liberar funcionalidades de gestão ou publicação de documentos')
                    ->preload(),
            ]);
    }

    private static function getPersonTab()
    {
        return Tab::make('Dados Pessoais')
            ->schema([
                // ...
                Group::make()
                    ->relationship('person')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('cpf_cnpj')
                            ->rules('cpf')
                            ->unique(ignoreRecord: true)
                            ->label('CPF')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('birthdate')
                            ->hiddenOn('create')
                            ->label('Data de Nascimento')
                    ])

            ]);
    }

    private static function getUserDetails()
    {
        return Tab::make('Registros Funcionais')
            ->hiddenOn('create')
            ->schema([
                // ...
                Group::make()
                    ->relationship('record')
                    ->columns(2)
                    ->schema([
                        TextInput::make('ordinance')
                            ->label('Doc. de Admissão')
                            ->helperText('Decreto ou Contrato')
                            ->maxLength(255),
                        DatePicker::make('ordinance_date')
                            ->label('Data do Documento')
                            ->helperText('Da publicação ou assinatura'),
                        DatePicker::make('admission_date')
                            ->label('Data de Admissão')
                            ->helperText('Entrada em exercício'),
                        Select::make('category')
                            ->label('Categoria')
                            ->options([
                                'docente' => 'Docente',
                                'técnico' => 'Técnico'
                            ]),
                        Select::make('local')
                            ->label('Local')
                            ->options([
                                'MACAPÁ - AP' => 'MACAPÁ - AP',
                                'AMAPÁ - AP' => 'AMAPÁ - AP'
                            ]),
                        Select::make('title')
                            ->label('Titulação')
                            ->options([
                                'ensino médio' => 'ensino médio',
                                'técnico' => 'técnico',
                                'graduado' => 'graduado',
                                'especialista' => 'especialista',
                                'mestre' => 'mestre',
                                'doutor' => 'doutor',
                            ]),
                    ])
            ]);
    }
}
