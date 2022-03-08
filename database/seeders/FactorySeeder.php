<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Kost;
use App\Models\Room;
use App\Models\KostOwner;
use App\Models\KostSeeker;
use App\Models\KostFacilityDetail;
use App\Models\RuleDetail;
use App\Models\Rule;
use App\Models\Facility;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Sequence;

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
        // for($i=1; $i<=4; $i++){
        //     $room = Room::factory(10)->create([
        //         'kost_id' => $i,
        //     ]);
        // }
        $user = User::factory(10)
            ->has(KostOwner::factory()->count(1)
                    ->has(Kost::factory()->count(4)
                        , 'kost')
            , 'kostOwner')
            ->create();
        
        $kosts = Kost::all();
        $rules = Rule::all();
        $facilities = Facility::whereIn('facility_type_id', [1, 2])->get();
        foreach($kosts as $kost){
            foreach($rules as $rule){
                $ruleDetail = RuleDetail::factory()
                                        ->count(1)
                                        ->state(new Sequence(
                                            fn ($sequence) => ['kost_id' => $kost->id],
                                        ))
                                        ->state(new Sequence(
                                            fn ($sequence) => ['rule_id' => $rule->id],
                                        ))
                                        ->create();
            }
            
            foreach($facilities as $facility){
                $kostFacilityDetail = KostFacilityDetail::factory()
                                        ->count(1)
                                        ->state(new Sequence(
                                            fn ($sequence) => ['kost_id' => $kost->id],
                                        ))
                                        ->state(new Sequence(
                                            fn ($sequence) => ['facility_id' => $facility->id],
                                        ))
                                        ->create();
            }           
        }

        $user = User::factory(10)
            ->has(KostSeeker::factory()->count(1), 'kostSeeker')
            ->create();

    }
}
