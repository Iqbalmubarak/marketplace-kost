<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude($min = -0, $max = 1),
            'longitude' => $this->faker->longitude($min = 180, $max = 101),
            'type_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
