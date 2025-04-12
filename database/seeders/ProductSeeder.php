<?php

// database/seeders/CategoryProductSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Tạo một danh mục và 5 sản phẩm thuộc danh mục đó
        Category::factory()
            ->has(Product::factory()->count(5))  // Tạo 5 sản phẩm cho mỗi danh mục
            ->create();
    }
}
