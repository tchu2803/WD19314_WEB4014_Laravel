<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'ma_san_pham' => $this->faker->unique()->numerify('SP####'),
            'ten_san_pham' => $this->faker->word(),
            'ma_danh_muc' => Category::factory(),
            'hinh_anh' => null,
            'so_luong' => $this->faker->numberBetween(1, 100),
            'gia' => $this->faker->randomFloat(2, 1000, 1000000),
            'gia_khuyen_mai' => $this->faker->optional()->randomFloat(2, 1000, 1000000),
            'mo_ta' => $this->faker->sentence(),
            'trang_thai' => $this->faker->numberBetween(0, 1),
        ];
    }
}