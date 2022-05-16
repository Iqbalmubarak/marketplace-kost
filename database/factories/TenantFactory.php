<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name($gender = null),
            'gender' => $this->faker->numberBetween(1,2),
            'birth_place' => $this->faker->city(),
            'birth_day' => $this->faker->date(),
            'handphone' => $this->faker->phoneNumber(),
            'emergency' => $this->faker->phoneNumber(),
            'job' => $this->faker->numberBetween(1,3),
            'job_name' => $this->faker->jobTitle(),
            'job_description' => $this->faker->jobTitle(),
        ];
    }
}
