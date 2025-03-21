<?php

use Filament\Panel;
use Filament\Support\Colors\Color;

function clean_text($text)
{
    $map = array(
        "\\n" => "",
        "\\r" => "",
        "LEGISLAÇÃO " => "Legislacao",
        "http://www2.ueap.edu.br/Arquivos/" => "http://www.ueap.edu.br/storage/old_files/Arquivos/"
    );

    return strtr($text, $map);
}

function styleFilamentPanel(Panel $panel): Panel
{
    return $panel->font('Karla')
        ->colors([
            'primary' => Color::Teal,
        ]);
}
