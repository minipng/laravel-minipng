<?php

namespace MiniPNG\LaravelMiniPNG\Contracts;

interface MiniPNGInterface
{
    /**
     * Compress an image file
     *
     * @param string $sourceUrl
     * @return array
     */
    public function compressImage(string $sourceUrl): array;

    /**
     * Convert an image to a different format
     *
     * @param string $sourceUrl
     * @param string $outputFormat
     * @param int|null $quality
     * @return array
     */
    public function convertImage(string $sourceUrl, string $outputFormat, ?int $quality = null): array;

    /**
     * Compress a PDF file
     *
     * @param string $sourceUrl
     * @return array
     */
    public function compressPdf(string $sourceUrl): array;

    /**
     * Convert PDF to images
     *
     * @param string $sourceUrl
     * @param string|null $imagesQuality
     * @param string|null $imagesFormat
     * @return array
     */
    public function convertPdfToImages(string $sourceUrl, ?string $imagesQuality = null, ?string $imagesFormat = null): array;

    /**
     * Get user profile and API usage information
     *
     * @return array
     */
    public function getProfile(): array;
} 