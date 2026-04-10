<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Providers\R;
use Illuminate\Support\Facades\Route;
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
        // \Livewire\Livewire::setUpdateRoute(function ($handle) {
        //     return Route::post('siasn_clone_2025/livewire/update', $handle);
        // });
    }
}
