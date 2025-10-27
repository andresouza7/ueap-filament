<?php

namespace App\Filament\App\Resources\Site\WebPages\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'menu_items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Itens do Menu')
            ->description('Organize e defina a ordem dos itens de menu desta página')
            ->recordTitleAttribute('name')
            ->defaultSort('position')
            ->reorderable('position')
            ->paginated(false)
            ->columns([
                Split::make([
                    TextColumn::make('position')
                        ->grow(false)
                        ->label('Posição'),
                    TextColumn::make('name')
                        ->label('Nome'),
                ])
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
