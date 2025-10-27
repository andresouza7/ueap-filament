<?php

namespace App\Filament\App\Resources\Transparencia\RegistroPrecos;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use App\Filament\App\Resources\Transparencia\RegistroPrecos\Pages\ListRegistroPreco;
use App\Filament\App\Resources\Transparencia\RegistroPrecos\Pages\CreateRegistroPreco;
use App\Filament\App\Resources\Transparencia\RegistroPrecos\Pages\ViewRegistroPreco;
use App\Filament\App\Resources\Transparencia\RegistroPrecos\Pages\EditRegistroPreco;
use App\Filament\App\Resources\Transparencia\RegistroPrecoResource\Pages;
use App\Filament\App\Resources\Transparencia\RegistroPrecoResource\RelationManagers;
use App\Models\TransparencyBid;
use App\Models\TransparencyOrder;
use Filament\Forms;
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
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextInput::make('number')
                    ->label('Número')
                    ->required()
                    ->maxLength(255),
                TextInput::make('year')
                    ->label('Ano')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->label('Data da Abertura')
                    ->required(),
                TextInput::make('description')
                    ->columnSpanFull()
                    ->label('Objeto')
                    ->required(),
                TextInput::make('location')
                    ->columnSpanFull()
                    ->label('Local da Publicação'),
                TextInput::make('link')
                    ->columnSpanFull(),
                Textarea::make('observation')
                    ->columnSpanFull()
                    ->label('Observação'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'ata'))
            ->columns([

                TextColumn::make('number')
                    ->label('Número')
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->limit()
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
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
            'index' => ListRegistroPreco::route('/'),
            'create' => CreateRegistroPreco::route('/create'),
            'view' => ViewRegistroPreco::route('/{record}'),
            'edit' => EditRegistroPreco::route('/{record}/edit'),
        ];
    }
}
