<?php

use App\Http\Controllers\YouTubeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('youtube', [YouTubeController::class, 'index']);
Route::post('youtube/download', [YouTubeController::class, 'download']);
Route::get('youtube/stream', [YouTubeController::class, 'stream']);
