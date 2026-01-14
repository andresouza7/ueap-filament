<?php

namespace App\Filament\Resources\Social\WebPosts\Schemas;

use App\Models\WebMenu;
use App\Models\WebMenuPlace;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class WebPostForm
{

    /**
     * Blocos do Builder extraídos para métodos privados para limpeza do código principal.
     */
    private static function getTextBlock(): Block
    {
        return Block::make('text')
            ->label('Texto')
            ->icon('heroicon-m-bars-3-bottom-left')
            ->schema([
                RichEditor::make('body')
                    ->label('Conteúdo')
                    ->required()
                    ->disableToolbarButtons(['attachFiles'])
                    ->extraInputAttributes(['style' => 'min-height: 18rem;']),
            ]);
    }

    private static function getImageBlock(): Block
    {
        return Block::make('image')
            ->label('Galeria de Imagens')
            ->icon('heroicon-m-photo')
            ->schema([
                FileUpload::make('path')
                    ->label('Imagens')
                    ->multiple()
                    ->directory('test/web_posts')
                    ->minFiles(1)
                    ->maxFiles(10)
                    ->image()
                    ->reorderable()
                    ->required(),

                Grid::make(2)->schema([
                    TextInput::make('subtitle')->label('Legenda'),
                    TextInput::make('credits')->label('Fonte das Imagens'),
                ]),
            ]);
    }

    public static function getPageMenuSection(): Select
    {
        return Select::make('web_menu_id')
            ->label('Exibir menu nesta página?')
            ->helperText('Escolha um menu lateral ou crie um novo.')
            ->searchable()
            ->preload()
            ->relationship('web_menu', 'name', function ($query) {
                $query->whereHas('web_menu_place', fn($q) => $q->where('slug', 'pagina'));
            })
            ->createOptionModalHeading('Criar novo menu')
            ->createOptionForm([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->unique('web_menus', 'slug')
                    ->required(),
            ])
            ->createOptionUsing(function (array $data): int {
                $menuPlace = WebMenuPlace::where('slug', 'pagina')->first();

                return WebMenu::create([
                    ...$data,
                    'web_menu_place_id' => $menuPlace?->id,
                    'status' => 'published',
                    'position' => WebMenu::max('id') + 1,
                    'uuid' => (string) Str::uuid(),
                ])->getKey();
            });
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Grid principal de 3 colunas para simular layout profissional de CMS
                Grid::make(3)->schema([

                    // COLUNA ESQUERDA: Conteúdo da Publicação (2 colunas)
                    Group::make([
                        Section::make('Dados da Publicação')
                            ->schema([
                                Select::make('type')
                                    ->label('Tipo de Publicação')
                                    ->options([
                                        'news' => 'Notícia',
                                        'event' => 'Evento',
                                        'page' => 'Página'
                                    ])
                                    ->required()
                                    ->live(),

                                TextInput::make('title')
                                    ->label('Título')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(Set $set, ?string $state) =>
                                        $set('slug', Str::slug($state) . '.html')
                                    ),

                                TextInput::make('slug')
                                    ->label('URL Amigável (Slug)')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->suffixIcon('heroicon-m-globe-alt'),
                            ]),

                        Section::make('Corpo da Página')
                            ->description('Construa o layout da página inserindo blocos de texto ou imagem')
                            ->schema([
                                Builder::make('content')
                                    ->label('Blocos Dinâmicos')
                                    ->blocks([
                                        self::getTextBlock(),
                                        self::getImageBlock(),
                                    ])
                                    ->reorderable()
                                    ->collapsible()
                                    ->addActionLabel('Adicionar Bloco de Conteúdo')
                                    ->required(),
                            ]),
                    ])->columnSpan(2),

                    // COLUNA DIREITA: Metadados e Status (1 coluna)
                    Group::make([
                        Section::make('Configurações')
                            ->schema([
                                Select::make('status')
                                    ->label('Status da Publicação')
                                    ->required()
                                    ->options([
                                        'draft' => 'Rascunho',
                                        'published' => 'Publicado',
                                        'unpublished' => 'Despublicado',
                                    ]),

                                Select::make('web_category_id')
                                    ->label('Categoria')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('text_credits')
                                    ->label('Fonte do Texto')
                                    ->default('Ascom/UEAP'),

                                Toggle::make('featured')
                                    ->label('Destaque')
                                    ->visible(fn(Get $get) => $get('type') === 'news'),
                            ]),

                        Section::make('Menu')
                            ->description('Vínculo com menus do site')
                            ->schema([
                                self::getPageMenuSection(),
                            ])
                            ->visible(fn(Get $get) => $get('type') === 'page'),
                    ])->columnSpan(1),

                ]),

            ]);
    }
}
