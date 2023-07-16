<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\ProductCategory;

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
        Route::get('/checkout', 'checkoutSummary')->name('checkout-summary');
    });

    Route::controller(OrderController::class)->name('order.')->prefix('order')->group(function () {
        Route::post('/','store')->name('create');
        Route::get('/','myOrder')->name('my-order');
    });
});

// admin or superadmin routes
Route::middleware(['role:admin|superadmin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/product-category', [ProductCategoryController::class, 'index'])->name('product-category');
    Route::get('/product', [ProductController::class, 'adminIndex'])->name('product');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/user', [UserController::class, 'index'])->name('user');
});

// superadmin only routes
Route::middleware(['role:superadmin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::controller(ProductCategoryController::class)->name('product-category.')->prefix('product-category')->group(function () {
        Route::post('/', 'store')->name('create');
        Route::put('/{productCategory}', 'update')->name('update');
        Route::delete('/{productCategory}', 'destroy')->name('delete');
    });

    Route::controller(ProductController::class)->name('product.')->prefix('product')->group(function () {
        Route::post('/', 'store')->name('create');
        Route::put('/{product}', 'update')->name('update');
        Route::delete('/{product}', 'destroy')->name('delete');
    });

    Route::controller(AdminController::class)->name('admin.')->prefix('admin')->group(function () {
        Route::post('/', 'store')->name('create');
        Route::put('/{admin}', 'update')->name('update');
        Route::delete('/{admin}', 'destroy')->name('delete');
    });

    Route::controller(UserController::class)->name('user.')->prefix('user')->group(function () {
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('delete');
    });
});

Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);

// admin/superadmin routes

require __DIR__.'/auth.php';
