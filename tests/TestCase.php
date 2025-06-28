<?php

namespace MiniPNG\LaravelMiniPNG\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use MiniPNG\LaravelMiniPNG\MiniPNGServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            MiniPNGServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // Setup MiniPNG configuration
        $app['config']->set('minipng.api_key', 'test_api_key');
        $app['config']->set('minipng.base_url', 'https://minipng.com');
        $app['config']->set('minipng.api_version', 'v1');
        $app['config']->set('minipng.timeout', 30);
        $app['config']->set('minipng.retry_attempts', 3);
        $app['config']->set('minipng.default_image_quality', 85);
        $app['config']->set('minipng.default_pdf_images_quality', 'medium');
        $app['config']->set('minipng.default_pdf_images_format', 'png');
    }
} 