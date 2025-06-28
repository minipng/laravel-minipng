<?php

namespace MiniPNG\LaravelMiniPNG\Exceptions;

use Exception;
use Throwable;

class MiniPNGException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the exception's context information.
     */
    public function context(): array
    {
        return [
            'api' => 'minipng',
            'base_url' => config('minipng.base_url', 'https://minipng.com'),
        ];
    }
} 