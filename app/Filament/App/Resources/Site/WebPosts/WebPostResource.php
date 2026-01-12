<?php

namespace App\Filament\App\Resources\Site\WebPosts;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use App\Filament\App\Resources\Site\WebPosts\Pages\ListWebPosts;
use App\Filament\App\Resources\Site\WebPosts\Pages\CreateWebPost;
use App\Filament\App\Resources\Site\WebPosts\Pages\EditWebPost;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\App\Resources\Site\WebPostResource\Pages;
use App\Models\WebPost;
use Filament\Forms;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Split;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class WebPostResource extends Resource
{
    protected static ?string $model = WebPost::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static string | \UnitEnum | null $navigationGroup = 'Site';

    public $filename;

    protected static function textBlock(): Block
    {
        return Block::make('text')
            ->label('Texto')
            ->schema([
                RichEditor::make('body')
                    ->label('Conteúdo')
                    ->required()
                    ->disableToolbarButtons(['attachFiles'])
                    ->extraInputAttributes(['style' => 'min-height: 18rem;']),
            ]);
    }

    protected static function ImageBlock(): Block
    {
        return Block::make('gallery')
            ->label('Imagem / Galeria')
            ->schema([
                FileUpload::make('path')
                    ->label('Imagens')
                    ->multiple()
                    ->directory('test/web_posts')
                    ->minFiles(1)
                    ->maxFiles(10)
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->reorderable()
                    ->previewable(false)
                    ->required(),

                TextInput::make('subtitle')
                    ->label('Legenda'),

                TextInput::make('credits')
                    ->label('Fonte das Imagens'),
            ]);
    }

    public static function PageContentBlock(): ComponentsBuilder
    {
        return ComponentsBuilder::make('content')
            ->label('Conteúdo')
            ->columnSpan(2)
            ->blocks([
                static::textBlock(),
                static::ImageBlock(),
            ])
            ->reorderable()
            ->collapsible()
            ->addActionLabel('Adicionar bloco')
            ->required();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)->schema([

                // LEFT: Main content (builder)
                static::PageContentBlock(),

                // RIGHT: Post metadata (keeps your existing logic)
                Group::make([
                    Select::make('web_category_id')
                        ->label('Categoria')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->required(),

                    TextInput::make('title')
                        ->label('Título')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(
                            fn(Set $set, ?string $state) =>
                            $set('slug', Str::slug($state) . '.html')
                        ),

                    TextInput::make('slug')
                        ->required()
                        ->suffixIcon('heroicon-m-globe-alt'),

                    Select::make('status')
                        ->required()
                        ->options([
                            'draft' => 'Rascunho',
                            'published' => 'Publicado',
                            'unpublished' => 'Despublicado',
                        ]),

                    Toggle::make('featured')->label('Destaque'),

                    TextInput::make('text_credits')
                        ->label('Fonte do Texto')
                        ->default('Ascom/UEAP'),
                ]),

            ]),
        ]);
    }


    public static function getTextFormSection()
    {
        return Group::make()->columns(3)
            ->schema([

                Group::make([
                    RichEditor::make('text')
                        ->label('Conteúdo')
                        ->required()
                        ->formatStateUsing(fn($state) => clean_text($state))
                        ->extraInputAttributes(['style' => 'min-height: 25.7rem;'])
                        ->disableToolbarButtons(['attachFiles'])
                        ->columnSpanFull(),
                ])->columnSpan(2),
                Group::make([
                    Select::make('web_category_id')
                        ->label('Categoria')
                        ->preload()
                        ->relationship('category', 'name')
                        ->searchable()
                        ->required(),
                    TextInput::make('title')
                        ->label('Título')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state) . '.html'))
                        ->maxLength(255),
                    TextInput::make('slug')
                        ->required()
                        ->helperText('Preenchimento automático')
                        ->suffixIcon('heroicon-m-globe-alt')
                        ->maxLength(255),
                    Select::make('status')
                        ->required()
                        ->options([
                            'draft' => 'Rascunho',
                            'published' => 'Publicado',
                            'unpublished' => 'Despublicado'
                        ]),

                    Toggle::make('featured')
                        ->label('Destaque')
                        ->required(),
                    TextInput::make('text_credits')
                        ->label('Fonte do Texto')
                        ->default('Ascom/UEAP')
                        ->maxLength(255),
                ])
            ]);
    }

    public static function getImageFormSection()
    {
        return Group::make()
            ->schema([
                FileUpload::make('file')
                    ->label('Imagem JPG')
                    ->directory('web/posts')
                    ->acceptedFileTypes(['image/jpeg'])
                    ->previewable(false)
                    ->maxFiles(1)
                    ->getUploadedFileNameForStorageUsing(fn($record) => $record?->id . '.jpg'),

                TextInput::make('image_subtitle')
                    ->label('Legenda')
                    ->maxLength(255),
                TextInput::make('image_credits')
                    ->label('Fonte da Imagem')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                ImageColumn::make('image_url')
                    ->label('#'),
                TextColumn::make('title')
                    ->label('Título')
                    ->words(7)
                    // ->description(fn(WebPost $record): string => Str::limit($record->slug, 60))
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('hits')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Data Publicação')
                    ->sortable()
                    ->dateTime('d/m/Y'),
                TextColumn::make('user_created')
                    ->label('Editado por')
                    ->formatStateUsing(fn($record) => $record->user_updated?->login ?? $record->user_created->login),
                TextColumn::make('web_category_id')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                EditAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
                Action::make('download')
                    ->url(fn($record) => $record->image_url)
                    ->openUrlInNewTab()
                    ->visible(fn($record) => $record->image_url)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
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
            'index' => ListWebPosts::route('/'),
            'create' => CreateWebPost::route('/create'),
            // 'view' => Pages\ViewWebPost::route('/{record}'),
            'edit' => EditWebPost::route('/{record}/edit'),
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
