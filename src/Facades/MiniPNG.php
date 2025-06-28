<?php

namespace MiniPNG\LaravelMiniPNG\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array compressImage(string $sourceUrl)
 * @method static array convertImage(string $sourceUrl, string $outputFormat, ?int $quality = null)
 * @method static array compressPdf(string $sourceUrl)
 * @method static array convertPdfToImages(string $sourceUrl, ?string $imagesQuality = null, ?string $imagesFormat = null)
 * @method static array getProfile()
 *
 * @see \MiniPNG\LaravelMiniPNG\Services\MiniPNGService
 */
class MiniPNG extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'minipng';
    }
} 