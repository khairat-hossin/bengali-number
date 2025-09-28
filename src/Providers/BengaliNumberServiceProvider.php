<?php
// src/Providers/BengaliNumberServiceProvider.php

namespace Khairat\BengaliNumber\Providers;

use Illuminate\Support\ServiceProvider;
use Khairat\BengaliNumber\BengaliNumberConverter;

class BengaliNumberServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('bengali-number', function ($app) {
            return new BengaliNumberConverter();
        });

        $this->mergeConfigFrom(
            __DIR__.'/../../config/bengali-number.php', 'bengali-number'
        );
    }

    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__.'/../../config/bengali-number.php' => config_path('bengali-number.php'),
        ], 'bengali-number-config');
    }
}
