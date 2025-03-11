<?php

namespace App\Filament\PortalTransparencia\Pages;

use App\Models\Document;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class Documento extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.portal-transparencia.pages.documento';

    public $type;

    public function mount(): void
    {
        $this->type = request('type');

        if (!$this->type) {
            abort(404);
        }
    }

    public  function table(Table $table): Table
    {
        return $table
            ->query(Document::query()->whereHas('category', function ($query) {
                $query->where('slug', $this->type);
            }))
            ->heading('Documentos')
            ->description('Use a caixa de pesquisa para filtrar informações')
            ->defaultSort('year', 'desc')
            ->columns([
                TextColumn::make('year')
                    ->label('Ano')
                    ->weight('semibold')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Nome')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->wrap(),
            ])
            ->actions([
                Action::make('Abrir')
                    ->url(function($record) {
                        return Storage::url("web/documents/general/{$record->id}.pdf");
                    })
            ]);
    }
}
