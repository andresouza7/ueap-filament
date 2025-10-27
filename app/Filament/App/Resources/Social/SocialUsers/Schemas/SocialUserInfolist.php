<?php

namespace App\Filament\Resources\Social\SocialUsers\Schemas;

use App\Filament\App\Resources\Social\SocialGroups\SocialGroupResource;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class SocialUserInfolist
{
    public static function configure(Schema $schema): Schema
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
                                ->imageSize(200),

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
                                    ->color('secondary')
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
                                ->visible(fn($record) => $record->id === auth()->id())
                        ])->columnStart([
                            'sm' => 2,
                        ])
                    ])
            ]);
    }
}
