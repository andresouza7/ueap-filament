<?php

namespace App\Filament\App\Resources\Site;

use App\Filament\App\Resources\Site\ConsuAtaResource\Pages;
use App\Filament\App\Resources\Site\ConsuAtaResource\RelationManagers;
use App\Models\ConsuAta;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsuAtaResource extends Resource
{
    protected static ?string $model = ConsuAta::class;

    protected static ?string $modelLabel = 'Ata';

    protected static ?string $slug = 'atas';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Section::make([

                    TextInput::make('issuer')
                        ->label('Emissor')
                        ->required(),
                    DatePicker::make('issuance_date')
                        ->label('Data da Emissão')
                        ->required(),
                    TextInput::make('title')
                        ->label('Título')
                        ->required(),
                    Textarea::make('description')
                        ->label('Descrição'),

                    FileUpload::make('file')
                        ->label('Arquivo PDF')
                        ->required()
                        ->directory('documents/atas')
                        ->acceptedFileTypes(['application/pdf'])
                        ->previewable(false)
                        ->maxFiles(1)
                        ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('issuance_date', 'desc')->orderBy('id', 'desc'))
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Nome')
                    ->extraAttributes([
                        'class' => 'whitespace-normal max-w-xs break-words',
                    ])
                    ->searchable(),
                TextColumn::make('issuer')
                    ->label('Emissor')
                    ->searchable(),
                TextColumn::make('issuance_date')
                    ->label('Data Emissão')
                    ->date('d/m/y')
                    ->sortable(),
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
            'index' => Pages\ListConsuAtas::route('/'),
            'create' => Pages\CreateConsuAta::route('/create'),
            'edit' => Pages\EditConsuAta::route('/{record}/edit'),
        ];
    }
}
