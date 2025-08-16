<?php

namespace App\Filament\App\Resources\Transparencia;

use App\Filament\App\Resources\Transparencia\DotacaoResource\Pages;
use App\Filament\App\Resources\Transparencia\DotacaoResource\RelationManagers;
use App\Models\Orcamento;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DotacaoResource extends Resource
{
    protected static ?string $model = Orcamento::class;
    protected static ?string $modelLabel = 'Dotação Orcamentária';
    protected static ?string $pluralModelLabel = 'Dotações Orçamentárias';

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([


                    Split::make([

                        Forms\Components\TextInput::make('month')
                            ->label('Mês')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('year')
                            ->label('Ano')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('value')
                            ->label('Valor Executado')
                            ->required()
                            ->numeric(),
                    ]),
                    Forms\Components\Textarea::make('description')
                        ->label('Descrição')
                        ->required(),
                    Forms\Components\Textarea::make('observation')
                        ->label('Observação'),

                    FileUpload::make('file')
                        ->directory('documents/orcamento')
                        ->acceptedFileTypes(['application/pdf'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf')
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'dotacao'))
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
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor Executado')
                    ->money('BRL')
                    ->sortable(),
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
                Tables\Actions\Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
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
            'index' => Pages\ListDotacao::route('/'),
            'create' => Pages\CreateDotacao::route('/create'),
            'view' => Pages\ViewDotacao::route('/{record}'),
            'edit' => Pages\EditDotacao::route('/{record}/edit'),
        ];
    }
}
