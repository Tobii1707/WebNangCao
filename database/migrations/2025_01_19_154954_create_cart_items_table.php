<?php

use Illuminate\Database\Migrations\Migration; // Sử dụng Migration để thực hiện các thay đổi đối với cơ sở dữ liệu
use Illuminate\Database\Schema\Blueprint; // Sử dụng Blueprint để định nghĩa cấu trúc bảng
use Illuminate\Support\Facades\Schema; // Sử dụng Schema để thao tác với cơ sở dữ liệu

return new class extends Migration // Định nghĩa một lớp Migration không tên, kế thừa từ lớp Migration
{
    /**
     * Run the migrations.
     */
    public function up() // Phương thức up sẽ chạy khi thực hiện migration để tạo bảng 'cart_items'
    {
        Schema::create('cart_items', function (Blueprint $table) { // Tạo bảng 'cart_items' để lưu trữ các mục trong giỏ hàng
            $table->id(); // Cột 'id' tự động tăng, là khóa chính cho bảng 'cart_items'
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Cột 'user_id' là khóa ngoại tham chiếu đến bảng 'users', xóa dữ liệu trong bảng 'cart_items' khi xóa người dùng
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Cột 'product_id' là khóa ngoại tham chiếu đến bảng 'products', xóa dữ liệu trong bảng 'cart_items' khi xóa sản phẩm
            $table->integer('quantity')->default(1); // Cột 'quantity' lưu trữ số lượng sản phẩm trong giỏ hàng, mặc định là 1
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at' để lưu trữ thời gian tạo và cập nhật
        });
    }

};
