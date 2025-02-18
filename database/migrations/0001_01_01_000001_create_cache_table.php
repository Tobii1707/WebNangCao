<?php

use Illuminate\Database\Migrations\Migration; // Sử dụng Migration để thực hiện các thay đổi đối với cơ sở dữ liệu
use Illuminate\Database\Schema\Blueprint; // Sử dụng Blueprint để định nghĩa cấu trúc bảng
use Illuminate\Support\Facades\Schema; // Sử dụng Schema để thao tác với cơ sở dữ liệu

return new class extends Migration // Định nghĩa một lớp Migration không tên, kế thừa từ lớp Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // Phương thức up sẽ chạy khi thực hiện migration để tạo các bảng trong cơ sở dữ liệu
    {
        Schema::create('cache', function (Blueprint $table) { // Tạo bảng 'cache' để lưu trữ các dữ liệu cache
            $table->string('key')->primary(); // Cột 'key' là khóa chính của bảng, đại diện cho khóa cache
            $table->mediumText('value'); // Cột 'value' lưu trữ giá trị cache (dạng text có thể lưu trữ dữ liệu lớn)
            $table->integer('expiration'); // Cột 'expiration' lưu trữ thời gian hết hạn của cache, kiểu dữ liệu integer (timestamp hoặc giây)
        });

        Schema::create('cache_locks', function (Blueprint $table) { // Tạo bảng 'cache_locks' để lưu trữ thông tin khóa cache
            $table->string('key')->primary(); // Cột 'key' là khóa chính, đại diện cho khóa cache đang bị khóa
            $table->string('owner'); // Cột 'owner' lưu trữ thông tin về người sở hữu (hoặc tiến trình) đang giữ khóa
            $table->integer('expiration'); // Cột 'expiration' lưu trữ thời gian khóa hết hạn, kiểu dữ liệu integer (timestamp hoặc giây)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Phương thức down sẽ chạy khi thực hiện rollback để xóa các bảng
    {
        Schema::dropIfExists('cache'); // Xóa bảng 'cache'
        Schema::dropIfExists('cache_locks'); // Xóa bảng 'cache_locks'
    }
};
