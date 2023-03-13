<?php

use App\Http\Controllers\YouTubeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('youtube', [YouTubeController::class, 'index']);
Route::post('youtube/download', [YouTubeController::class, 'download']);
Route::get('youtube/stream', [YouTubeController::class, 'stream']);
