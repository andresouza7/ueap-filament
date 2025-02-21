<?php

// barra de navegação lateral em um recurso

use Filament\Resources\Pages\Page;

public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            EditWebPage::class,
        ]);
    }
