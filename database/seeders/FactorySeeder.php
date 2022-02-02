<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Kost;
use App\Models\Room;
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
        $kost = Kost::factory(4)->create([
            'kost_owner_id' => 1,
        ]);
        for($i=1; $i<=4; $i++){
            $room = Room::factory(10)->create([
                'kost_id' => $i,
            ]);
        }
        $user = User::factory(10)
            ->has(KostOwner::factory()->count(1)
                    ->has(Kost::factory()->count(4)
                            ->has(Room::factory()->count(10)
                                , 'room')
                        , 'kost')
            , 'kostOwner')
            ->create();
        $user = User::factory(10)
            ->has(KostSeeker::factory()->count(1), 'kostSeeker')
            ->create();

    }
}
