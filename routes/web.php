<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'show'])->name('home');

Route::get('/search', [SearchController::class, 'show'])->name('search.show');
Route::post('/search', [SearchController::class, 'search'])->name('search.search');

Route::get('/movie', [HomeController::class, 'redirect']);
Route::get('/show', [HomeController::class, 'redirect']);
Route::get('/movie/{id}', [InfoController::class, 'showMV'])->name('mv.info');
Route::get('/show/{id}', [InfoController::class, 'showTV'])->name('tv.info');

Route::get('/sadcat', function() {
    return redirect('https://sadcat.space');
})->name('sadcat.space');

Route::middleware('auth')->group(function () {
    Route::get('/watchlist', [WatchlistController::class, 'show'])->name('watchlist.show');
    Route::post('/watchlist/add', [WatchlistController::class, 'add'])->name('watchlist.add');
    Route::post('/watchlist/remove', [WatchlistController::class, 'remove'])->name('watchlist.remove');

    Route::get('/history', [HistoryController::class, 'show'])->name('history.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';