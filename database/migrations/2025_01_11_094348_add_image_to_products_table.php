<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_image_to_products_table.php

use Illuminate\Database\Migrations\Migration; // Sử dụng Migration để thực hiện các thay đổi đối với cơ sở dữ liệu
use Illuminate\Database\Schema\Blueprint; // Sử dụng Blueprint để định nghĩa cấu trúc bảng
use Illuminate\Support\Facades\Schema; // Sử dụng Schema để thao tác với cơ sở dữ liệu

class AddImageToProductsTable extends Migration // Định nghĩa lớp migration để thêm cột 'image' vào bảng 'products'
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) { // Thực hiện thay đổi trên bảng 'products'
            $table->string('image')->nullable()->after('quantity'); // Thêm cột 'image', có thể để trống và đặt sau cột 'quantity'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) { // Thực hiện rollback thay đổi nếu cần
            $table->dropColumn('image'); // Xóa cột 'image' nếu rollback migration
        });
    }
}
