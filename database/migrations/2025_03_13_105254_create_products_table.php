<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Mặc định trong 1 file migration bắt buộc phải có đủ hàm up và hàm down
    // Hmà up dùng để cập nhật cơ sở dữ liệu
    // Hàm down dlà những công việc ngược lại của hàm up
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            // Quy định độ dài của ma_san_pham là 20 ký tự và không được trùng lặp với nhau
            $table->string('ma_san_pham', 20)->unique();
            $table->string('ten_san_pham');
            $table->decimal('gia', 10, 2);
            // nullable cho phép chứa giá trị null
            $table->decimal('gia_khuyen_mai', 10, 2)->nullable();
            // Số nguyên dương
            $table->unsignedInteger('so_luong');
            $table->date('ngay_nhap');
            $table->text('mo_ta')->nullable();
            // Mặc định là true
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
