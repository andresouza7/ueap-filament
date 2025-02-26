<?php

namespace App\Filament\Transparencia\Resources\LicitacaoResource\Pages;

use App\Filament\Transparencia\Resources\LicitacaoResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageDocumentosLicitacao extends ManageRelatedRecords
{
    protected static string $resource = LicitacaoResource::class;
    protected static ?string $title = 'Gerenciar Anexos';
    protected static string $relationship = 'documents';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Anexos';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->heading(fn() => 'Licitação ' . $this->getOwnerRecord()->number)
            ->description('Gerencie os documentos desta licitação')
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição'),
                Tables\Columns\TextColumn::make('created_at')
                ->date()
                    ->label('Data Publicação'),
                Tables\Columns\TextColumn::make('user_created.login')
                    ->label('Autor'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Publicar Anexo'),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DissociateBulkAction::make(),
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
