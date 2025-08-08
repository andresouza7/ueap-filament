<?php

namespace App\Filament\Transparencia\Resources;

use App\Filament\Transparencia\Resources\QuadroDespesaResource\Pages;
use App\Filament\Transparencia\Resources\QuadroDespesaResource\RelationManagers;
use App\Models\Orcamento;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuadroDespesaResource extends Resource
{
    protected static ?string $model = Orcamento::class;
    protected static ?string $modelLabel = 'Quadro de Detalhamento de Despesa';
    protected static ?string $pluralModelLabel = 'Quadros de Detalhamento de Despesa';

    protected static ?string $navigationIcon = 'heroicon-o-document-minus';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Split::make([

                    Forms\Components\TextInput::make('month')
                        ->label('Mês')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('year')
                        ->label('Ano')
                        ->required()
                        ->numeric(),
                ]),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->required(),
                Forms\Components\Textarea::make('observation')
                    ->label('Observação'),

                SpatieMediaLibraryFileUpload::make('file')
                    ->label('Arquivo em PDF')
                    ->previewable(false)
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxFiles(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'qdd'))
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('month')
                    ->label('Mês'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
                Tables\Actions\Action::make('Abrir')
                ->url(fn($record) => $record->getFirstMediaUrl())
                ->openUrlInNewTab()
                ->visible(fn($record) => $record->hasMedia()),
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
            'index' => Pages\ListQuadroDespesa::route('/'),
            'create' => Pages\CreateQuadroDespesa::route('/create'),
            'view' => Pages\ViewQuadroDespesa::route('/{record}'),
            'edit' => Pages\EditQuadroDespesa::route('/{record}/edit'),
        ];
    }
}
