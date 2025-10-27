<?php

namespace App\Filament\App\Resources\Transparencia\Dotacaos;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Transparencia\Dotacaos\Pages\ListDotacao;
use App\Filament\App\Resources\Transparencia\Dotacaos\Pages\CreateDotacao;
use App\Filament\App\Resources\Transparencia\Dotacaos\Pages\ViewDotacao;
use App\Filament\App\Resources\Transparencia\Dotacaos\Pages\EditDotacao;
use App\Filament\App\Resources\Transparencia\DotacaoResource\Pages;
use App\Models\Orcamento;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
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

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Flex::make([
                        TextInput::make('month')
                            ->label('Mês')
                            ->required()
                            ->numeric(),
                        TextInput::make('year')
                            ->label('Ano')
                            ->required()
                            ->numeric(),
                        TextInput::make('value')
                            ->label('Valor Executado')
                            ->required()
                            ->numeric(),
                    ]),
                    Textarea::make('description')
                        ->label('Descrição')
                        ->required(),
                    Textarea::make('observation')
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
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'dotacao')->orderBy('year', 'desc')->orderBy('month', 'desc'))
            ->columns([
                TextColumn::make('year')
                    ->label('Ano')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('month')
                    ->label('Mês'),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable(),
                TextColumn::make('value')
                    ->label('Valor Executado')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
                Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
            'index' => ListDotacao::route('/'),
            'create' => CreateDotacao::route('/create'),
            'view' => ViewDotacao::route('/{record}'),
            'edit' => EditDotacao::route('/{record}/edit'),
        ];
    }
}
