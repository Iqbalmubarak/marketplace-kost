<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->buildingNumber(),
            'price' => $this->faker->numberBetween(150000, 250000, 500000),
        ];
    }
}
