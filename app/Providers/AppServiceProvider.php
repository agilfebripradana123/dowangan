<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id'); // ⬅️ penting
    setlocale(LC_TIME, 'id_ID.UTF-8'); // ⬅️ dukungan bahasa sistem
    Paginator::useBootstrap(); // Tambahkan ini
    }
}
