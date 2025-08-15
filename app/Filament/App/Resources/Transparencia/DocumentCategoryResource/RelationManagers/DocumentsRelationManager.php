<?php

namespace App\Filament\Transparencia\Resources\DocumentCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Nome do Documento')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('year')
                    ->label('Ano do Documento')
                    ->integer(),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição'),
                FileUpload::make('file')
                    ->directory('documents/general')
                    ->acceptedFileTypes(['application/pdf'])
                    ->previewable(false)
                    ->maxFiles(1)
                    ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->heading('Gerenciar Publicações')
            ->description('Mídia armazenada nos servidores da UEAP para exposição no portal da transparência.')
            ->defaultSort('year', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Título'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->words(4),
                Tables\Columns\TextColumn::make('year')
                    ->sortable()
                    ->label('Ano'),
                Tables\Columns\TextColumn::make('user_created.login')
                    ->searchable()
                    ->label('Autor'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->label('Data Publicação'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Publicar Documento')
                    ->modalHeading('Publicar Documento')
                    ->mutateFormDataUsing(function(array $data) {
                        $data['uuid'] = Str::uuid();
                        $data['user_created_id'] = auth()->id();
                        $data['status'] = 'published';

                        return $data;
                    })
                    ->after(function (Model $record, array $data) {
                        $record->storeFileWithModelId($record, $data['file'], 'documents/general');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->url(fn($record) => $record->file_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->file_url)
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
