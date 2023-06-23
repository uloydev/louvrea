<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

// public routes
Route::get('/', function () {
    return view('index', [
        'products' => Product::inRandomOrder()->take(9)->get(),
    ]);
})->name('index');
Route::get('/product', [ProductController::class, 'index'])->name('product-list');
Route::get('/product/{product}', [ProductController::class, 'detail'])->name('product.detail');

Route::middleware(['role:user'])->group(function () {
    Route::controller(CartController::class)->name('cart.')->prefix('cart')->group(function () {
        Route::post('/add','store')->name('add');
        Route::get('/','index')->name('index');
    });
});

require __DIR__.'/auth.php';
