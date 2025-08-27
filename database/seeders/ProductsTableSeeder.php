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

        $products = [
            [
                'name' => 'Apple Watch Series 5',
                'category' => 'Electronics',
                'description' => 'The latest Apple Watch is here with a built-in GPS, a faster processor, and an always-on display.',
                'price' => 399.99,
                'stock_quantity' => 100,
                'sku' => 'AW-S5-001',
                'is_available' => true,
                'weight_kg' => 0.5,
                'dimensions_cm' => '5x5x2.5',
                'manufacturer_id' => 1,
                'release_date' => '2019-09-01',
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'category' => 'Electronics',
                'description' => 'A flagship smartphone with a powerful processor, a 6.2-inch Dynamic AMOLED display, and a long-lasting battery.',
                'price' => 799.99,
                'stock_quantity' => 50,
                'sku' => 'SGS21-001',
                'is_available' => true,
                'weight_kg' => 0.8,
                'dimensions_cm' => '15.5x7.5x1.5',
                'manufacturer_id' => 2,
                'release_date' => '2020-01-01',
            ],
            [
                'name' => 'Nike Air Max 270',
                'category' => 'Apparel',
                'description' => 'A stylish and comfortable sneaker with a full-length air unit and a sleek design.',
                'price' => 120,
                'stock_quantity' => 200,
                'sku' => 'NIK-AM270-001',
                'is_available' => true,
                'weight_kg' => 1.5,
                'dimensions_cm' => '30x20x10',
                'manufacturer_id' => 3,
                'release_date' => '2020-02-01',
            ],
            [
                'name' => 'The Catcher in the Rye',
                'category' => 'Books',
                'description' => 'A classic novel by J.D. Salinger about teenage angst and rebellion.',
                'price' => 15.99,
                'stock_quantity' => 500,
                'sku' => 'BK-CR-001',
                'is_available' => true,
                'weight_kg' => 0.5,
                'dimensions_cm' => '25x15x4',
                'manufacturer_id' => 4,
                'release_date' => '1951-01-01',
            ],
            [
                'name' => 'Apple AirPods Pro',
                'category' => 'Electronics',
                'description' => 'Premium wireless headphones with active noise cancellation and a water-resistant design.',
                'price' => 249.99,
                'stock_quantity' => 150,
                'sku' => 'AAP-001',
                'is_available' => true,
                'weight_kg' => 0.3,
                'dimensions_cm' => '4.5x2x2',
                'manufacturer_id' => 1,
                'release_date' => '2020-03-01',
            ],
            [
                'name' => 'Samsung Galaxy Tab S7',
                'category' => 'Electronics',
                'description' => 'A powerful Android tablet with a large AMOLED display, a long-lasting battery, and a stylus.',
                'price' => 599.99,
                'stock_quantity' => 100,
                'sku' => 'SGTS7-001',
                'is_available' => true,
                'weight_kg' => 0.9,
                'dimensions_cm' => '24.5x16.5x2.5',
                'manufacturer_id' => 2,
                'release_date' => '2020-07-01',
            ],
            [
                'name' => 'Nike Air Force 1',
                'category' => 'Apparel',
                'description' => 'A classic and stylish sneaker with a comfortable fit and a wide range of colors.',
                'price' => 90,
                'stock_quantity' => 300,
                'sku' => 'NIK-AF1-001',
                'is_available' => true,
                'weight_kg' => 1.2,
                'dimensions_cm' => '28x20x10',
                'manufacturer_id' => 3,
                'release_date' => '2020-01-01',
            ],
            [
                'name' => 'To Kill a Mockingbird',
                'category' => 'Books',
                'description' => 'A Pulitzer Prize-winning novel by Harper Lee about racial injustice and a young girl\'s coming of age.',
                'price' => 12.99,
                'stock_quantity' => 200,
                'sku' => 'BK-TKAM-001',
                'is_available' => true,
                'weight_kg' => 0.5,
                'dimensions_cm' => '25x15x4',
                'manufacturer_id' => 4,
                'release_date' => '1960-01-01',
            ],
            [
                'name' => 'Apple MacBook Air',
                'category' => 'Electronics',
                'description' => 'A lightweight and powerful laptop with a 13.3-inch Retina display, an Intel Core i3 processor, and a long-lasting battery.',
                'price' => 999.99,
                'stock_quantity' => 50,
                'sku' => 'AMB-A001',
                'is_available' => true,
                'weight_kg' => 1.3,
                'dimensions_cm' => '29.5x21.5x1.5',
                'manufacturer_id' => 1,
                'release_date' => '2020-03-01',
            ],
            [
                'name' => 'Samsung Q90R 4K Smart TV',
                'category' => 'Electronics',
                'description' => 'A top-of-the-line 4K LED TV with a large 65-inch display, a powerful processor, and advanced features like HDR10+ and 4K AI upscaling.',
                'price' => 2499.99,
                'stock_quantity' => 50,
                'sku' => 'SQT90R-001',
                'is_available' => true,
                'weight_kg' => 2.5,
                'dimensions_cm' => '144x81x6',
                'manufacturer_id' => 2,
                'release_date' => '2020-01-01',
            ],
            [
                'name' => 'Nike Air Max Invigor',
                'category' => 'Apparel',
                'description' => 'A lightweight and comfortable sneaker with a full-length air unit and a sleek design.',
                'price' => 80,
                'stock_quantity' => 250,
                'sku' => 'NIK-AMIG-001',
                'is_available' => true,
                'weight_kg' => 1.1,
                'dimensions_cm' => '27x19x10',
                'manufacturer_id' => 3,
                'release_date' => '2020-03-01',
            ],
            [
                'name' => '1984',
                'category' => 'Books',
                'description' => 'A dystopian novel by George Orwell about a totalitarian society and the surveillance state.',
                'price' => 14.99,
                'stock_quantity' => 300,
                'sku' => 'BK-1984-001',
                'is_available' => true,
                'weight_kg' => 0.5,
                'dimensions_cm' => '25x15x4',
                'manufacturer_id' => 4,
                'release_date' => '1949-01-01',
            ],
            [
                'name' => 'Apple iPad (7th Generation)',
                'category' => 'Electronics',
                'description' => 'A powerful and affordable tablet with a 10.2-inch display, an Apple A12 Bionic chip, and a long-lasting battery.',
                'price' => 329.99,
                'stock_quantity' => 150,
                'sku' => 'APIP-001',
                'is_available' => true,
                'weight_kg' => 0.9,
                'dimensions_cm' => '24.5x16.5x1.5',
                'manufacturer_id' => 1,
                'release_date' => '2020-03-01',
            ],
            [
                'name' => 'Samsung Galaxy Watch Active2',
                'category' => 'Electronics',
                'description' => 'A lightweight and stylish smartwatch with a 40mm display, a long-lasting battery, and advanced fitness features.',
                'price' => 279.99,
                'stock_quantity' => 100,
                'sku' => 'SGWA2-001',
                'is_available' => true,
                'weight_kg' => 0.4,
                'dimensions_cm' => '4.5x3.5x1',
                'manufacturer_id' => 2,
                'release_date' => '2020-04-01',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
