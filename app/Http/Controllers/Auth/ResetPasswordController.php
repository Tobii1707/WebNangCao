<?php

namespace App\Http\Controllers\Auth; // Khai báo namespace để định danh vị trí của Controller trong project Laravel

use App\Http\Controllers\Controller; // Import Controller cơ sở của Laravel
use Illuminate\Foundation\Auth\ResetsPasswords; // Import trait để hỗ trợ đặt lại mật khẩu

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Controller này chịu trách nhiệm xử lý yêu cầu đặt lại mật khẩu
    | và sử dụng trait để kế thừa hành vi đặt lại mật khẩu mặc định.
    | Bạn có thể tùy chỉnh các phương thức theo nhu cầu.
    |
    */

    use ResetsPasswords; // Sử dụng trait ResetsPasswords để hỗ trợ đặt lại mật khẩu

    /**
     * Nơi sẽ chuyển hướng người dùng sau khi đặt lại mật khẩu thành công.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Sau khi đặt lại mật khẩu thành công, chuyển hướng đến '/home'
}