<?php

namespace App\Filament\App\Resources\Transparencia\Documents\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use App\Actions\HandlesFileUpload;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                    ->label('Nome')
                    ->required(),
                TextInput::make('description')
                    ->label('Descrição')
                    ->required(),
                TextInput::make('year')
                    ->label('Ano')
                    ->integer()
                    ->required(),
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
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->limit(60)
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Ano')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('type')
                    ->badge()
                    ->color('secondary')
                    ->label('Tipo')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Criar Documento')
                    ->mutateDataUsing(function (array $data) {
                        $data['user_created_id'] = Auth::id();
                        $data['uuid'] = Str::uuid();
                        $data['type'] = $this->getOwnerRecord()->slug;
                        $data['status'] = 'published';

                        return $data;
                    })
                    ->after(
                        fn(Model $record, array $data) =>
                        $record->storeFileWithModelId($data['file'], 'documents/general')
                    ),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
