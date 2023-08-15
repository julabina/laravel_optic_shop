<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OcularAttribute>
 */
class OcularAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'brand_id' => Brand::factory(),
            'focalLength' => 12,
            'fov' => 68,
            'eyeRelief' => 18,
            'size' => 32
        ];
    }
}
