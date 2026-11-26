<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rute Halaman Publik EllCoffe
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/produk/{id}', [PublicController::class, 'show'])->name('public.detail');

/*
|--------------------------------------------------------------------------
| Rute Panel Admin Produk EllCoffe
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', AdminProductController::class)->except(['show']);
});
