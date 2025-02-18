<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Đăng ký
    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Đăng nhập ngay sau khi đăng ký thành công
        Auth::login($user);

        // Chuyển hướng về trang mua sắm
        return redirect()->route('products.index')->with('success', 'Đăng ký và đăng nhập thành công!');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Đăng nhập
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Xử lý đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Nếu đăng nhập thành công
            return redirect()->route('products.index')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu thông tin không đúng
        return back()->withErrors(['email' => 'Thông tin đăng nhập không đúng'])->withInput();
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        // Chuyển hướng về trang sản phẩm sau khi đăng xuất
        return redirect()->route('products.index')->with('success', 'Đã đăng xuất!');
    }
}
