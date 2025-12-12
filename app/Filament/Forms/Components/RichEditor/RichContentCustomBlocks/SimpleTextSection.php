<?php

namespace App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks;

use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class SimpleTextSection extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'simple_text_section';
    }

    public static function getLabel(): string
    {
        return 'Simple text section';
    }

    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the simple text section')
            ->schema([
                //
                TextInput::make('title')
                    ->label('Título da Seção')
                    ->placeholder('Ex: Apresentação, Metodologia, Objetivos')
                    ->required(),

                RichEditor::make('content')
                    ->label('Conteúdo da Seção')
                    ->placeholder('Insira aqui o texto descritivo da seção...')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'blockquote',
                    ])
                    ->required(),
            ]);
    }

    public static function toPreviewHtml(array $config): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.simple-text-section.preview', [
            //
            'title' => $config['title'],
            'content' => $config['content'],
        ])->render();
    }

    public static function toHtml(array $config, array $data): string
    {
        return view('filament.forms.components.rich-editor.rich-content-custom-blocks.simple-text-section.index', [
            //
            'title' => $config['title'],
            'content' => $config['content'],
        ])->render();
    }
}
