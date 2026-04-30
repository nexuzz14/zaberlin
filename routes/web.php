<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VideoController::class, 'index'])->name('home');
Route::get('/video/{video}', [VideoController::class, 'show'])->name('video.show');
Route::get('/upload', [VideoController::class, 'upload'])->name('video.upload');
Route::post('/upload', [VideoController::class, 'store'])->name('video.store');
Route::get('/filter', [VideoController::class, 'filterByCategory'])->name('video.filter');
