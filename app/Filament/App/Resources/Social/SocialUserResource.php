<?php

namespace App\Filament\App\Resources\Social;

use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Actions\BulkActionGroup;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Actions;
use Filament\Actions\Action;
use Filament\Schemas\Components\Flex;
use App\Filament\App\Resources\Social\SocialUserResource\Pages\ListSocialUser;
use App\Filament\App\Resources\Social\SocialUserResource\Pages\ViewSocialUser;
use App\Filament\App\Resources\Social\SocialUserResource\Pages;
use App\Filament\App\Resources\Social\SocialUserResource\RelationManagers\CalendarOccurrencesRelationManager;
use App\Filament\App\Resources\Social\SocialUserResource\RelationManagers\OrdinancesRelationManager;
use App\Filament\App\Resources\Social\SocialUserResource\RelationManagers\PostsRelationManager;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SocialUserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'Servidor';
    protected static ?string $pluralModelLabel = 'Servidores';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';
    protected static ?string $slug = 'servidor';
    protected static string | \UnitEnum | null $navigationGroup = 'Social';
    protected static ?int $navigationSort = 2;
    protected static bool $shouldSkipAuthorization = true;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Consulta de Servidores da UEAP')
            ->description('Lista dos servidores da universidade, seus cargos e lotações. Use o filtro de busca para encontrar informações.')
            ->defaultSort('login')
            ->columns([
                Split::make([
                    ImageColumn::make('profile_photo_url')
                        ->grow(false)
                        ->size('70px')
                        ->circular(),
                    Stack::make([
                        TextColumn::make('login')
                            ->size('100px')
                            ->weight(FontWeight::SemiBold)
                            ->formatStateUsing(fn($state) => collect(explode('.', $state))
                                ->map(fn($part) => ucfirst(trim($part)))
                                ->implode(' '))
                            ->searchable(),

                        Stack::make([
                            TextColumn::make('effective_role.description')
                                ->tooltip(fn($state) => $state)
                                ->size(TextSize::ExtraSmall)
                                ->color('gray')
                                ->weight(FontWeight::SemiBold)
                                ->words(5)
                                ->columnSpanFull()
                                ->formatStateUsing(fn($state) => strtoupper($state)),

                            TextColumn::make('group.name')
                                ->color('primary')
                                ->formatStateUsing(fn($state) => strtoupper($state))
                                ->size(TextSize::ExtraSmall)
                                ->weight(FontWeight::SemiBold),
                        ])
                    ])->space(2)

                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados Funcionais')
                    ->columns(3)
                    ->schema([
                        Group::make([

                            ImageEntry::make('profile_photo_url')
                                ->grow(false)
                                ->hiddenLabel()
                                ->circular()
                                ->alignCenter()
                                ->columnSpan(1)
                                ->size(200),

                            TextEntry::make('login')
                                ->size(TextSize::Large)
                                ->weight(FontWeight::Bold)
                                ->alignCenter()
                                ->hiddenLabel(),
                            TextEntry::make('enrollment')
                                ->formatStateUsing(fn($state) => "Mat.: " . $state)
                                ->hiddenLabel()
                                ->alignCenter()
                                ->copyable()
                                ->badge()
                                ->color('success'),

                            Actions::make([
                                Action::make('Alterar Foto')
                                    ->size('xs')
                                    // ->badge()
                                    ->color('gray')
                                    ->extraAttributes(['class' => 'px-2 py-1'])
                                    ->icon('heroicon-m-pencil')
                                    ->visible(fn($record) => $record->id === Auth::id())
                                    ->schema([
                                        FileUpload::make('attachment')
                                            ->label('Arquivo')
                                            ->directory('users')
                                            ->uploadingMessage('Fazendo upload...')
                                            ->image()
                                            ->acceptedFileTypes(['image/jpeg'])
                                            ->avatar()
                                            ->imageEditor()
                                            // ->circleCropper()
                                            ->maxSize(1024 * 10)
                                            ->getUploadedFileNameForStorageUsing(
                                                fn(TemporaryUploadedFile $file, $record): string => "{$record->id}.jpg"
                                            )
                                            ->helperText('*Salve as alterações para concluir.')
                                    ])
                                    ->action(function (array $data, $record): void {
                                        redirect()->route('filament.app.resources.servidor.view', $record->id);
                                    })
                            ])->alignCenter(),
                        ])->extraAttributes(['class' => 'h-full flex items-center justify-center']),

                        Group::make([
                            Flex::make([
                                TextEntry::make('person.name')
                                    ->label('Nome')
                            ]),

                            TextEntry::make('email')
                                ->label('Email')
                                ->icon('heroicon-m-envelope'),
                            TextEntry::make('group.description')
                                ->url(fn($record) => $record->group ? SocialGroupResource::getUrl('view', ['record' => $record->group->id]) : null)
                                ->label('Lotação')
                                ->icon('heroicon-o-building-office-2'),
                            TextEntry::make('effective_role.description')
                                ->label('Cargo Efetivo')
                                ->icon('heroicon-o-briefcase'),
                            TextEntry::make('commissioned_role.description')
                                ->label('Cargo Comissionado')
                                ->icon('heroicon-o-briefcase')
                                ->columnSpanFull(),
                            TextEntry::make('groups.name')
                                ->label('Meus acessos')
                                ->formatStateUsing(fn($record) => $record->groups->pluck('name')->join(', '))
                                ->visible(fn($record) => $record->id === auth()->id())
                        ])->columnStart([
                            'sm' => 2,
                        ])
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            PostsRelationManager::class,
            OrdinancesRelationManager::class,
            CalendarOccurrencesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSocialUser::route('/'),
            'view' => ViewSocialUser::route('/{record}'),
        ];
    }
}
