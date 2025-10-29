<?php

namespace App\Filament\Resources\Social\SocialPosts\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SocialPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        RichEditor::make('text')
                            ->label('Texto')
                            ->required()
                            ->disableToolbarButtons(['attachFiles'])
                    ])

            ]);
    }
}
