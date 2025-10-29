<?php

namespace App\Filament\Resources\DocumentCategories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options([
                        'published' => 'Publicado',
                        'unpublished' => 'Despublicado'
                    ])
                    ->required(),
                Select::make('type')
                    ->label('Tipo')
                    ->required()
                    ->options([
                        'general' => 'Geral',
                        'transparency' => 'Transparência'
                    ])
                    ->default('general'),
                Select::make('groups')
                    ->label('Liberar acesso para')
                    ->relationship('groups', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ]);
    }
}
