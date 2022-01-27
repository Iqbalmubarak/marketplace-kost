<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Kost;
use App\Models\KostOwner;
use App\Models\KostSeeker;
use Faker\Generator as Faker;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user = User::factory(10)
            ->has(Admin::factory()->count(1), 'admin')
            ->create();
        $user = User::factory(10)
            ->has(KostOwner::factory()->count(1)
                    ->has(Kost::factory()->count(4), 'kost')
                    , 'kostOwner')
            ->create();
        $user = User::factory(10)
            ->has(KostSeeker::factory()->count(1), 'kostSeeker')
            ->create();

    }
}
