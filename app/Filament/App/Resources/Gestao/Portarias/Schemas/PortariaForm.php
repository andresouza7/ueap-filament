<?php

namespace App\Filament\Resources\Gestao\Portarias\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
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
                ])->columns(2)
            ]);
    }
}
