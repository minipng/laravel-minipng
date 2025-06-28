<?php

namespace App\Http\Controllers;

use MiniPNG\LaravelMiniPNG\Facades\MiniPNG;
use MiniPNG\LaravelMiniPNG\Exceptions\MiniPNGException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    /**
     * Compress an image
     */
    public function compress(Request $request): JsonResponse
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

    /**
     * Convert image format
     */
    public function convert(Request $request): JsonResponse
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

    /**
     * Compress PDF
     */
    public function compressPdf(Request $request): JsonResponse
    {
        $request->validate([
            'pdf_url' => 'required|url',
        ]);

        try {
            $result = MiniPNG::compressPdf($request->input('pdf_url'));
            
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

    /**
     * Convert PDF to images
     */
    public function pdfToImages(Request $request): JsonResponse
    {
        $request->validate([
            'pdf_url' => 'required|url',
            'quality' => 'nullable|in:low,medium,high',
            'format' => 'nullable|in:png,jpg',
        ]);

        try {
            $result = MiniPNG::convertPdfToImages(
                $request->input('pdf_url'),
                $request->input('quality'),
                $request->input('format')
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

    /**
     * Get user profile
     */
    public function profile(): JsonResponse
    {
        try {
            $profile = MiniPNG::getProfile();
            
            return response()->json([
                'success' => true,
                'data' => $profile,
            ]);
        } catch (MiniPNGException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
} 