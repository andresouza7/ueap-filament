<?php

namespace App\Filament\App\Resources\Social\SocialUserResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\TextSize;
use Filament\Actions\Action;
use App\Filament\App\Resources\Social\SocialGroupResource;
use App\Filament\App\Resources\Social\SocialPostResource;
use App\Filament\App\Resources\Social\SocialUserResource;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';
    protected static ?string $title = 'Postagens';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('uuid')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('login')
            ->columns([
                Stack::make([
                    Split::make([
                        ImageColumn::make('user.profile_photo_url')
                            ->grow(false)
                            ->size('60px')
                            ->circular(),
                        Stack::make([
                            Split::make([
                                TextColumn::make('user.login')
                                    ->url(fn($record) => SocialUserResource::getUrl('view', ['record' => $record->user->id]))
                                    ->weight(FontWeight::Bold)
                                    ->grow(false),

                                TextColumn::make('user.group.name')
                                    ->url(fn($record) => SocialGroupResource::getUrl('view', ['record' => optional($record->user->group)->id]))
                                    ->formatStateUsing(fn($state) => strtoupper($state))
                                    ->weight(FontWeight::Bold)
                                    ->color('primary')
                            ])->grow(false),

                            TextColumn::make('updated_at')
                                ->size(TextSize::ExtraSmall)
                                // ->extraAttributes(['class' => 'italic'])
                                ->color('gray')
                                ->dateTime('d M Y, H:i'),
                        ]),
                    ]),

                    TextColumn::make('text')
                        ->html()
                        ->searchable()
                ])->space(3)->extraAttributes(['class' => 'gap-2 p-2'])
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('Editar')
                    ->visible(fn($record) => $record->user_id === auth()->id())
                    ->url(fn($record) => SocialPostResource::getUrl('edit', ['record' => $record->id])),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
