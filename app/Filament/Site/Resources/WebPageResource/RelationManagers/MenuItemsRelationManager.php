<?php

namespace App\Filament\Site\Resources\WebPageResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'menu_items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
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
                    Tables\Columns\TextColumn::make('position')
                        ->grow(false)
                        ->label('Posição'),
                    Tables\Columns\TextColumn::make('name')
                        ->label('Nome'),
                ])
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
