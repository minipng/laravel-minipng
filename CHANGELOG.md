# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-06-29

### Added
- Initial release of Laravel MiniPNG Package
- Image compression functionality
- Image format conversion (PNG, JPG, JPEG, WebP, GIF)
- PDF compression functionality
- PDF to images conversion
- User profile and API usage information
- Comprehensive error handling with custom exceptions
- Facade for easy access to all methods
- Service Provider for Laravel integration
- Configuration file with environment variables support
- Complete documentation with examples
- Unit tests with mock responses
- Artisan command examples
- Controller examples for web applications

### Features
- **Image Processing**
  - `compressImage()` - Compress images while maintaining quality
  - `convertImage()` - Convert between different image formats with quality control

- **PDF Processing**
  - `compressPdf()` - Reduce PDF file sizes
  - `convertPdfToImages()` - Convert PDF pages to images with quality and format options

- **User Information**
  - `getProfile()` - Get user profile and API usage statistics

### Technical Details
- PHP 8.0+ support
- Laravel 9.0+, 10.0+, 11.0+ support
- GuzzleHTTP for API communication
- Comprehensive error handling
- Type hints and return types
- PSR-4 autoloading
- MIT License

### Installation
```bash
composer require minipng/laravel-minipng
php artisan vendor:publish --tag=minipng-config
```

### Configuration
Add to your `.env` file:
```env
MINIPNG_API_KEY=your_api_key_here
MINIPNG_BASE_URL=https://minipng.com
```

### Usage
```php
use MiniPNG\LaravelMiniPNG\Facades\MiniPNG;

// Compress image
$result = MiniPNG::compressImage('https://example.com/image.jpg');

// Convert image format
$result = MiniPNG::convertImage('https://example.com/image.jpg', 'webp', 90);
``` 