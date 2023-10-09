<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/promotion', [ProductController::class, 'discountList'])->name('product.discountList');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('panier')->as('cart.')->controller(CartController::class)->group(function () {
    Route::post('/store/{id}/{count}', 'store')->name('store');
    Route::get('/', 'show')->name('show');
});

require __DIR__.'/auth.php';

// COMMENTS ROUTES
Route::prefix('comment')->as('comment.')->middleware(['auth'])->controller(CommentController::class)->group(function () {
    Route::post('/store/{cat}/{id}', 'store')->name('store');
    Route::delete('/delete/{cat}/{id}', 'delete')->name('delete');
    Route::put('/edit/{cat}/{id}', 'edit')->name('edit');
});

Route::get('/{cat}', [ProductController::class, 'list'])->name('product.list');
Route::post('/{cat}', [ProductController::class, 'filter'])->name('product.filter');
Route::get('/{cat}/{id}', [ProductController::class, 'show'])->name('product.show');
