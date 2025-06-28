<?php

namespace MiniPNG\LaravelMiniPNG;

use Illuminate\Support\ServiceProvider;
use MiniPNG\LaravelMiniPNG\Services\MiniPNGService;
use MiniPNG\LaravelMiniPNG\Contracts\MiniPNGInterface;

class MiniPNGServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/minipng.php', 'minipng');

        $this->app->singleton(MiniPNGInterface::class, function ($app) {
            return new MiniPNGService(
                config('minipng.api_key'),
                config('minipng.base_url', 'https://minipng.com')
            );
        });

        $this->app->alias(MiniPNGInterface::class, 'minipng');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/minipng.php' => config_path('minipng.php'),
            ], 'minipng-config');
        }
    }
} 