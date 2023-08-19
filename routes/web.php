<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\RegionController;
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
// landing page
Route::get('/', function () {
    return view('index', [
        'products' => Product::with('ratings')->inRandomOrder()->take(6)->get(),
    ]);
})->name('index');
// about us page
Route::view('/about-us', 'about-us')->name('about-us');
// reseller info
Route::get('/reseller-info', [ResellerController::class, 'info'])->name('reseller-info');
// how to order page
Route::view('/how-to-order', 'how-to-order')->name('how-to-order');
// disclaimer page
Route::view('/disclaimer', 'disclaimer')->name('disclaimer');
// product list page
Route::get('/product', [ProductController::class, 'index'])->name('product-list');
// product detail page
Route::get('/product/{product}', [ProductController::class, 'detail'])->name('product.detail');

// user routes
Route::middleware(['role:user','verified'])->group(function () {
    // cart related routes
    Route::controller(CartController::class)->name('cart.')->prefix('cart')->group(function () {
        // add to cart
        Route::post('/add','store')->name('add');
        // remove from cart
        Route::delete('/{cart}','delete')->name('delete');
        // update cart (add/sub)
        Route::post('/{cart}','update')->name('modify');
        // cart page
        Route::get('/','index')->name('index');
        // checkout page
        Route::get('/checkout', 'checkoutSummary')->name('checkout-summary');
    });

    // order related routes
    Route::controller(OrderController::class)->name('order.')->prefix('order')->group(function () {
        // submit order
        Route::post('/','store')->name('create');
        // my order page
        Route::get('/','myOrder')->name('my-order');
        // cancel / delete order
        Route::delete('/{order}','destroy')->name('my-order.delete');
        Route::post('/myOrder/rating/{item}','submitRating')->name('my-order.rating');
    });

    // user profile page
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
});

// admin or superadmin routes
Route::middleware(['role:admin|superadmin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // dashboard page
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    // product category management page
    Route::get('/product-category', [ProductCategoryController::class, 'index'])->name('product-category');
    // product management page
    Route::get('/product', [ProductController::class, 'adminIndex'])->name('product');
    // admin management page
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    // user management page
    Route::get('/user', [UserController::class, 'index'])->name('user');
    // reseller management page
    Route::get('/reseller', [ResellerController::class, 'index'])->name('reseller');
    // order management page
    Route::get('/order', [OrderController::class, 'index'])->name('order');
});

// superadmin only routes
Route::middleware(['role:superadmin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // product category related routes
    Route::controller(ProductCategoryController::class)->name('product-category.')->prefix('product-category')->group(function () {
        // add product category
        Route::post('/', 'store')->name('create');
        // update product category
        Route::put('/{productCategory}', 'update')->name('update');
        // delete product category
        Route::delete('/{productCategory}', 'destroy')->name('delete');
    });

    // product related routes
    Route::controller(ProductController::class)->name('product.')->prefix('product')->group(function () {
        // add product
        Route::post('/', 'store')->name('create');
        // update product
        Route::put('/{product}', 'update')->name('update');
        // delete product
        Route::delete('/{product}', 'destroy')->name('delete');
    });

    // admin related routes
    Route::controller(AdminController::class)->name('admin.')->prefix('admin')->group(function () {
        // add admin
        Route::post('/', 'store')->name('create');
        // update admin
        Route::put('/{admin}', 'update')->name('update');
        // delete admin
        Route::delete('/{admin}', 'destroy')->name('delete');
    });

    // user related routes
    Route::controller(UserController::class)->name('user.')->prefix('user')->group(function () {
        // update user
        Route::put('/{user}', 'update')->name('update');
        // delete user
        Route::delete('/{user}', 'destroy')->name('delete');
    });

    // reseller related routes
    Route::controller(ResellerController::class)->name('reseller.')->prefix('reseller')->group(function () {
        // add reseller
        Route::post('/', 'store')->name('create');
        // update reseller
        Route::put('/{reseller}', 'update')->name('update');
        // delete reseller
        Route::delete('/{reseller}', 'destroy')->name('delete');
    });

    // order related routes
    Route::controller(OrderController::class)->name('order.')->prefix('order')->group(function () {
        // update order
        Route::put('/{order}', 'update')->name('update');
    });
});

// midtrans callback payemnt notification route
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);

// region api routes
Route::controller(RegionController::class)->name('region.')->prefix('region')->group(function () {
    Route::get('province', 'provinces')->name('province');
    Route::get('regency/jabodetabek', 'jabodetabekRegency')->name('jabodetabekRegency');
    Route::get('regency/{id}', 'regencyByProvince')->name('regencyByProvince');
    Route::get('district/{id}', 'districtByRegency')->name('districtByRegency');
});

// auth routes
require __DIR__.'/auth.php';
