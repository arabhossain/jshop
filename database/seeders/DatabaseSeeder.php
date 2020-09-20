<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Shop::factory()->count(8)->create();
        Category::factory()->count(15)->create();
        Product::factory()->count(20)->create();
        Sale::factory()->count(50)->create();
        Shop::factory()->count(5)->create();
    }
}
