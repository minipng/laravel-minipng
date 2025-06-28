<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MiniPNG API Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the MiniPNG API integration.
    |
    */

    // Your MiniPNG API Key
    'api_key' => env('MINIPNG_API_KEY', ''),

    // MiniPNG API Base URL
    'base_url' => env('MINIPNG_BASE_URL', 'https://minipng.com'),

    // API Version
    'api_version' => env('MINIPNG_API_VERSION', 'v1'),

    // Request timeout in seconds
    'timeout' => env('MINIPNG_TIMEOUT', 30),

    // Retry attempts on failure
    'retry_attempts' => env('MINIPNG_RETRY_ATTEMPTS', 3),

    // Default image quality for conversions
    'default_image_quality' => env('MINIPNG_DEFAULT_IMAGE_QUALITY', 85),

    // Default PDF to images quality
    'default_pdf_images_quality' => env('MINIPNG_DEFAULT_PDF_IMAGES_QUALITY', 'medium'),

    // Default PDF to images format
    'default_pdf_images_format' => env('MINIPNG_DEFAULT_PDF_IMAGES_FORMAT', 'png'),
]; 