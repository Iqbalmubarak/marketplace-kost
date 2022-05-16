<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Kost;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\KostOwner;
use App\Models\KostSeeker;
use App\Models\KostFacilityDetail;
use App\Models\RoomFacilityDetail;
use App\Models\RuleDetail;
use App\Models\Rule;
use App\Models\Facility;
use App\Models\RoomType;
use App\Models\PriceList;
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
        $kost = Kost::factory(4)
                ->has(RoomType::factory()->count(1)
                    ->has(PriceList::factory()->count(4)
                    , 'priceList')
                , 'roomType')
                ->has(Tenant::factory()->count(10)
                , 'tenant')
        ->create([
            'kost_owner_id' => 1,
        ]);

        $kosts = Kost::all();
        $rules = Rule::all();
        $room_types = RoomType::all();
        $kost_facilities = Facility::whereIn('facility_type_id', [1, 2])->get();

        $user = User::factory(10)
            ->has(KostOwner::factory()->count(1)
                    ->has(Kost::factory()->count(4)
                            ->has(RoomType::factory()->count(1)
                                ->has(PriceList::factory()->count(4)
                                , 'priceList')
                            , 'roomType')
                            ->has(Tenant::factory()->count(10)
                            , 'tenant')
                        , 'kost')
            , 'kostOwner')
            ->create();
        
        
        $room_facilities = Facility::whereIn('facility_type_id', [3, 4])->get();
        foreach($room_types as $room_type){
            $room = Room::factory(10)->create([
                'kost_id' => $room_type->kost_id,
                'room_type_id' => $room_type->id,
            ]);
            foreach($room_facilities as $facility){
                $roomFacilityDetail = RoomFacilityDetail::factory()
                                        ->count(1)
                                        ->state(new Sequence(
                                            fn ($sequence) => ['room_type_id' => $room_type->id],
                                        ))
                                        ->state(new Sequence(
                                            fn ($sequence) => ['facility_id' => $facility->id],
                                        ))
                                        ->create();
            } 
        }

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
            
            foreach($kost_facilities as $facility){
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
