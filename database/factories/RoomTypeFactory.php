<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoomTypeFactory extends Factory
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
            'wide' => $this->faker->numberBetween(2, 5),
            'lenght' => $this->faker->numberBetween(2, 5),
            'capacity' => $this->faker->numberBetween(1, 4),
        ];
    }
}
