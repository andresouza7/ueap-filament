<?php

namespace App\Filament\App\Resources\Social\SocialUserResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdinancesRelationManager extends RelationManager
{
    protected static string $relationship = 'ordinances';
    protected static ?string $title = 'Portarias';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->id === auth()->id();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('year', 'DESC')->orderBy('number', 'DESC'))
            ->columns([
                TextColumn::make('number')->label('Número')->searchable(),
                TextColumn::make('year')->label('Ano')->searchable(),
                TextColumn::make('subject')->label('Assunto')->searchable(),
                TextColumn::make('description')->label('Descrição')->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('Abrir')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
