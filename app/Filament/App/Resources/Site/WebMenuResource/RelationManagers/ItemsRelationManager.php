<?php

namespace App\Filament\App\Resources\Site\WebMenuResource\RelationManagers;

use App\Models\WebPage;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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

                Repeater::make('sub_itens')
                    ->label('Sub Itens')
                    ->helperText('Adicione subitens a este item de menu')
                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                    ->orderColumn('position')
                    ->reorderable()
                    ->reorderableWithButtons()
                    ->relationship() // links it to the 'sub_itens' relationship
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Nome'),
                        TextInput::make('url')
                            ->required(),
                        Split::make([
                            TextInput::make('position')
                                ->label('Posição')
                                ->required()
                                ->integer(),
                            Select::make('status')
                                ->options([
                                    'published' => 'Publicado',
                                    'unpublished' => 'Não Publicado',
                                ])
                                ->required(),
                        ])

                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function ($record, array $data) {
                        $data['web_menu_id'] = $record->web_menu_id;
                        $data['web_menu_parent_id'] = $record->id; // THIS makes it a child of the current menu item

                        // Set position: last position among siblings + 1
                        $lastPosition = $record->sub_itens()->max('position') ?? 0;
                        $data['position'] = $lastPosition + 1;
                        $data['uuid'] = Str::uuid();

                        return $data;
                    })
                    ->collapsible() // optional: makes sub-items collapsible
                    ->columns(1),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->whereDoesntHave('parent'))
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
                    ->label('Nome')
                    ->searchable(),
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
