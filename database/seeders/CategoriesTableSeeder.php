<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            'ten_danh_muc' => 'Danh mục 1',
            'trang_thai' => 1,  // 1 = Active, 0 = Inactive (depending on your logic)
        ]);
        DB::table('categories')->insert([
            'ten_danh_muc' => 'Danh mục 2',
            'trang_thai' => 1,  // 1 = Active, 0 = Inactive
        ]);
        DB::table('categories')->insert([
            'ten_danh_muc' => 'Danh mục 3',
            'trang_thai' => 0,  // 0 = Inactive
        ]);
    }
}
