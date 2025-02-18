<?php

namespace App\Models; // Định nghĩa namespace cho lớp CartItem, giúp tổ chức các lớp trong dự án

use Illuminate\Database\Eloquent\Factories\HasFactory; // Sử dụng trait HasFactory để Laravel có thể tạo các bản ghi mẫu (factories) khi cần thiết
use Illuminate\Database\Eloquent\Model; // Kế thừa từ lớp Model để sử dụng các tính năng Eloquent ORM của Laravel

class CartItem extends Model // Định nghĩa lớp CartItem kế thừa từ lớp Model, đại diện cho bảng cart_items trong cơ sở dữ liệu
{
    use HasFactory; // Sử dụng trait HasFactory để có thể tạo các bản ghi mẫu (factories) khi cần thiết

    protected $fillable = ['user_id', 'product_id', 'quantity']; // Xác định các trường có thể điền dữ liệu hàng loạt (mass assignable)

    // Quan hệ với model Product (Lớp CartItem có một mối quan hệ "nhiều" với Product)
    public function product()
    {
        return $this->belongsTo(Product::class); // Khai báo mối quan hệ "nhiều" với model Product
    }

    // Quan hệ với model User (Lớp CartItem có một mối quan hệ "nhiều" với User)
    public function user()
    {
        return $this->belongsTo(User::class); // Khai báo mối quan hệ "nhiều" với model User
    }
}
