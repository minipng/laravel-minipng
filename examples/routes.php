<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| MiniPNG API Routes Example
|--------------------------------------------------------------------------
|
| These routes demonstrate how to use the MiniPNG Laravel package
| for image and PDF processing.
|
*/

Route::prefix('api/minipng')->group(function () {
    
    // Image compression
    Route::post('/compress-image', [ImageController::class, 'compress'])
        ->name('minipng.compress-image');
    
    // Image format conversion
    Route::post('/convert-image', [ImageController::class, 'convert'])
        ->name('minipng.convert-image');
    
    // PDF compression
    Route::post('/compress-pdf', [ImageController::class, 'compressPdf'])
        ->name('minipng.compress-pdf');
    
    // PDF to images conversion
    Route::post('/pdf-to-images', [ImageController::class, 'pdfToImages'])
        ->name('minipng.pdf-to-images');
    
    // Get user profile
    Route::get('/profile', [ImageController::class, 'profile'])
        ->name('minipng.profile');
});

/*
|--------------------------------------------------------------------------
| Web Routes Example (for testing)
|--------------------------------------------------------------------------
|
| These routes provide a simple web interface for testing the API
|
*/

Route::get('/minipng/test', function () {
    return view('minipng.test');
})->name('minipng.test');

Route::get('/minipng/docs', function () {
    return view('minipng.docs');
})->name('minipng.docs'); 