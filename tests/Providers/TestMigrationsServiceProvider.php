<?php

namespace Tests\Providers;

use Illuminate\Support\ServiceProvider;

class TestMigrationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        dd('Provider carregado!');

        
        // migrations padrão
        $this->loadMigrationsFrom(database_path('migrations'));

        // migrations extras
        $this->loadMigrationsFrom(database_path('migrations/default'));
    }
    }
}
