<?php

namespace App\Http\Controllers\Auth; // Khai báo namespace để định danh vị trí của Controller trong project Laravel

use App\Http\Controllers\Controller; // Import Controller cơ sở của Laravel
use Illuminate\Routing\Controller as BaseController; // Import BaseController để kế thừa tính năng định tuyến
use App\Models\User; // Import model User để tạo người dùng mới
use Illuminate\Foundation\Auth\RegistersUsers; // Import trait hỗ trợ đăng ký người dùng
use Illuminate\Support\Facades\Hash; // Import Hash để mã hóa mật khẩu
use Illuminate\Support\Facades\Validator; // Import Validator để kiểm tra dữ liệu đầu vào

class RegisterController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Controller này chịu trách nhiệm xử lý đăng ký người dùng mới,
    | bao gồm xác thực và tạo tài khoản. Sử dụng trait để hỗ trợ
    | tính năng này mà không cần thêm nhiều mã nguồn.
    |
    */

    use RegistersUsers; // Sử dụng trait RegistersUsers để kế thừa chức năng đăng ký

    /**
     * Nơi sẽ chuyển hướng người dùng sau khi đăng ký thành công.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Sau khi đăng ký thành công, chuyển hướng đến '/home'

    /**
     * Tạo một instance mới của controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); // Chỉ cho phép khách truy cập vào trang đăng ký
    }

    /**
     * Xác thực dữ liệu đầu vào của yêu cầu đăng ký.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Tạo một instance người dùng mới sau khi xác thực thành công.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Mã hóa mật khẩu trước khi lưu
        ]);
    }
}