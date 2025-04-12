<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('customers')->insert([
            'ho_ten' => 'Chu Quang Tung',
            'email' => 'tchu280305@gmail.com',
            'so_dien_thoai' => '0862837030',
            'dia_chi' => 'Hà Nội',
        ]);
        DB::table('customers')->insert([
            'ho_ten' => 'Chu Quang Tung 1',
            'email' => 'tchu@gmail.com',
            'so_dien_thoai' => '0862837031',
            'dia_chi' => 'Hà Nội',
        ]);
    }
}
