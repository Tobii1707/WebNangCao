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
        Schema::create('users', function (Blueprint $table) { // Tạo bảng 'users' với các cột và kiểu dữ liệu cần thiết
            $table->id(); // Cột id tự động tăng, là khóa chính
            $table->string('name'); // Cột 'name' là kiểu chuỗi
            $table->string('email')->unique(); // Cột 'email' là kiểu chuỗi và đảm bảo giá trị là duy nhất
            $table->timestamp('email_verified_at')->nullable(); // Cột 'email_verified_at' kiểu timestamp, có thể là null
            $table->string('password'); // Cột 'password' kiểu chuỗi
            $table->rememberToken(); // Cột cho mã token dùng khi người dùng chọn "remember me"
            $table->timestamps(); // Tạo các cột 'created_at' và 'updated_at'
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) { // Tạo bảng 'password_reset_tokens' để lưu trữ token reset mật khẩu
            $table->string('email')->primary(); // Cột 'email' là khóa chính
            $table->string('token'); // Cột 'token' chứa mã token cho reset mật khẩu
            $table->timestamp('created_at')->nullable(); // Cột 'created_at' để ghi lại thời gian tạo token, có thể null
        });

        Schema::create('sessions', function (Blueprint $table) { // Tạo bảng 'sessions' để lưu trữ thông tin phiên làm việc
            $table->string('id')->primary(); // Cột 'id' là khóa chính cho phiên làm việc
            $table->foreignId('user_id')->nullable()->index(); // Cột 'user_id' lưu trữ ID người dùng, có thể null và tạo chỉ mục
            $table->string('ip_address', 45)->nullable(); // Cột 'ip_address' lưu trữ địa chỉ IP, có thể null
            $table->text('user_agent')->nullable(); // Cột 'user_agent' lưu trữ thông tin về trình duyệt, có thể null
            $table->longText('payload'); // Cột 'payload' lưu trữ dữ liệu phiên làm việc
            $table->integer('last_activity')->index(); // Cột 'last_activity' lưu trữ thời gian hoạt động cuối cùng của phiên, tạo chỉ mục
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Phương thức down sẽ chạy khi thực hiện rollback để xóa các bảng
    {
        Schema::dropIfExists('users'); // Xóa bảng 'users'
        Schema::dropIfExists('password_reset_tokens'); // Xóa bảng 'password_reset_tokens'
        Schema::dropIfExists('sessions'); // Xóa bảng 'sessions'
    }
};
