<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/products/low-stock-sp', [ProductController::class, 'lowStockSp'])
        ->name('admin.products.lowStockSp');

});

// AUTH
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showForm'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('guest');
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showForm'])->name('register')->middleware('guest');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->middleware('guest');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// PUBLIC
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

// USER 
Route::middleware('auth')->group(function () {

    // Cart
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    // Cart count (AJAX)
    Route::get('/cart-count', function () {
        return response()->json([
            'count' => \App\Models\Cart::where('user_id', auth()->id())->count()
        ]);
    });

    // Orders
    Route::get('/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order', [\App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// ADMIN (harus login + role admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Products CRUD
    Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');

    // Orders
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/detail', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');

    // Monitor
    Route::get('/monitor', [\App\Http\Controllers\SystemMonitorController::class, 'index'])->name('monitor');
});
// LUPA KATA SANDI
Route::get('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForm'])->name('password.forgot')->middleware('guest');
Route::post('/forgot-password/find', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'find'])->name('password.find')->middleware('guest');
Route::post('/forgot-password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'update'])->name('password.reset.update')->middleware('guest');

// REVIEW PRODUK (harus login)
Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // EXPORT PESANAN
    Route::get('/export/orders/pdf', [\App\Http\Controllers\Admin\ExportImportController::class, 'exportOrdersPdf'])->name('export.orders.pdf');
    Route::get('/export/orders/excel', [\App\Http\Controllers\Admin\ExportImportController::class, 'exportOrdersExcel'])->name('export.orders.excel');

    // EXPORT PRODUK
    Route::get('/export/products/pdf', [\App\Http\Controllers\Admin\ExportImportController::class, 'exportProductsPdf'])->name('export.products.pdf');
    Route::get('/export/products/excel', [\App\Http\Controllers\Admin\ExportImportController::class, 'exportProductsExcel'])->name('export.products.excel');

    // IMPORT PRODUK
    Route::get('/import/products', [\App\Http\Controllers\Admin\ExportImportController::class, 'showImport'])->name('import.products');
    Route::post('/import/products', [\App\Http\Controllers\Admin\ExportImportController::class, 'importProducts'])->name('import.products.store');
    Route::get('/export/template', [\App\Http\Controllers\Admin\ExportImportController::class, 'downloadTemplate'])->name('export.template');
});