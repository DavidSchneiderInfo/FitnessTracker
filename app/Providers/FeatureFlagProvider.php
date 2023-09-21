<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class FeatureFlagProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        /*
        Laravel\Pennant\Feature::define('feature-name', function (): bool {
            return true;
        });
        */
    }
}
