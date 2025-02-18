<?php

namespace App\Models; // Định nghĩa namespace cho lớp User, giúp tổ chức các lớp trong dự án

use Illuminate\Database\Eloquent\Factories\HasFactory; // Sử dụng trait HasFactory để có thể tạo các bản ghi mẫu (factories) khi cần thiết
use Illuminate\Foundation\Auth\User as Authenticatable; // Kế thừa từ lớp Authenticatable để có thể sử dụng các tính năng xác thực người dùng của Laravel
use Illuminate\Notifications\Notifiable; // Sử dụng trait Notifiable để hỗ trợ tính năng thông báo (notifications)

class User extends Authenticatable // Định nghĩa lớp User kế thừa từ lớp Authenticatable, đại diện cho bảng users trong cơ sở dữ liệu
{
    use HasFactory, Notifiable; // Sử dụng trait HasFactory để tạo các bản ghi mẫu (factories) và Notifiable để xử lý các thông báo

    protected $fillable = [
        'name', // Các trường có thể điền dữ liệu hàng loạt (mass assignable)
        'email', 
        'password',
    ];

    protected $hidden = [
        'password', // Các trường ẩn đi khi trả về dữ liệu, để bảo vệ thông tin nhạy cảm
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Chuyển đổi cột email_verified_at thành kiểu dữ liệu datetime
    ];

    public function cartItems() // Quan hệ với các mục trong giỏ hàng
    {
        return $this->hasMany(CartItem::class); // Khai báo mối quan hệ "một" với nhiều CartItem
    }
}
