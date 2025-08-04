<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');


        for ($i = 0; $i < 10; $i++) { // Creating 10 manufacturers
            DB::table('manufacturers')->insert([
                'name' => $faker->unique()->company,
                'country_of_origin' => $faker->country,
                'website' => $faker->url,
                'contact_email' => $faker->unique()->companyEmail,
                'founded_year' => $faker->year(),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
