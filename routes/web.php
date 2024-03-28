<?php

use App\Http\Controllers\YouTubeController;
use Illuminate\Support\Facades\Route;

Route::get('youtube', [YouTubeController::class, 'index']);
Route::post('youtube/download', [YouTubeController::class, 'download']);
Route::get('youtube/stream', [YouTubeController::class, 'stream']);
