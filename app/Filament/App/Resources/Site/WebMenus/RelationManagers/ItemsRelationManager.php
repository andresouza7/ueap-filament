<?php

namespace App\Filament\App\Resources\Site\WebMenus\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Models\WebPage;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $modelLabel = 'Item de Menu';
    protected static ?string $pluralModelLabel = 'Itens de Menu';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Checkbox::make('use_internal')
                    ->label('Direcionar para página do site')
                    ->reactive(),
                Select::make('url')
                    ->label('Página do site')
                    ->searchable()
                    ->preload()
                    ->getSearchResultsUsing(function (string $query) {
                        return WebPage::where('title', 'ilike', "%{$query}%")
                            ->get()
                            ->mapWithKeys(function ($item) {
                                return ['pagina/' . $item->slug => $item->title];
                            });
                    })
                    ->getOptionLabelUsing(function ($value) {
                        // return WebPage::where('slug', str_replace('pagina/', '', $value))->first()->title ?? $value;
                        return WebPage::where('slug', $value)->first()->title ?? $value;
                    })
                    ->required()
                    ->hidden(fn($get) => !$get('use_internal')),
                TextInput::make('url')
                    ->label('URL')
                    ->required()
                    ->maxLength(255)
                    ->hidden(fn($get) => $get('use_internal')),
                TextInput::make('description')
                    ->label('Descrição')
                    ->maxLength(65535),
                Select::make('status')
                    ->options([
                        'published' => 'Publicado',
                        'unpublished' => 'Não Publicado',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->heading('Itens do menu')
            ->description('Visualize os itens vinculados a este menu e reordene a posição')
            ->defaultSort('position')
            ->reorderable('position')
            ->columns([
                TextColumn::make('position')
                    ->sortable()
                    ->label('Posição'),
                TextColumn::make('name')
                    ->label('Nome'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateDataUsing(function (array $data): array {
                        $data['uuid'] = Str::uuid()->toString();
                        $data['web_menu_id'] = $this->ownerRecord->id;
                        $data['position'] = $this->ownerRecord->items()->count() + 1;
                        unset($data['use_internal']); // Remove the checkbox value from the data
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
