<?php

namespace App\Filament\App\Resources\Site\WebMenuResource\RelationManagers;

use App\Models\WebPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $modelLabel = 'Item de Menu';
    protected static ?string $pluralModelLabel = 'Itens de Menu';

    public function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Checkbox::make('use_internal')
                    ->label('Direcionar para página do site')
                    ->reactive(),
                Forms\Components\Select::make('url')
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
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->required()
                    ->maxLength(255)
                    ->hidden(fn($get) => $get('use_internal')),
                Forms\Components\TextInput::make('description')
                    ->label('Descrição')
                    ->maxLength(65535),
                Forms\Components\Select::make('status')
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
                Tables\Columns\TextColumn::make('position')
                    ->sortable()
                    ->label('Posição'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['uuid'] = Str::uuid()->toString();
                        $data['web_menu_id'] = $this->ownerRecord->id;
                        $data['position'] = $this->ownerRecord->items()->count() + 1;
                        unset($data['use_internal']); // Remove the checkbox value from the data
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
