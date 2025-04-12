<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample banner data
        DB::table('banners')->insert([
            [
                'ten_banner' => 'Banner 1',
                'mo_ta' => 'This is the description for Banner 1.'
            ],
            [
                'ten_banner' => 'Banner 2',
                'mo_ta' => 'This is the description for Banner 2.'
            ],
            [
                'ten_banner' => 'Banner 3',
                'mo_ta' => 'This is the description for Banner 3.'
            ],
        ]);
    }
}
