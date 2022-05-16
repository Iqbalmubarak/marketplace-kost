<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\RoomType;
use App\Models\PriceList;
use App\Models\RentDuration;
use App\Models\OptionalPrice;
use Helper;
use DB;
use Carbon\Carbon;

class SelectController extends Controller
{
  public function roomType($id){
    $room_type = RoomType::select('id','name')
    ->where('kost_id', $id)
    ->get();

    return response()->json($room_type);
  }

  public function room($id){
    $rents = Rent::join('rooms', 'rooms.id', '=', 'rents.room_id')
    ->where('rents.status', 1)
    ->where('rooms.room_type_id', $id)
    ->get();

    $room_id = collect([]);;
    foreach($rents as $rent){
        $room_id->push($rent->room_id);
    }

    $room = Room::select('id','name')
    ->where('room_type_id', $id)
    ->whereNotIn('id', $room_id)
    ->get();

    return response()->json($room);
  }

  public function tenant($id){
    $tenant = Tenant::select('id','name')
    ->where('kost_id', $id)
    ->get();

    return response()->json($tenant);
  }

  public function duration($id){
    
    $priceList = PriceList::select('price_lists.id',DB::RAW("concat(rent_durations.name,'/ ',concat('Rp. ', format(price_lists.price,2, 'id_ID'))) as name"))
    ->join('rent_durations','price_lists.rent_duration_id','=','rent_durations.id')
    ->where('room_type_id', $id)->get();

    return response()->json($priceList);
  }

  public function optional($id){
    $optional_price = OptionalPrice::select('id',DB::RAW("concat(name,'/ ',concat('Rp. ', format(price,2, 'id_ID'))) as name"), 'price')->where('room_type_id', $id)->get();

    return response()->json($optional_price);
  }

  public function duration_price($id){
    $duration_price = PriceList::find($id);

    return response()->json($duration_price);
  }

  public function rentRange(Request $request, $id){
    $priceList = PriceList::find($id);
    $start = $request->start;
    $end = Carbon::create($start)->addDays($priceList->rentDuration->day);
    $end = $end->format('m/d/Y');

    return response()->json($end);
  }
}
