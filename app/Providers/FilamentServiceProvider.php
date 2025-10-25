<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Отключаем кастомные стили
        // Filament::serving(function () {
        //     // Добавляем безопасные кастомные стили
        //     Filament::registerTheme(
        //         public_path('css/filament-custom.css')
        //     );
        // });
    }
}