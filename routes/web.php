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
        'products' => Product::inRandomOrder()->take(6)->get(),
    ]);
})->name('index');
Route::view('/about-us', 'about-us')->name('about-us');
Route::view('/reseller-info', 'reseller-info')->name('reseller-info');
Route::view('/how-to-order', 'how-to-order')->name('how-to-order');
Route::view('/disclaimer', 'disclaimer')->name('disclaimer');
Route::get('/product', [ProductController::class, 'index'])->name('product-list');
Route::get('/product/{product}', [ProductController::class, 'detail'])->name('product.detail');

// user routes
Route::middleware(['role:user'])->group(function () {
    Route::controller(CartController::class)->name('cart.')->prefix('cart')->group(function () {
        Route::post('/add','store')->name('add');
        Route::delete('/{cart}','delete')->name('delete');
        Route::post('/{cart}','update')->name('modify');
        Route::get('/','index')->name('index');
    });
});

Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);

// admin/superadmin routes

require __DIR__.'/auth.php';
