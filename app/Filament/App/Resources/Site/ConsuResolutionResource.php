<?php

namespace App\Filament\App\Resources\Site;

use App\Filament\App\Resources\Site\ConsuResolutionResource\Pages;
use App\Filament\App\Resources\Site\ConsuResolutionResource\RelationManagers;
use App\Models\ConsuResolution;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Site';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ->actions([
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
            'index' => Pages\ListConsuResolutions::route('/'),
            'create' => Pages\CreateConsuResolution::route('/create'),
            'edit' => Pages\EditConsuResolution::route('/{record}/edit'),
        ];
    }
}
