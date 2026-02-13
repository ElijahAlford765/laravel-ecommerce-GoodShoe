<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;


Route::get('/', [ShopController::class,'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class,'show'])->name('shop.show');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class,'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class,'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');


Route::get('/checkout', [CheckoutController::class,'checkoutForm'])->name('checkout'); // Show checkout form
Route::post('/checkout', [CheckoutController::class,'process'])->name('checkout.process'); // Process checkout


Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

