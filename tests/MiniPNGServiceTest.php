<?php

namespace MiniPNG\LaravelMiniPNG\Tests;

use Orchestra\Testbench\TestCase;
use MiniPNG\LaravelMiniPNG\Services\MiniPNGService;
use MiniPNG\LaravelMiniPNG\Exceptions\MiniPNGException;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Middleware;

class MiniPNGServiceTest extends TestCase
{
    private MiniPNGService $service;
    private array $container = [];

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a mock handler
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'success' => true,
                'output_ext' => 'jpg',
                'size_before' => 1024000,
                'size_after' => 512000,
                'compression_percentage' => '50%',
                'download' => 'https://example.com/compressed/image.jpg'
            ])),
        ]);

        $handlerStack = HandlerStack::create($mock);
        
        // Add history middleware to capture requests
        $history = Middleware::history($this->container);
        $handlerStack->push($history);

        $client = new Client(['handler' => $handlerStack]);
        
        $this->service = new MiniPNGService('test_api_key', 'https://minipng.com');
        
        // Use reflection to set the mock client
        $reflection = new \ReflectionClass($this->service);
        $property = $reflection->getProperty('client');
        $property->setAccessible(true);
        $property->setValue($this->service, $client);
    }

    public function test_compress_image()
    {
        $result = $this->service->compressImage('https://example.com/image.jpg');
        
        $this->assertIsArray($result);
        $this->assertTrue($result['success']);
        $this->assertEquals('jpg', $result['output_ext']);
        $this->assertEquals(1024000, $result['size_before']);
        $this->assertEquals(512000, $result['size_after']);
        $this->assertEquals('50%', $result['compression_percentage']);
    }

    public function test_convert_image()
    {
        $result = $this->service->convertImage('https://example.com/image.jpg', 'webp', 90);
        
        $this->assertIsArray($result);
        $this->assertTrue($result['success']);
    }

    public function test_compress_pdf()
    {
        $result = $this->service->compressPdf('https://example.com/document.pdf');
        
        $this->assertIsArray($result);
        $this->assertTrue($result['success']);
    }

    public function test_convert_pdf_to_images()
    {
        $result = $this->service->convertPdfToImages('https://example.com/document.pdf', 'high', 'jpg');
        
        $this->assertIsArray($result);
        $this->assertTrue($result['success']);
    }

    public function test_get_profile()
    {
        $result = $this->service->getProfile();
        
        $this->assertIsArray($result);
        $this->assertTrue($result['success']);
    }

    protected function getPackageProviders($app)
    {
        return [
            \MiniPNG\LaravelMiniPNG\MiniPNGServiceProvider::class,
        ];
    }
} 