<?php

namespace App\Http\Controllers; // Khai báo namespace để định danh vị trí của Controller trong project Laravel

use Illuminate\Http\Request; // Import Request để xử lý yêu cầu HTTP
use App\Models\User; // Import model User để làm việc với dữ liệu người dùng
use Illuminate\Support\Facades\Hash; // Import Hash để mã hóa mật khẩu
use Illuminate\Support\Facades\Auth; // Import Auth để xử lý xác thực người dùng

class UserController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm (hoặc thông tin người dùng).
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('products.index'); // Trả về trang danh sách sản phẩm hoặc thông tin người dùng
    }

    /**
     * Đăng ký người dùng mới.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo người dùng mới trong database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu trước khi lưu
        ]);

        return redirect()->route('login')->with('success', 'Account registered successfully!'); // Chuyển hướng đến trang đăng nhập
    }

    /**
     * Đăng nhập người dùng.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home')->with('success', 'Logged in successfully!'); // Đăng nhập thành công
        }

        return back()->withErrors(['email' => 'Invalid credentials']); // Đăng nhập thất bại
    }
}