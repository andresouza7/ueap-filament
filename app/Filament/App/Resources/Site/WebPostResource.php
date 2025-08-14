<?php

namespace App\Filament\App\Resources\Site;

use App\Filament\App\Resources\Site\WebPostResource\Pages;
use App\Filament\App\Resources\Site\WebPostResource\RelationManagers;
use App\Models\WebPost;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class WebPostResource extends Resource
{
    protected static ?string $model = WebPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Site';

    public $filename;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tabs\Tab::make('Texto')
                                    ->schema([
                                        static::getTextFormSection()
                                    ]),
                                Tabs\Tab::make('Imagem')
                                    ->schema([
                                        static::getImageFormSection()
                                    ]),
                            ]),
                    ])

            ]);
    }

    public static function getTextFormSection()
    {
        return Group::make()
            ->schema([
                Split::make([
                    Group::make([
                        Forms\Components\RichEditor::make('text')
                            ->label('Conteúdo')
                            ->required()
                            ->extraInputAttributes(['style' => 'min-height: 20rem; max-height: 30vh; overflow-y: auto;'])
                            ->disableToolbarButtons(['attachFiles'])
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('text_credits')
                            ->label('Fonte do Texto')
                            ->default('Ascom/UEAP')
                            ->maxLength(255),
                    ]),
                    Group::make([
                        Forms\Components\Select::make('web_category_id')
                            ->label('Categoria')
                            ->preload()
                            ->relationship('category', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state) . '.html'))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->helperText('Preenchimento automático')
                            ->suffixIcon('heroicon-m-globe-alt')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options([
                                'draft' => 'Rascunho',
                                'published' => 'Publicado',
                                'unpublished' => 'Despublicado'
                            ]),
                        
                        Forms\Components\Toggle::make('featured')
                            ->label('Destaque')
                            ->required(),
                    ])
                ])
            ]);
    }

    public static function getImageFormSection()
    {
        return Group::make()
            ->schema([

                // SpatieMediaLibraryFileUpload::make('file')
                //     ->label('Arquivo (.jpg)')
                //     ->previewable(false)
                //     ->image(),

                FileUpload::make('file')
                    ->directory('web/posts')
                    ->acceptedFileTypes(['image/jpeg'])
                    ->previewable(false)
                    ->maxFiles(1)
                    ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.jpg'),

                Forms\Components\TextInput::make('image_subtitle')
                    ->label('Legenda')
                    ->maxLength(255),
                Forms\Components\TextInput::make('image_credits')
                    ->label('Fonte da Imagem')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('#'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->words(7)
                    // ->description(fn(WebPost $record): string => Str::limit($record->slug, 60))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('hits')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Data Publicação')
                    ->sortable()
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('user_created.login')
                    ->label('Autor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_updated.login')
                    ->label('Editado Por')
                    ->sortable(),
                Tables\Columns\TextColumn::make('web_category_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->url(fn($record) => $record->image_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->image_url)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListWebPosts::route('/'),
            'create' => Pages\CreateWebPost::route('/create'),
            // 'view' => Pages\ViewWebPost::route('/{record}'),
            'edit' => Pages\EditWebPost::route('/{record}/edit'),
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
