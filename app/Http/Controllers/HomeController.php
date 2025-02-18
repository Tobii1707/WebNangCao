<?php

namespace App\Http\Controllers; // Khai báo namespace để định danh vị trí của Controller trong project Laravel

use Illuminate\Http\Request; // Import Request để xử lý yêu cầu HTTP
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import AuthorizesRequests để hỗ trợ phân quyền
use Illuminate\Foundation\Validation\ValidatesRequests; // Import ValidatesRequests để hỗ trợ kiểm tra dữ liệu đầu vào
use Illuminate\Foundation\Bus\DispatchesJobs; // Import DispatchesJobs để hỗ trợ xử lý hàng đợi
use Illuminate\Routing\Controller as BaseController; // Import BaseController để kế thừa tính năng định tuyến

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests; // Sử dụng các trait hỗ trợ phân quyền, xử lý hàng đợi và xác thực dữ liệu

    /**
     * Tạo một instance mới của controller.
     *
     * @return void
     */
    public function __construct()
    {
        // Sử dụng middleware để yêu cầu xác thực trước khi truy cập controller này
        $this->middleware('auth');
    }

    /**
     * Hiển thị trang dashboard của ứng dụng.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home'); // Trả về view 'home' khi truy cập trang chủ
    }
}
