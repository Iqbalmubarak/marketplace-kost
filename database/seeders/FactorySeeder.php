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
use App\Models\KostImage;
use App\Models\RoomImage;
use App\Models\RuleUpload;
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
                ->has(RoomType::factory()->count(3)
                    ->state(function (array $attributes, Kost $kost) {
                        $faker = resolve(Faker::class);
                        $nameCollection = 
                        collect([
                            1 => ['Tipe A', 'Tipe B', 'Tipe C', 'Tipe D', 'Tipe E'],
                            2 => ['Tipe Standar', 'Tipe Eksklusif', 'Tipe Premium', 'Tipe Superior', 'Tipe Deluxe']
                        ]);
                        if($kost->id %2 ==1){
                            return ['name' => $faker->randomElement($nameCollection[1], $count = 1, $allowDuplicates = false)];
                        }else{
                            return ['name' => $faker->randomElement($nameCollection[2], $count = 1, $allowDuplicates = false)];
                        }
                    })
                    ->has(PriceList::factory()->count(1)
                    , 'priceList')
                , 'roomType')
                ->has(Tenant::factory()->count(10)
                , 'tenant')
        ->create([
            'kost_owner_id' => 1,
        ]);

        $user = User::factory(10)
        ->has(KostOwner::factory()->count(1)
                ->has(Kost::factory()->count(4)
                        ->has(RoomType::factory()->count(random_int(1, 3))
                            ->state(function (array $attributes, Kost $kost) {
                                $faker = resolve(Faker::class);
                                $nameCollection = 
                                collect([
                                    1 => ['Tipe A', 'Tipe B', 'Tipe C', 'Tipe D', 'Tipe E'],
                                    2 => ['Tipe Standar', 'Tipe Eksklusif', 'Tipe Premium', 'Tipe Superior', 'Tipe Deluxe']
                                ]);
                                if($kost->id %2 ==1){
                                    return ['name' => $faker->randomElement($nameCollection[1], $count = 1, $allowDuplicates = false)];
                                }else{
                                    return ['name' => $faker->randomElement($nameCollection[2], $count = 1, $allowDuplicates = false)];
                                }
                            })
                            ->has(PriceList::factory()->count(4)
                            , 'priceList')
                        , 'roomType')
                        ->has(Tenant::factory()->count(10)
                        , 'tenant')
                    , 'kost')
        , 'kostOwner')
        ->create();
        
        $kosts = Kost::all();
        $rules = Rule::all();
        $room_types = RoomType::all();
        $kost_facilities = Facility::whereIn('facility_type_id', [1, 2])->get();
        
        $room_facilities = Facility::whereIn('facility_type_id', [3, 4])->get();
        foreach($room_types as $room_type){
            $room = Room::factory(10)->create([
                'kost_id' => $room_type->kost_id,
                'room_type_id' => $room_type->id,
            ]);

            $rooms = Room::where('kost_id', $room_type->kost_id)
                            ->where('room_type_id', $room_type->id)
                            ->take(rand(1,5))
                            ->get();

            foreach($rooms as $room){
                $rent = new Rent;
                $rent->room_id = $room->id;
                $rent->created_at = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null);
            }

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
            for($section=4; $section<=7; $section++){
                $n = rand(1,3);
                for($i=0; $i<$n; $i++){
                    if($section == 4){
                        $val = (string) rand(1,60);
                    }elseif($section == 5){
                        $val = (string) rand(1,51);
                    }elseif($section == 6){
                        $val = (string) rand(1,50);
                    }else{
                        $val = (string) rand(1,30);
                    }
                    
                    $roomImage = new RoomImage;
                    $roomImage->image = "s".$section."_".$val.".jpg";
                    $roomImage->room_type_id = $room_type->id;
                    $roomImage->section_id = $section;
                    $roomImage->save();
                } 
            }

            $priceList = new PriceList;
            $priceList->price = rand(400000, 2000000);
            $priceList->room_type_id = $room_type->id;
            $priceList->rent_duration_id = 1;
            $priceList->save();
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
            
            for($section=1; $section<=3; $section++){
                $n = rand(1,3);
                for($i=0; $i<$n; $i++){
                    if($section == 1){
                        $val = (string) rand(1,50);
                    }elseif($section == 2){
                        $val = (string) rand(1,18);
                    }else{
                        $val = (string) rand(1,31);
                    }
                    
                    $kostImage = new KostImage;
                    $kostImage->image = "s".$section."_".$val.".jpg";
                    $kostImage->kost_id = $kost->id;
                    $kostImage->section_id = $section;
                    $kostImage->save();
                } 
            }

            $val = (string) rand(1,20);
            $ruleUpload = new RuleUpload;
            $ruleUpload->image = "rule_".$val.".jpg";
            $ruleUpload->kost_id = $kost->id;
            $ruleUpload->save();
        }

        $user = User::factory(10)
            ->has(KostSeeker::factory()->count(1), 'kostSeeker')
            ->create();

    }
}
