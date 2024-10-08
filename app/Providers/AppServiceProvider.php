<?php

namespace App\Providers;

use App\Models\Asesor;
use App\Models\Property;
use App\Observers\AsesorObserver;
use App\Observers\PropertyObserver;
use Illuminate\Support\ServiceProvider;

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
        Asesor::observe(AsesorObserver::class);
        Property::Observe(PropertyObserver::class);
    }
}
