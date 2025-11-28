<?php

namespace App\Filament\App\Resources\Gestao\Portarias\Schemas;

use App\Models\Person;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;

class PortariaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('number')
                        ->label('Número')
                        ->required()
                        ->numeric(),
                    TextInput::make('year')
                        ->label('Ano')
                        ->required()
                        ->numeric(),
                    TextInput::make('subject')
                        ->label('Assunto')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('description')
                        ->label('Descrição')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('created_at')
                        ->label('Data'),
                    TextInput::make('origin')
                        ->hidden(fn() => Auth::user()->hasRole('consu'))
                        ->label('Origem')
                        ->maxLength(255),

                    FileUpload::make('file')
                        ->columnSpanFull()
                        ->label('Arquivo')
                        ->directory('documents/ordinances')
                        ->acceptedFileTypes(['application/pdf'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),

                    Select::make('persons')
                        ->columnSpanFull()
                        ->label('Servidores')
                        ->relationship(
                            name: 'persons',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn($query) => $query->whereHas('user', fn($q) => $q->whereNotNull('enrollment'))
                        )
                        ->multiple()
                        ->searchable()
                        ->preload(),

                    Repeater::make('impediments')
                        ->label('Registrar Impedimentos')
                        ->table([
                            TableColumn::make('Servidor'),
                            TableColumn::make('Descrição'),
                            TableColumn::make('Início'),
                            TableColumn::make('Fim'),
                        ])
                        ->compact()
                        ->relationship()
                        ->columnSpanFull()
                        ->schema([
                            Select::make('user_id')
                                ->label('Servidor')
                                ->options(fn() => User::orderBy('login')
                                    ->get()
                                    ->pluck('login', 'id'))
                                ->searchable()
                                ->required(),

                            Textarea::make('description'),
                            DatePicker::make('start_date'),
                            DatePicker::make('end_date'),
                        ])
                        ->cloneable()
                        ->addActionLabel('Adicionar')
                        ->minItems(0)
                        ->live()


                ])->columns(2)
            ]);
    }
}
