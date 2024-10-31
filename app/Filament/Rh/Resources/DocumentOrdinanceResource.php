<?php

namespace App\Filament\Rh\Resources;

use App\Filament\Rh\Resources\DocumentOrdinanceResource\Pages;
use App\Filament\Rh\Resources\DocumentOrdinanceResource\RelationManagers;
use App\Models\DocumentOrdinance;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DocumentOrdinanceResource extends Resource
{
    protected static ?string $model = DocumentOrdinance::class;
    protected static ?string $modelLabel = 'Portaria';

    protected static ?string $navigationGroup = 'RH';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->label('Número')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('year')
                    ->label('Ano')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('subject')
                    ->label('Assunto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('created_at')
                    ->label('Data'),
                Forms\Components\TextInput::make('origin')
                    ->label('Origem')
                    ->maxLength(255),
                FileUpload::make('attachment')
                    ->label('Arquivo')
                    ->directory('test')
                    ->uploadingMessage('Fazendo upload...')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(1024 * 10)
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file, $record): string => "{$record->id}.{$file->getClientOriginalExtension()}"
                    )
                    ->helperText('*É necessário salvar as alterações após o envio.')
                // ->visibility('private')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort(fn($query) => $query->orderBy('year', 'desc')->orderBy('number', 'desc'))
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('Nº')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->label('Ano')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Assunto/Descrição')
                    ->limit(70)
                    ->formatStateUsing(function ($state, $record) {
                        return sprintf("%s - %s", $record->subject, $state);
                    })
                    ->searchable(),
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
                Tables\Columns\TextColumn::make('origin')
                    ->label('Origem')
                    ->limit(30)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Baixar')
                    ->action(function ($record) {
                        // Assuming files are stored in 'test' directory with filename as {id}.pdf
                        $filePath = "test/{$record->id}.pdf";

                        if (Storage::exists($filePath)) {
                            return Storage::download($filePath);
                        }

                        // If file not found, flash a message
                    })
                    ->visible(fn($record) => Storage::exists("test/{$record->id}.pdf"))
                    ->icon('heroicon-m-arrow-down-tray'),
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
            'index' => Pages\ListDocumentOrdinances::route('/'),
            'create' => Pages\CreateDocumentOrdinance::route('/create'),
            'view' => Pages\ViewDocumentOrdinance::route('/{record}'),
            'edit' => Pages\EditDocumentOrdinance::route('/{record}/edit'),
        ];
    }
}
