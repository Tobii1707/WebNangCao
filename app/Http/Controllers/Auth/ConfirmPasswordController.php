<?php

namespace App\Http\Controllers\Auth; // Khai báo namespace để định danh vị trí của Controller trong project Laravel

use App\Http\Controllers\Controller; // Import Controller cơ sở của Laravel
use Illuminate\Foundation\Auth\ConfirmsPasswords; // Import trait để hỗ trợ xác nhận mật khẩu

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | Controller này chịu trách nhiệm xử lý việc xác nhận lại mật khẩu
    | sử dụng trait để kế thừa hành vi của hệ thống Laravel.
    |
    */

    use ConfirmsPasswords; // Sử dụng trait ConfirmsPasswords để kế thừa chức năng xác nhận mật khẩu

    /**
     * Nơi sẽ chuyển hướng người dùng khi URL dự định thất bại.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Nếu xác nhận mật khẩu thất bại, chuyển hướng về trang '/home'

    /**
     * Tạo một instance mới của controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Đăng ký middleware xác thực để đảm bảo chỉ người dùng đã đăng nhập mới có thể xác nhận mật khẩu
        \Illuminate\Support\Facades\Route::aliasMiddleware('auth', \Illuminate\Auth\Middleware\Authenticate::class);
    }
}