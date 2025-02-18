<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Route đăng ký và đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Đặt trang login là trang mặc định
Route::get('/', function () {
    return redirect()->route('login');
});

// Bảo vệ các route yêu cầu đăng nhập
Route::middleware(['auth'])->group(function () {
    // Route sản phẩm
    Route::get('/home', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Route giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');// Cập nhật số lượng sản phẩm
    Route::delete('/cart/{productId}/remove', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sản phẩm
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear'); // Xóa toàn bộ giỏ hàng
});
