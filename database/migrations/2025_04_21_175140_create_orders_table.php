<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ma_khach_hang')->nullable();
            $table->string('ho_ten');
            $table->string('email')->nullable();
            $table->string('so_dien_thoai');
            $table->string('dia_chi');
            $table->decimal('tong_tien', 15, 2);
            $table->string('phuong_thuc_thanh_toan');
            $table->string('trang_thai')->default('chờ xác nhận');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
