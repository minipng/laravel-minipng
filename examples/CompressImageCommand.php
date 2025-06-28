<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MiniPNG\LaravelMiniPNG\Facades\MiniPNG;
use MiniPNG\LaravelMiniPNG\Exceptions\MiniPNGException;

class CompressImageCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'image:compress 
                            {url : The URL of the image to compress}
                            {--format= : Output format (png, jpg, jpeg, webp, gif)}
                            {--quality= : Image quality (1-100)}';

    /**
     * The console command description.
     */
    protected $description = 'Compress or convert an image using MiniPNG API';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $url = $this->argument('url');
        $format = $this->option('format');
        $quality = $this->option('quality');

        $this->info("Processing image: {$url}");

        try {
            if ($format) {
                // Convert image
                $result = MiniPNG::convertImage($url, $format, $quality ? (int) $quality : null);
                $this->info("Image converted successfully!");
            } else {
                // Compress image
                $result = MiniPNG::compressImage($url);
                $this->info("Image compressed successfully!");
            }

            // Display results
            $this->table(['Metric', 'Value'], [
                ['Original Size', $this->formatBytes($result['size_before'])],
                ['Processed Size', $this->formatBytes($result['size_after'])],
                ['Compression', $result['compression_percentage'] ?? 'N/A'],
                ['Output Format', $result['output_ext'] ?? 'N/A'],
                ['Download URL', $result['download'] ?? 'N/A'],
            ]);

            return Command::SUCCESS;

        } catch (MiniPNGException $e) {
            $this->error("Processing failed: " . $e->getMessage());
            return Command::FAILURE;
        } catch (\Exception $e) {
            $this->error("Unexpected error: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
} 