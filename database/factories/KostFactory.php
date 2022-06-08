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
        $kost_name = ['Kost Edelweiss','Kost Annisa', 'Kost Amanah', 'Homy Kost','Kost Kamang 18', 'Kost Hendra', 'Kost Oma','Kost Razafa', 'Aranka Kost','Kost Jasmine','Kost Amna','Kost Abbastin','Kost Pemondokan Cemara','Kost Pemondokan Gina','Kost Shaqila','Kost Alaska','Kost Mediva','Kost Tirta Ulya','Kost Fajar','Kost Lili','Kost Syafira','Kost Ummi','Kost Rudi','Kost Kakoto','Kost Marsya','Kost Mawar','Kost Mahasiswa','Kost Kita','Kost Jiwani','Kost Vier','Kost Lalito','Kost Kubik','Kost Rimbun','Kost Pavilon','Kost Hokky','Kost Merjer','Kost Mandys','Kost Safari','Kost Mason','Kost Velocity','Kost Arau','Kost Millenial','Kost Gubuk','Kost Salingka','Kost Alter','Kost Bunbun','Kost Minang','Kost Berok','Kost Nanggalo','Kost Bunda'];
        return [
            'name' => $this->faker->randomElement($kost_name),
            'address' => $this->faker->address(),
            'exist' => $this->faker->numberBetween(2000, 2022),
            'manager_name' => $this->faker->name(),
            'manager_handphone' => $this->faker->phoneNumber(),
            'latitude' => $this->faker->latitude($min = -0.8066666666666668, $max = -0.9072222222222223),
            'longitude' => $this->faker->longitude($min = 100.2911111111111, $max = 100.46138888888889),
            'kost_type_id' => $this->faker->numberBetween(1, 3),
            'status' => $this->faker->numberBetween(1,3),
            'note' => $this->faker->realText(),
        ];
    }
}
