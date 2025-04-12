<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('contacts')->insert([
            'ho_ten' => 'Chu Quang Tung',
            'email' => 'tchu280305@gmail.com',
            'so_dien_thoai' => '0862837030',
            'tin_nhan' => 'Tôi là tùng',
        ]);
        DB::table('contacts')->insert([
            'ho_ten' => 'Chu Quang Tung',
            'email' => 'tchu2803051@gmail.com',
            'so_dien_thoai' => '0862837030',
            'tin_nhan' => 'Tôi là tùng 1',
        ]);
    }
}
