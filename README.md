# Laravel MiniPNG Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/minipng/laravel-minipng.svg)](https://packagist.org/packages/minipng/laravel-minipng)
[![Total Downloads](https://img.shields.io/packagist/dt/minipng/laravel-minipng.svg)](https://packagist.org/packages/minipng/laravel-minipng)
[![License](https://img.shields.io/packagist/l/minipng/laravel-minipng.svg)](https://github.com/minipng/laravel-minipng/blob/main/LICENSE.md)
[![Tests](https://github.com/minipng/laravel-minipng/workflows/Tests/badge.svg)](https://github.com/minipng/laravel-minipng/actions)

Laravel package for integrating with MiniPNG API - Image and PDF processing services.

**Version:** 1.0.0  
**Release Date:** June 29, 2025

## Features

- 🖼️ **Image Compression** - Compress images while maintaining quality
- 🔄 **Image Format Conversion** - Convert between PNG, JPG, JPEG, WebP, GIF
- 📄 **PDF Compression** - Reduce PDF file sizes
- 🖼️ **PDF to Images** - Convert PDF pages to images
- 👤 **User Profile** - Get API usage information
- 🛡️ **Error Handling** - Comprehensive exception handling
- ⚙️ **Configuration** - Easy configuration management

## Requirements

- PHP 8.0 or higher
- Laravel 9.0, 10.0, or 11.0
- MiniPNG API key

## Installation

1. Install the package via Composer:

```bash
composer require minipng/laravel-minipng
```

2. Publish the configuration file:

```bash
php artisan vendor:publish --tag=minipng-config
```

3. Add your MiniPNG API key to your `.env` file:

```env
MINIPNG_API_KEY=your_api_key_here
MINIPNG_BASE_URL=https://minipng.com
```

## Configuration

The configuration file `config/minipng.php` contains the following options:

```php
return [
    'api_key' => env('MINIPNG_API_KEY', ''),
    'base_url' => env('MINIPNG_BASE_URL', 'https://minipng.com'),
    'api_version' => env('MINIPNG_API_VERSION', 'v1'),
    'timeout' => env('MINIPNG_TIMEOUT', 30),
    'retry_attempts' => env('MINIPNG_RETRY_ATTEMPTS', 3),
    'default_image_quality' => env('MINIPNG_DEFAULT_IMAGE_QUALITY', 85),
    'default_pdf_images_quality' => env('MINIPNG_DEFAULT_PDF_IMAGES_QUALITY', 'medium'),
    'default_pdf_images_format' => env('MINIPNG_DEFAULT_PDF_IMAGES_FORMAT', 'png'),
];
```

## Usage

### Using the Facade

```php
use MiniPNG\LaravelMiniPNG\Facades\MiniPNG;

// Compress an image
$result = MiniPNG::compressImage('https://example.com/image.jpg');

// Convert image format
$result = MiniPNG::convertImage('https://example.com/image.jpg', 'webp', 90);

// Compress PDF
$result = MiniPNG::compressPdf('https://example.com/document.pdf');

// Convert PDF to images
$result = MiniPNG::convertPdfToImages('https://example.com/document.pdf', 'high', 'jpg');

// Get user profile
$profile = MiniPNG::getProfile();
```

### Using Dependency Injection

```php
use MiniPNG\LaravelMiniPNG\Contracts\MiniPNGInterface;

class ImageController extends Controller
{
    public function __construct(private MiniPNGInterface $minipng)
    {
    }

    public function compress(Request $request)
    {
        $result = $this->minipng->compressImage($request->input('image_url'));
        return response()->json($result);
    }
}
```

### Using the Service Container

```php
$minipng = app('minipng');
$result = $minipng->compressImage('https://example.com/image.jpg');
```

## API Methods

### Image Processing

#### compressImage(string $sourceUrl): array
Compress an image file to reduce its size while maintaining quality.

```php
$result = MiniPNG::compressImage('https://example.com/image.jpg');
```

#### convertImage(string $sourceUrl, string $outputFormat, ?int $quality = null): array
Convert an image to a different format.

```php
// Convert to WebP with 90% quality
$result = MiniPNG::convertImage('https://example.com/image.jpg', 'webp', 90);

// Convert to PNG with default quality
$result = MiniPNG::convertImage('https://example.com/image.jpg', 'png');
```

**Supported formats:** `png`, `jpg`, `jpeg`, `webp`, `gif`

### PDF Processing

#### compressPdf(string $sourceUrl): array
Compress a PDF file to reduce its size while maintaining quality.

```php
$result = MiniPNG::compressPdf('https://example.com/document.pdf');
```

#### convertPdfToImages(string $sourceUrl, ?string $imagesQuality = null, ?string $imagesFormat = null): array
Convert a PDF document to a set of images (one per page).

```php
// Convert to high-quality JPG images
$result = MiniPNG::convertPdfToImages('https://example.com/document.pdf', 'high', 'jpg');

// Convert to medium-quality PNG images (default)
$result = MiniPNG::convertPdfToImages('https://example.com/document.pdf');
```

**Quality options:** `low`, `medium`, `high`
**Format options:** `png`, `jpg`

### User Information

#### getProfile(): array
Get user profile and API usage information.

```php
$profile = MiniPNG::getProfile();
```

## Response Format

### Success Response (200/201)
```json
{
   "success": true,
   "output_ext": "jpg",
   "size_before": 1024000,
   "size_after": 512000,
   "compression_percentage": "50%",
   "download": "https://example.com/compressed/image.jpg"
}
```

### Error Response (400/404/500)
```json
{
   "error": "Invalid source URL provided",
   "message": "The provided URL is not accessible or invalid"
}
```

## Error Handling

The package throws `MiniPNGException` for API errors:

```php
use MiniPNG\LaravelMiniPNG\Exceptions\MiniPNGException;

try {
    $result = MiniPNG::compressImage('https://example.com/image.jpg');
} catch (MiniPNGException $e) {
    // Handle API errors
    Log::error('MiniPNG API Error: ' . $e->getMessage());
}
```

## Examples

### Controller Example

```php
<?php

namespace App\Http\Controllers;

use MiniPNG\LaravelMiniPNG\Facades\MiniPNG;
use MiniPNG\LaravelMiniPNG\Exceptions\MiniPNGException;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function compress(Request $request)
    {
        $request->validate([
            'image_url' => 'required|url',
        ]);

        try {
            $result = MiniPNG::compressImage($request->input('image_url'));
            
            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (MiniPNGException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function convert(Request $request)
    {
        $request->validate([
            'image_url' => 'required|url',
            'format' => 'required|in:png,jpg,jpeg,webp,gif',
            'quality' => 'nullable|integer|min:1|max:100',
        ]);

        try {
            $result = MiniPNG::convertImage(
                $request->input('image_url'),
                $request->input('format'),
                $request->input('quality')
            );
            
            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (MiniPNGException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
```

### Artisan Command Example

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MiniPNG\LaravelMiniPNG\Facades\MiniPNG;

class CompressImage extends Command
{
    protected $signature = 'image:compress {url}';
    protected $description = 'Compress an image using MiniPNG API';

    public function handle()
    {
        $url = $this->argument('url');

        $this->info("Compressing image: {$url}");

        try {
            $result = MiniPNG::compressImage($url);
            
            $this->info("Compression successful!");
            $this->table(['Metric', 'Value'], [
                ['Original Size', $result['size_before'] . ' bytes'],
                ['Compressed Size', $result['size_after'] . ' bytes'],
                ['Compression', $result['compression_percentage']],
                ['Download URL', $result['download']],
            ]);
        } catch (\Exception $e) {
            $this->error("Compression failed: " . $e->getMessage());
        }
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@minipng.com instead of using the issue tracker.

## Credits

- [MiniPNG Team](https://github.com/minipng)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

For support, please contact: info@minipng.com 