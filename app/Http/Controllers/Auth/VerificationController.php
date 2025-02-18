<?php

namespace App\Http\Controllers\Auth; // Khai báo namespace để định danh vị trí của Controller trong project Laravel

use App\Http\Controllers\Controller; // Import Controller cơ sở của Laravel
use Illuminate\Foundation\Auth\VerifiesEmails; // Import trait để hỗ trợ xác minh email
use Illuminate\Routing\Controller as BaseController; // Import BaseController để kế thừa tính năng định tuyến
use Illuminate\Foundation\Bus\DispatchesJobs; // Import DispatchesJobs để hỗ trợ xử lý hàng đợi
use Illuminate\Foundation\Validation\ValidatesRequests; // Import ValidatesRequests để hỗ trợ kiểm tra dữ liệu đầu vào

class VerificationController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | Controller này chịu trách nhiệm xử lý xác minh email cho bất kỳ
    | người dùng nào vừa đăng ký. Hệ thống sẽ gửi email xác minh
    | và người dùng cần nhấp vào liên kết để kích hoạt tài khoản.
    |
    */

    use VerifiesEmails; // Sử dụng trait VerifiesEmails để kế thừa chức năng xác minh email

    /**
     * Nơi sẽ chuyển hướng người dùng sau khi xác minh email thành công.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Sau khi xác minh email thành công, chuyển hướng đến '/home'

    /**
     * Tạo một instance mới của controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); // Yêu cầu người dùng phải đăng nhập
        $this->middleware('signed')->only('verify'); // Yêu cầu chữ ký hợp lệ trên URL khi xác minh
        $this->middleware('throttle:6,1')->only('verify', 'resend'); // Giới hạn số lần xác minh lại email (6 lần/phút)
    }
}
