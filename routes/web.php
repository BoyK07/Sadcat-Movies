<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/search', [SearchController::class, 'show'])->name('search.show');
Route::post('/search', [SearchController::class, 'search'])->name('search.search');

Route::get('/movie', [HomeController::class, 'redirect']);
Route::get('/show', [HomeController::class, 'redirect']);
Route::get('/movie/{id}', [InfoController::class, 'showMV'])->name('mv.info');
Route::get('/show/{id}', [InfoController::class, 'showTV'])->name('tv.info');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';