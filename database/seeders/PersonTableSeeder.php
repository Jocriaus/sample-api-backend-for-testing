<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_US');

        // Clear existing records to prevent duplicates on re-seeding
        DB::table('people')->truncate();

        $genders = ['Male', 'Female', 'Non-binary', null]; // Including null for testing nullable fields

        for ($i = 0; $i < 25; $i++) { // Creating 25 person records
            DB::table('people')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->boolean(80) ? $faker->unique()->safeEmail : null, // 80% chance of having an email
                'phone_number' => $faker->boolean(70) ? $faker->phoneNumber : null, // 70% chance of having a phone number
                'date_of_birth' => $faker->boolean(90) ? $faker->date('Y-m-d', '2005-01-01') : null, // 90% chance of having a DOB
                'gender' => $faker->randomElement($genders),
                'address' => $faker->boolean(85) ? $faker->streetAddress : null,
                'city' => $faker->boolean(85) ? $faker->city : null,
                'state' => $faker->boolean(85) ? $faker->stateAbbr : null,
                'zip_code' => $faker->boolean(85) ? $faker->postcode : null,
                'country' => $faker->boolean(85) ? $faker->country : null,
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}
