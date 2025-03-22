<?php

namespace Database\Factories;

use App\Models\RealEstate;
use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstateFactory extends Factory
{
    protected $model = RealEstate::class;

    public function definition()
    {
        $types = ['house', 'department', 'land', 'commercial_ground'];
        $type = $this->faker->randomElement($types);

        return [
            'name'             => $this->faker->words(3, true),
            'real_state_type'  => $type,
            'street'           => $this->faker->streetName,
            'external_number'  => strtoupper($this->faker->bothify('??-###')),
            'internal_number'  => in_array($type, ['department', 'commercial_ground']) ? $this->faker->bothify('??-##') : null,
            'neighborhood'     => $this->faker->word,
            'city'             => $this->faker->city,
            'country'          => $this->faker->countryCode,
            'rooms'            => $this->faker->numberBetween(1, 10),
            'bathrooms'        => $this->faker->randomFloat(2, 1, 5),
            'comments'         => $this->faker->sentence,
        ];
    }
}
