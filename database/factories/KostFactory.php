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
            'exist' => $this->faker->numberBetween(2000, 2022),
            'manager_name' => $this->faker->name(),
            'manager_handphone' => $this->faker->phoneNumber(),
            'latitude' => $this->faker->latitude($min = -0, $max = 1),
            'longitude' => $this->faker->longitude($min = 180, $max = 101),
            'kost_type_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
