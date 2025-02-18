<?php

use Illuminate\Database\Migrations\Migration; // Sử dụng Migration để thực hiện các thay đổi đối với cơ sở dữ liệu
use Illuminate\Database\Schema\Blueprint; // Sử dụng Blueprint để định nghĩa cấu trúc bảng
use Illuminate\Support\Facades\Schema; // Sử dụng Schema để thao tác với cơ sở dữ liệu

return new class extends Migration // Định nghĩa một lớp Migration không tên, kế thừa từ lớp Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // Phương thức up sẽ chạy khi thực hiện migration để tạo bảng trong cơ sở dữ liệu
    {
        Schema::create('products', function (Blueprint $table) { // Tạo bảng 'products' để lưu trữ thông tin sản phẩm
            $table->id(); // Cột 'id' tự động tăng, là khóa chính cho sản phẩm
            $table->string('name'); // Cột 'name' là tên sản phẩm, kiểu chuỗi
            $table->text('description')->nullable(); // Cột 'description' lưu mô tả sản phẩm, có thể để trống
            $table->decimal('price', 10, 2); // Cột 'price' lưu giá sản phẩm, với 10 chữ số và 2 chữ số thập phân
            $table->integer('quantity'); // Cột 'quantity' lưu số lượng sản phẩm, kiểu dữ liệu integer
            $table->timestamps(); // Tạo cột 'created_at' và 'updated_at' để lưu trữ thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Phương thức down sẽ chạy khi thực hiện rollback để xóa bảng
    {
        Schema::dropIfExists('products'); // Xóa bảng 'products' khi rollback migration
    }
};
