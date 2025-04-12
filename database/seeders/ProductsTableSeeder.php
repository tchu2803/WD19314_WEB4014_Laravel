<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            'ma_san_pham' => 'Chu Quang Tung',
            'ten_san_pham' => 'Tùng',
            'gia' => 1000,
            'ngay_nhap' => '2021-10-10',
            'gia_khuyen_mai' => 500,
            'so_luong' => 10,
            'mo_ta' => 'Tôi là Tùng',
            'trang_thai' => 1,
        ]);
        DB::table('products')->insert([
            'ma_san_pham' => 'Chu Quang Tung 2',
            'ten_san_pham' => 'Tùng 1',
            'gia' => 800,
            'ngay_nhap' => '2021-10-10',
            'gia_khuyen_mai' => 400,
            'so_luong' => 12,
            'mo_ta' => 'Tôi là Tùng 2',
            'trang_thai' => 1,
        ]);
    }
}
