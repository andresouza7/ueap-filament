<?php

namespace App\Filament\Transparencia\Resources;

use App\Filament\Transparencia\Resources\ContratoResource\Pages;
use App\Models\TransparencyBid;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContratoResource extends Resource
{
    protected static ?string $model = TransparencyBid::class;
    protected static ?string $modelLabel = 'Contrato';
    protected static ?string $slug = 'contratos';
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\Split::make([
                    Forms\Components\TextInput::make('number')
                        ->label('Número')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('year')
                        ->label('Ano')
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Data de Abertura')
                        ->required(),
                ]),

                Forms\Components\Textarea::make('description')
                    ->label('Objeto')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->label('Local da Publicação')
                    ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->maxLength(255),
                Forms\Components\Textarea::make('observation')
                    ->label('Observação')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('year', 'desc')
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'contrato'))
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('Número')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->words(20)->wrap(),
                Tables\Columns\TextColumn::make('hits')
                    ->label('Acessos')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
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
                // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListContrato::route('/'),
            'create' => Pages\CreateContrato::route('/create'),
            // 'view' => Pages\ViewContrato::route('/{record}'),
            'edit' => Pages\EditContrato::route('/{record}/edit'),
        ];
    }
}
