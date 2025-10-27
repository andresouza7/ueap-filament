<?php

namespace App\Filament\App\Resources\Social\SocialUserResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalendarOccurrencesRelationManager extends RelationManager
{
    protected static string $relationship = 'calendar_occurrences';
    protected static ?string $title = 'Férias';
    protected static bool $shouldSkipAuthorization = true;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->label('Descrição')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->modifyQueryUsing(fn($query) => $query->where('type', 2))
            ->defaultSort('start_date', 'desc')
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->dateTime('d/m/Y')
                    ->label('Data Início'),
                TextColumn::make('end_date')
                    ->dateTime('d/m/Y')
                    ->label('Data Fim'),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                // Tables\Actions\EditAction::make(),
            ]);
    }
}
