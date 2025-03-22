<?php

namespace Database\Seeders;

use App\Models\RealEstate;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RealEstateSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $types = ['house', 'department', 'land', 'commercial_ground'];

        for ($i = 0; $i < 20; $i++) {
            $type = $faker->randomElement($types);

            RealEstate::create([
                'name'             => $faker->words(3, true),
                'real_state_type'  => $type,
                'street'           => $faker->streetName,
                'external_number'  => strtoupper($faker->bothify('??-###')),
                'internal_number'  => in_array($type, ['department', 'commercial_ground']) ? $faker->bothify('??-##') : null,
                'neighborhood'     => $faker->word,
                'city'             => $faker->city,
                'country'          => $faker->countryCode,
                'rooms'            => $faker->numberBetween(1, 10),
                'bathrooms'        => $faker->randomFloat(2, 1, 5),
                'comments'         => $faker->sentence,
            ]);
        }
    }
}
