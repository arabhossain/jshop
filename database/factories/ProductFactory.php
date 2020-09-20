<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $this->faker->text(),
            'category'  => Category::all()->random(1)->first(),
            'price' => $this->faker->randomFloat(2,2,200),
        ];
    }
}
