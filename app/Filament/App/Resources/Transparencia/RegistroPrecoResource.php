<?php

namespace App\Filament\Transparencia\Resources;

use App\Filament\Transparencia\Resources\RegistroPrecoResource\Pages;
use App\Filament\Transparencia\Resources\RegistroPrecoResource\RelationManagers;
use App\Models\TransparencyBid;
use App\Models\TransparencyOrder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistroPrecoResource extends Resource
{
    protected static ?string $model = TransparencyBid::class;
    protected static ?string $modelLabel = 'Ata de Registro de Preço';
    protected static ?string $pluralModelLabel = 'Atas de Registro de Preço';
    protected static ?string $slug = 'registro-preco';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->label('Número')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('year')
                    ->label('Ano')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Data da Abertura')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->columnSpanFull()
                    ->label('Objeto')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->columnSpanFull()
                    ->label('Local da Publicação'),
                Forms\Components\TextInput::make('link')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('observation')
                    ->columnSpanFull()
                    ->label('Observação'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'ata'))
            ->columns([

                Tables\Columns\TextColumn::make('number')
                    ->label('Número')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->limit()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistroPreco::route('/'),
            'create' => Pages\CreateRegistroPreco::route('/create'),
            'view' => Pages\ViewRegistroPreco::route('/{record}'),
            'edit' => Pages\EditRegistroPreco::route('/{record}/edit'),
        ];
    }
}
