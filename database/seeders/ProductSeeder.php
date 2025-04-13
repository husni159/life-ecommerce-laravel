<?php
namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('en_US');
        $categories = Category::all();

        foreach (range(1, 20) as $i) {
            $name = $faker->words(3, true);

            $product = Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->sentence(10),
                'price' => $faker->randomFloat(2, 10, 1000),
                'stock_quantity' => $faker->numberBetween(1, 100),
                'images' => [
                    $faker->imageUrl(640, 480, 'products'),
                    $faker->imageUrl(640, 480, 'products')
                ],
            ]);

            // Attach 1-3 random categories
            $product->categories()->attach($categories->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
