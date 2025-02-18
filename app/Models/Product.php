<?php

namespace App\Models; // Định nghĩa namespace cho lớp Product, giúp tổ chức các lớp trong dự án

use Illuminate\Database\Eloquent\Model; // Kế thừa từ lớp Model để sử dụng các tính năng Eloquent ORM của Laravel

class Product extends Model // Định nghĩa lớp Product kế thừa từ lớp Model, đại diện cho bảng products trong cơ sở dữ liệu
{
    // Quan hệ với các mục trong giỏ hàng (Lớp Product có mối quan hệ "một" với nhiều CartItem)
    public function cartItems()
    {
        return $this->hasMany(CartItem::class); // Khai báo mối quan hệ "một" với nhiều CartItem
    }
}
