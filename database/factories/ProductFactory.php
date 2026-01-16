<?php
// database/factories/ProductFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {
    protected $model = \App\Models\Product::class;

    public function definition(): array {
        return [
            'name' => $this->faker->word,
            'sku' => $this->faker->unique()->bothify('SKU-####'),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock_quantity' => $this->faker->numberBetween(10, 100),
            'status' => 'active'
        ];
    }
}