<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reviews')->insert([
            'ma_san_pham' => 1,
            'ma_khach_hang' => 1,
            'danh_gia' => 'Tốt',
            'so_sao' => 5,
        ]);
        // DB::table('reviews')->insert([
        //     'ma_san_pham' => 2,
        //     'ma_khach_hang' => 2,
        //     'danh_gia' => 'Tốt',
        //     'so_sao' => 5,
        // ]);
    }
}
