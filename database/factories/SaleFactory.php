<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qty'   => $this->faker->numberBetween(0,100),
            'product'   => Product::all()->random(1)->first(),
            'shop'  => Shop::all()->random(1)->first(),
        ];
    }
}
