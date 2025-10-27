<?php

namespace App\Filament\App\Resources\Transparencia;

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
use App\Filament\App\Resources\Transparencia\QuadroDespesaResource\Pages\ListQuadroDespesa;
use App\Filament\App\Resources\Transparencia\QuadroDespesaResource\Pages\CreateQuadroDespesa;
use App\Filament\App\Resources\Transparencia\QuadroDespesaResource\Pages\ViewQuadroDespesa;
use App\Filament\App\Resources\Transparencia\QuadroDespesaResource\Pages\EditQuadroDespesa;
use App\Filament\App\Resources\Transparencia\QuadroDespesaResource\Pages;
use App\Filament\App\Resources\Transparencia\QuadroDespesaResource\RelationManagers;
use App\Models\Orcamento;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
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

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-minus';
    protected static string | \UnitEnum | null $navigationGroup = 'Transparência';
    protected static ?int $navigationSort = 4;

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
            ->modifyQueryUsing(fn(Builder $query) => $query->where('type', 'qdd'))
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
            'index' => ListQuadroDespesa::route('/'),
            'create' => CreateQuadroDespesa::route('/create'),
            'view' => ViewQuadroDespesa::route('/{record}'),
            'edit' => EditQuadroDespesa::route('/{record}/edit'),
        ];
    }
}
