<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MiniPNG\LaravelMiniPNG\Contracts\MiniPNGInterface;

class MiniPNGAppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register MiniPNG service as a singleton
        $this->app->singleton('minipng.service', function ($app) {
            return $app->make(MiniPNGInterface::class);
        });

        // Register MiniPNG facade alias
        $this->app->alias('minipng.service', MiniPNGInterface::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration if not already published
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../../vendor/minipng/laravel-minipng/config/minipng.php' => config_path('minipng.php'),
        ], 'minipng-config');

        // Register commands
        $this->commands([
            \App\Console\Commands\CompressImageCommand::class,
        ]);
    }
} 