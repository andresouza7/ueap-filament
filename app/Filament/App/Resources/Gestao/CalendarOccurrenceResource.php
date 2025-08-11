<?php

namespace App\Filament\App\Resources\Gestao;

use App\Filament\App\Resources\Gestao\CalendarOccurrenceResource\Pages;
use App\Filament\App\Resources\Gestao\CalendarOccurrenceResource\RelationManagers;
use App\Models\CalendarOccurrence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class CalendarOccurrenceResource extends Resource
{
    protected static ?string $model = CalendarOccurrence::class;
    protected static ?string $modelLabel = 'Ocorrência de Ponto';
    protected static ?string $pluralModelLabel = 'Ocorrências de Ponto';

    protected static ?string $navigationGroup = 'Gestão';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Data Início')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Data Fim'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
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
            'index' => Pages\ListCalendarOccurrences::route('/'),
            'create' => Pages\CreateCalendarOccurrence::route('/create'),
            'edit' => Pages\EditCalendarOccurrence::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('type', 1)->whereYear('start_date', Carbon::now()->year);
    }
}
