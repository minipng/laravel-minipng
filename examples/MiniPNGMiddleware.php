<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use MiniPNG\LaravelMiniPNG\Facades\MiniPNG;
use MiniPNG\LaravelMiniPNG\Exceptions\MiniPNGException;

class MiniPNGMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if API key is configured
        if (empty(config('minipng.api_key'))) {
            return response()->json([
                'success' => false,
                'message' => 'MiniPNG API key is not configured',
            ], 500);
        }

        // Validate API key by making a test request
        try {
            MiniPNG::getProfile();
        } catch (MiniPNGException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid MiniPNG API key or service unavailable',
                'error' => $e->getMessage(),
            ], 401);
        }

        return $next($request);
    }
} 