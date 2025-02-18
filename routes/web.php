<?php

use App\Http\Controllers\AuthController; // Sử dụng controller AuthController để xử lý đăng ký, đăng nhập và đăng xuất
use App\Http\Controllers\ProductController; // Sử dụng controller ProductController để quản lý sản phẩm
use App\Http\Controllers\CartController; // Sử dụng controller CartController để xử lý các chức năng giỏ hàng
use Illuminate\Support\Facades\Auth; // Sử dụng facade Auth để xử lý xác thực người dùng
use Illuminate\Support\Facades\Route; // Sử dụng facade Route để định nghĩa các route của ứng dụng

// Route đăng ký và đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Hiển thị trang đăng nhập
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); // Xử lý đăng nhập người dùng
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register'); // Hiển thị trang đăng ký
Route::post('/register', [AuthController::class, 'register'])->name('register.post'); // Xử lý đăng ký người dùng

// Route đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // Xử lý đăng xuất người dùng

// Đặt trang login là trang mặc định
Route::get('/', function () {
    return redirect()->route('login'); // Điều hướng người dùng đến trang login khi vào trang chủ
});

// Bảo vệ các route yêu cầu đăng nhập
Route::middleware(['auth'])->group(function () { // Tất cả route trong nhóm này yêu cầu người dùng phải đăng nhập
    // Route sản phẩm
    Route::get('/home', [ProductController::class, 'index'])->name('products.index'); // Hiển thị danh sách sản phẩm
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Hiển thị trang tạo sản phẩm
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Xử lý thêm sản phẩm mới
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Hiển thị trang sửa sản phẩm
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Xử lý cập nhật sản phẩm
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Xử lý xóa sản phẩm

    // Route giỏ hàng
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Hiển thị giỏ hàng
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add'); // Thêm sản phẩm vào giỏ hàng
    Route::delete('/cart/{productId}/remove', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sản phẩm khỏi giỏ hàng
});

// Các route liên quan đến giỏ hàng
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sản phẩm khỏi giỏ hàng
Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update'); // Cập nhật số lượng sản phẩm trong giỏ hàng
