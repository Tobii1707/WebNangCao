<?php

namespace App\Http\Controllers\Auth; // Khai báo namespace để định danh vị trí của Controller trong project Laravel

use Illuminate\Routing\Controller as BaseController; // Import Controller cơ sở của Laravel
use Illuminate\Foundation\Auth\AuthenticatesUsers; // Import trait để hỗ trợ xác thực người dùng

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller này chịu trách nhiệm xác thực người dùng cho ứng dụng và
    | chuyển hướng họ đến trang chính. Controller sử dụng một trait
    | để cung cấp chức năng một cách thuận tiện.
    |
    */

    use AuthenticatesUsers; // Sử dụng trait AuthenticatesUsers để kế thừa chức năng đăng nhập

    /**
     * Nơi sẽ chuyển hướng người dùng sau khi đăng nhập thành công.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Sau khi đăng nhập, người dùng sẽ được chuyển hướng đến trang '/home'

    /**
     * Tạo một instance mới của controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Chỉ cho phép khách truy cập vào các route đăng nhập, ngoại trừ logout yêu cầu xác thực
        $this->middleware('guest')->except('logout'); 
        $this->middleware('auth')->only('logout'); 
    }
}
