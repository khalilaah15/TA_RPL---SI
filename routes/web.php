<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route untuk Produk (CRUD)
    Route::resource('products', App\Http\Controllers\ProductController::class);
    // Route untuk Marketing Kit (CRUD)
    // Route::resource('marketing-kits', App\Http\Controllers\MarketingKitController::class);
    // Marketing Kit (Bisa diakses Admin & Reseller, tapi dibatasi di view)
    Route::resource('marketing-kits', App\Http\Controllers\MarketingKitController::class);
    // Route Belanja Reseller
    Route::middleware('auth')->group(function () {
        Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
        Route::post('/order', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    });
    Route::get('/history', [App\Http\Controllers\OrderController::class, 'history'])->name('order.history');
    Route::get('/invoice/{transaction}', [App\Http\Controllers\OrderController::class, 'invoice'])->name('order.invoice');
    // Route Khusus Admin: Kelola Pesanan
    // (Tambahkan middleware 'admin' jika kamu sudah punya, kalau belum biarkan 'auth' saja dulu)
    Route::get('/admin/orders', [App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/admin/orders/{transaction}', [App\Http\Controllers\AdminOrderController::class, 'update'])->name('admin.orders.update');
    // Route Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('carts.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('carts.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');
    // Route Pesanan Diterima (oleh Reseller)
    Route::put('/order/{transaction}/complete', [OrderController::class, 'markAsCompleted'])->name('order.complete');
    Route::get('/admin/report', [ReportController::class, 'index'])->name('admin.report');
    Route::get('/admin/resellers', [App\Http\Controllers\AdminResellerController::class, 'index'])->name('admin.resellers.index');
    // Di dalam group admin/auth
    Route::get('/admin/resellers', [App\Http\Controllers\AdminResellerController::class, 'index'])->name('admin.resellers.index');

    // TAMBAHKAN INI (Route untuk Detail)
    Route::get('/admin/resellers/{user}', [App\Http\Controllers\AdminResellerController::class, 'show'])->name('admin.resellers.show');
    // TESTIMONI RESELLER
    Route::middleware('role:reseller')->group(function () {
        Route::get('/testimonials/create', [App\Http\Controllers\TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/testimonials', [App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
    });

    // TESTIMONI ADMIN (LIHAT DATA)
    // (Pastikan ini masuk area admin, atau middleware admin kalau sudah dipisah)
    Route::get('/admin/testimonials', [App\Http\Controllers\TestimonialController::class, 'index'])->name('admin.testimonials.index');
    // Route Khusus Admin
    Route::get('/admin/orders', [App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders.index');

    // TAMBAHKAN BARIS INI:
    Route::get('/admin/orders/{transaction}', [App\Http\Controllers\AdminOrderController::class, 'show'])->name('admin.orders.show');

    Route::put('/admin/orders/{transaction}', [App\Http\Controllers\AdminOrderController::class, 'update'])->name('admin.orders.update');
    Route::get('/order/{id}/detail', [App\Http\Controllers\OrderController::class, 'getOrderDetail'])->name('order.detail.ajax');
});

require __DIR__ . '/auth.php';
