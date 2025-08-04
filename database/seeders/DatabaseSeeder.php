<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Order matters due to foreign key constraints
        $this->call([
            UsersTableSeeder::class, // Assuming a basic Users table for relationships
            FruitsTableSeeder::class,
            ManufacturersTableSeeder::class,
            ProductsTableSeeder::class,
            BooksTableSeeder::class,
            PersonTableSeeder::class,
        ]);
    }
}
