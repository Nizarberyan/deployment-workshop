<?php

use App\Http\Controllers\GeminiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('gemini.home');
});

// Make Gemini routes accessible without authentication for now
Route::get('/gemini', [GeminiController::class, 'index'])->name('gemini.conversation');
Route::post('/gemini/chat', [GeminiController::class, 'chat'])->name('gemini.chat');
Route::post('/gemini/clear', [GeminiController::class, 'clearHistory'])->name('gemini.clear');
Route::get('/gemini/test-api', [GeminiController::class, 'testApi']);

// If you have other authenticated routes, keep them here
// Route::middleware('auth')->group(function () {
//     // other authenticated routes
// });
