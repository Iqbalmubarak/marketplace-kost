<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use App\Models\Kost;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\TenantDetail;
use App\Models\KostOwner;
use App\Models\KostSeeker;
use App\Models\KostFacilityDetail;
use App\Models\RoomFacilityDetail;
use App\Models\RuleDetail;
use App\Models\Rule;
use App\Models\Rent;
use App\Models\RentDetail;
use App\Models\Facility;
use App\Models\RoomType;
use App\Models\PriceList;
use App\Models\KostImage;
use App\Models\RoomImage;
use App\Models\RuleUpload;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodDetail;
use App\Models\RentPayment;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Carbon\Carbon;

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
                ->has(RoomType::factory(rand(1,3))
                    ->state(function (array $attributes, Kost $kost) {
                        $faker = resolve(Faker::class);
                        $nameCollection = 
                        collect([
                            1 => ['Tipe A', 'Tipe B', 'Tipe C', 'Tipe D', 'Tipe E'],
                            2 => ['Tipe Standar', 'Tipe Eksklusif', 'Tipe Premium', 'Tipe Superior', 'Tipe Deluxe']
                        ]);
                        if($kost->id %2 ==1){
                            $randomElement = $faker->randomElement($nameCollection[1], $count = 1, $allowDuplicates = false);
                            $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                            while($roomType){
                                $randomElement = $faker->randomElement($nameCollection[1], $count = 1, $allowDuplicates = false);
                                $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                            }
                            return ['name' => $randomElement];
                        }else{
                            $randomElement = $faker->randomElement($nameCollection[2], $count = 1, $allowDuplicates = false);
                            $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                            while($roomType){
                                $randomElement = $faker->randomElement($nameCollection[2], $count = 1, $allowDuplicates = false);
                                $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                            }
                            return ['name' => $randomElement];
                        }
                    })
                    ->has(PriceList::factory(rand(1,3))
                    ->state(function (array $attributes, RoomType $roomType) {
                        $random_number = rand(2,5);
                        $priceList = PriceList::where('room_type_id', $roomType->id)
                                                ->where('rent_duration_id', $random_number)
                                                ->first();
                        while($priceList){
                            $random_number = rand(2,5);
                            $priceList = PriceList::where('room_type_id', $roomType->id)
                                                    ->where('rent_duration_id', $random_number)
                                                    ->first();
                        }
                        return ['rent_duration_id' => $random_number];
                    })
                    , 'priceList')
                , 'roomType')
        ->create([
            'kost_owner_id' => 1,
        ]);

        $user = User::factory(10)
        ->has(KostOwner::factory()->count(1)
                ->has(Kost::factory()->count(4)
                        ->has(RoomType::factory(rand(1,3))
                            ->state(function (array $attributes, Kost $kost) {
                                $faker = resolve(Faker::class);
                                $nameCollection = 
                                collect([
                                    1 => ['Tipe A', 'Tipe B', 'Tipe C', 'Tipe D', 'Tipe E'],
                                    2 => ['Tipe Standar', 'Tipe Eksklusif', 'Tipe Premium', 'Tipe Superior', 'Tipe Deluxe']
                                ]);
                                if($kost->id %2 ==1){
                                    $randomElement = $faker->randomElement($nameCollection[1], $count = 1, $allowDuplicates = false);
                                    $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                                    while($roomType){
                                        $randomElement = $faker->randomElement($nameCollection[1], $count = 1, $allowDuplicates = false);
                                        $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                                    }
                                    return ['name' => $randomElement];
                                }else{
                                    $randomElement = $faker->randomElement($nameCollection[2], $count = 1, $allowDuplicates = false);
                                    $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                                    while($roomType){
                                        $randomElement = $faker->randomElement($nameCollection[2], $count = 1, $allowDuplicates = false);
                                        $roomType = RoomType::where('kost_id', $kost->id)->where('name', $randomElement)->first();
                                    }
                                    return ['name' => $randomElement];
                                }
                            })
                            ->has(PriceList::factory(rand(1,3))
                            ->state(function (array $attributes, RoomType $roomType) {
                                $random_number = rand(2,5);
                                $priceList = PriceList::where('room_type_id', $roomType->id)
                                                        ->where('rent_duration_id', $random_number)
                                                        ->first();
                                while($priceList){
                                    $random_number = rand(2,5);
                                    $priceList = PriceList::where('room_type_id', $roomType->id)
                                                            ->where('rent_duration_id', $random_number)
                                                            ->first();
                                }
                                return ['rent_duration_id' => $random_number];
                            })
                            , 'priceList')
                        , 'roomType')
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

            $priceList = new PriceList;
            $priceList->price = rand(400000, 2000000);
            $priceList->room_type_id = $room_type->id;
            $priceList->rent_duration_id = 1;
            $priceList->save();

            $rooms = Room::where('kost_id', $room_type->kost_id)
                            ->where('room_type_id', $room_type->id)
                            ->take(rand(2,6))
                            ->get();

            foreach($rooms as $room){
                $rent = new Rent;
                $rent->room_id = $room->id;
                $random = rand(6,24);
                $rent->created_at = $faker->dateTimeBetween($startDate = '-'.$random.' months', $endDate = 'now', $timezone = null);
                $rent->save();
                
                $started_at = $rent->created_at;
                for($i=0; $i<$random; $i++){
                    $rentDetail = new RentDetail;
                    $rentDetail->rent_id = $rent->id;
                    
                    $priceList = PriceList::where('rent_duration_id', 1)->where('room_type_id', $room_type->id)->first();
                    $rentDetail->price_list_id = $priceList->id;
                    $rentDetail->total_price = $priceList->price;
                    $rentDetail->started_at = $started_at;
                    $ended_at = new Carbon($rentDetail->started_at);
                    $rentDetail->ended_at = $ended_at->addDays($priceList->rentDuration->day);
                    $rentDetail->status = 1;
                    $rentDetail->save();

                    $started_at = date('Y-m-d', strtotime('+1days', strtotime($rentDetail->ended_at)));
                }

                $tenants = Tenant::factory()
                                        ->count(rand(1,2))
                                        ->state(new Sequence(
                                            fn ($sequence) => ['kost_id' => $room_type->kost_id],
                                        ))
                                        ->create();

                foreach($tenants as $tenant){
                    $tenantDetail = new TenantDetail;
                    $tenantDetail->tenant_id = $tenant->id;
                    $tenantDetail->rent_id = $rent->id;
                    $tenantDetail->save();
                }
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
            

            $paymentMethod = PaymentMethod::all();
            for($i=1; $i<=rand(1,3); $i++)
            {
                $rand_number = rand(1, $paymentMethod->count());
                $paymentMethodDetail = PaymentMethodDetail::where('kost_id', $kost->id)
                                                            ->where('payment_method_id', $rand_number)
                                                            ->first();

                while($paymentMethodDetail)
                {
                    $rand_number = rand(1, $paymentMethod->count());
                    $paymentMethodDetail = PaymentMethodDetail::where('kost_id', $kost->id)
                                                                ->where('payment_method_id', $rand_number)
                                                                ->first();
                }
                $paymentMethodDetail = new PaymentMethodDetail;
                $paymentMethodDetail->kost_id = $kost->id;
                $paymentMethodDetail->payment_method_id = $rand_number;
                $paymentMethodDetail->no_rek = $faker->creditCardNumber();
                $paymentMethodDetail->save();
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
