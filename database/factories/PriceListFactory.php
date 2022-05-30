<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PriceListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween(400000, 2000000),
            'rent_duration_id' => $this->faker->randomElement($array = array (2,3,4,5)),
        ];
    }
}
