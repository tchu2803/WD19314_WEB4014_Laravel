<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('posts')->insert([
            'tieu_de' => 'Chu Quang Tung',
            'noi_dung' => '
            Tôi là Tùng',
        ]);
        DB::table('posts')->insert([
            'tieu_de' => 'Chu Quang Tung 1',
            'noi_dung' => '
            Tôi là Tùng 1',
        ]);
    }
}
