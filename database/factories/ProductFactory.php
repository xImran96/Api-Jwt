<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'rent'=> '$'.$this->faker->numberBetween(100, 1000),
            'refundable_deposit'=>'$'.$this->faker->numberBetween(500, 2000),
            'size'=> 6 * $this->faker->numberBetween(1, 6),
            'category_id'=> $this->faker->numberBetween(1, 15),
        ];
    }
}
