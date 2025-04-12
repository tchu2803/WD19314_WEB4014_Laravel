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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ma_san_pham')->nullable();
            $table->bigInteger('ma_khach_hang')->nullable();
            $table->text('danh_gia');
            $table->integer('so_sao');
            $table->timestamps();

            $table->foreign('ma_san_pham')->references('id')->on('products')->onDelete('cascade');

            $table->foreign('ma_khach_hang')->references('id')->on('customers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
