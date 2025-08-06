<?php

namespace App\Filament\Rh\Resources;

use App\Filament\Rh\Resources\FeriasResource\Pages;
use App\Filament\Rh\Resources\FeriasResource\RelationManagers;
use App\Models\CalendarOccurrence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class FeriasResource extends Resource
{
    protected static ?string $model = CalendarOccurrence::class;
    protected static ?string $modelLabel = 'Mapa de Férias';

    protected static ?string $navigationGroup = 'RH';

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('user_id')
                    ->disabledOn('edit')
                    ->label('Usuário')
                    ->columnSpanFull()
                    ->required()
                    ->relationship('user', 'login')
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Data Início')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Data Fim')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->limit(80)
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('user.login')
                    ->label('Usuário')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Data Início')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Data Fim')
                    ->date('d/m/Y')
                    ->sortable(),
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListFerias::route('/'),
            'create' => Pages\CreateFerias::route('/create'),
            'edit' => Pages\EditFerias::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 2)->whereYear('start_date', Carbon::now()->year);
    }
}
