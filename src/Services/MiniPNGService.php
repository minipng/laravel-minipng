<?php

namespace MiniPNG\LaravelMiniPNG\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use MiniPNG\LaravelMiniPNG\Contracts\MiniPNGInterface;
use MiniPNG\LaravelMiniPNG\Exceptions\MiniPNGException;

class MiniPNGService implements MiniPNGInterface
{
    private Client $client;
    private string $apiKey;
    private string $baseUrl;
    private string $apiVersion;

    public function __construct(string $apiKey, string $baseUrl = 'https://minipng.com')
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->apiVersion = config('minipng.api_version', 'v1');
        
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => config('minipng.timeout', 30),
            'headers' => [
                'X-User-Token' => $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * Compress an image file
     */
    public function compressImage(string $sourceUrl): array
    {
        return $this->makeRequest('POST', "/api/{$this->apiVersion}/compress/image", [
            'source_url' => $sourceUrl,
        ]);
    }

    /**
     * Convert an image to a different format
     */
    public function convertImage(string $sourceUrl, string $outputFormat, ?int $quality = null): array
    {
        $data = [
            'source_url' => $sourceUrl,
            'output_format' => $outputFormat,
        ];

        if ($quality !== null) {
            $data['quality'] = $quality;
        }

        return $this->makeRequest('POST', "/api/{$this->apiVersion}/convert/image", $data);
    }

    /**
     * Compress a PDF file
     */
    public function compressPdf(string $sourceUrl): array
    {
        return $this->makeRequest('POST', "/api/{$this->apiVersion}/compress/pdf", [
            'source_url' => $sourceUrl,
        ]);
    }

    /**
     * Convert PDF to images
     */
    public function convertPdfToImages(string $sourceUrl, ?string $imagesQuality = null, ?string $imagesFormat = null): array
    {
        $data = [
            'source_url' => $sourceUrl,
        ];

        if ($imagesQuality !== null) {
            $data['images_quality'] = $imagesQuality;
        }

        if ($imagesFormat !== null) {
            $data['images_format'] = $imagesFormat;
        }

        return $this->makeRequest('POST', "/api/{$this->apiVersion}/convert/pdf-to-images", $data);
    }

    /**
     * Get user profile and API usage information
     */
    public function getProfile(): array
    {
        return $this->makeRequest('GET', "/api/{$this->apiVersion}/profile");
    }

    /**
     * Make HTTP request to MiniPNG API
     */
    private function makeRequest(string $method, string $endpoint, array $data = []): array
    {
        try {
            $options = [];

            if ($method === 'GET') {
                $options['query'] = $data;
            } else {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $endpoint, $options);
            $body = json_decode($response->getBody()->getContents(), true);

            return $body ?? [];

        } catch (GuzzleException $e) {
            $statusCode = $e->getCode();
            $message = $e->getMessage();

            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);
                $message = $responseBody['message'] ?? $responseBody['error'] ?? $message;
            }

            throw new MiniPNGException($message, $statusCode, $e);
        }
    }
} 