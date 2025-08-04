<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');

        // Clear existing records
        DB::table('products')->truncate();

        // Get existing manufacturer IDs
        $manufacturerIds = DB::table('manufacturers')->pluck('id')->toArray();

        if (empty($manufacturerIds)) {
            $this->call(ManufacturersTableSeeder::class); // Ensure manufacturers exist
            $manufacturerIds = DB::table('manufacturers')->pluck('id')->toArray();
        }

        $categories = ['Electronics', 'Home Goods', 'Apparel', 'Books', 'Food', 'Toys', 'Sports'];

        for ($i = 0; $i < 30; $i++) { // Creating 30 products
            DB::table('products')->insert([
                'name' => $faker->unique()->words(rand(1, 3), true) . ' ' . $faker->word,
                'category' => $faker->randomElement($categories),
                'description' => $faker->paragraph(3),
                'price' => $faker->randomFloat(2, 5, 500),
                'stock_quantity' => $faker->numberBetween(0, 200),
                'sku' => 'SKU-' . $faker->unique()->ean8,
                'is_available' => $faker->boolean(80), // 80% chance of being available
                'weight_kg' => $faker->randomFloat(2, 0.1, 10),
                'dimensions_cm' => $faker->numberBetween(5, 50) . 'x' . $faker->numberBetween(5, 50) . 'x' . $faker->numberBetween(1, 30),
                'manufacturer_id' => $faker->randomElement($manufacturerIds),
                'release_date' => $faker->date(),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
