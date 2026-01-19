<?php

namespace App\Filament\App\Resources\Transparencia\Contratos\Pages;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use App\Filament\App\Resources\Transparencia\Contratos\ContratoResource;
use App\Filament\App\Resources\Transparencia\Licitacaos\LicitacaoResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageDocumentosContrato extends ManageRelatedRecords
{
    protected static string $resource = ContratoResource::class;
    protected static ?string $title = 'Gerenciar Anexos de Contrato';
    protected static string $relationship = 'documents';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Anexos';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components($this->getFormSection());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->heading(fn() => 'Contrato ' . $this->getOwnerRecord()->number)
            ->description('Gerencie os documentos deste contrato')
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('description')
                    ->label('Descrição'),
                TextColumn::make('created_at')
                    ->date()
                    ->label('Data Publicação'),
                TextColumn::make('user_created.login')
                    ->label('Autor'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()->label('Publicar Anexo')
                    ->modalHeading('Publicar Anexo')
                    ->modalDescription('Forneça uma descrição e faça o upload do arquivo')
                    ->schema($this->getFormSection())
                    ->mutateDataUsing(function (array $data) {
                        $data['uuid'] = Str::uuid();
                        $data['user_created_id'] = auth()->id();
                        $data['hits'] = 0;
                        $data['transparency_bid_id'] = $this->getOwnerRecord()->id;

                        return $data;
                    })
                    ->after(function (Model $record, array $data) {
                        $record->storeFileWithModelId($data['file'], 'documents/bids');
                        \App\Events\ServiceAccessed::dispatch(auth()->user(), 'publicacao_transparencia', 'create', class_basename($record) . ":{$record->id}");
                    }),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
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
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DissociateBulkAction::make(),
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    private function getFormSection()
    {
        return [
            TextInput::make('description')
                ->columnSpanFull()
                ->label('Descrição')
                ->required(),
            FileUpload::make('file')
                ->columnSpanFull()
                ->label('Arquivo')
                ->directory('documents/bids')
                ->acceptedFileTypes(['application/pdf'])
                ->previewable(false)
                ->maxFiles(1)
                ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.pdf'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
