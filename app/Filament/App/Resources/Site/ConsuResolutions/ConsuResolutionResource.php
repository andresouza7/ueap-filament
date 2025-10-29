<?php

namespace App\Filament\App\Resources\Site\ConsuResolutions;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Site\ConsuResolutions\Pages\ListConsuResolutions;
use App\Filament\App\Resources\Site\ConsuResolutions\Pages\CreateConsuResolution;
use App\Filament\App\Resources\Site\ConsuResolutions\Pages\EditConsuResolution;
use App\Filament\App\Resources\Site\ConsuResolutionResource\Pages;
use App\Filament\App\Resources\Site\ConsuResolutionResource\RelationManagers;
use App\Models\ConsuResolution;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsuResolutionResource extends Resource
{
    protected static ?string $model = ConsuResolution::class;

    protected static ?string $modelLabel = 'Resolução Consu';

    protected static ?string $pluralModelLabel = 'Resoluções Consu';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->required()
                        ->columnSpanFull()
                        ->label('Título'),
                    TextInput::make('number')
                        ->required()
                        ->label('Número')
                        ->numeric(),
                    TextInput::make('year')
                        ->required()
                        ->label('Ano')
                        ->numeric(),
                    TextInput::make('description')
                        ->columnSpanFull()
                        ->label('Descrição'),
                    FileUpload::make('file')
                        ->required()
                        ->label('Arquivo PDF')
                        ->columnSpanFull()
                        ->directory('consu/resolutions')
                        ->acceptedFileTypes(['application/pdf'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf')
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('year', 'desc')->orderBy('number', 'desc'))
            ->columns([
                TextColumn::make('number')
                    ->label('Número')
                    ->searchable()
                    ->formatStateUsing(fn($state, $record) => $state . '/' . $record->year),
                TextColumn::make('name')
                    ->label('Título')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xl break-words',
                    ])
                    ->searchable(),
                TextColumn::make('id')
                    ->label('#'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
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
            'index' => ListConsuResolutions::route('/'),
            'create' => CreateConsuResolution::route('/create'),
            'edit' => EditConsuResolution::route('/{record}/edit'),
        ];
    }
}
