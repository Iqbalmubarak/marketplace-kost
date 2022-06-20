<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\KostImage;
use App\Models\RoomType;
use App\Models\Location;
use DB;

class MapController extends Controller
{
    public function getKost(Request $request){
        $roomTypes = RoomType::whereIn('id', $request->room_type_id)->get();
        $kost_id = collect([]);;
        foreach($roomTypes as $roomType){
            $kost_id->push($roomType->kost_id);
        }
        $datas = [];
        $datas = Kost::whereIn('id', $kost_id)->get();
        foreach($datas as $data){
            $kostImage = KostImage::where('kost_id', $data->id)->orderby('id', 'asc')->first();
            $roomType = RoomType::where('kost_id', $data->id)->orderby('id', 'asc')->first();
            $data->image = $kostImage->image;
            $data->room_type = $roomType->id;
        }

        return response()->json($datas);
    }

    public function getAround(Request $request){
        $data = DB::select("SELECT 
                        kosts.id as id,
                        room_types.kost_id as kost_id,
                        kosts.name as name,
                        kosts.latitude as latitude,
                        kosts.longitude as longitude
                    FROM room_types
                    JOIN kosts on room_types.kost_id = kosts.id
                    WHERE ( POW( ( 69.1 * ( longitude - -0.914518 ) * cos( 40.711676 / 57.3 ) ) , 2 ) + 
								POW( ( 69.1 * ( latitude - 100.459526 ) ) , 2 ) ) < ( 1 *1 )");

        $datas = Location::select("locations.id", \DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
        * cos(radians(locations.latitude)) 
        * cos(radians(locations.longitude) - radians(" . $request->longitude . ")) 
        + sin(radians(" .$request->latitude. ")) 
        * sin(radians(locations.latitude))) AS distance, locations.name, locations.latitude, locations.longitude, locations.location_category_id"))
        ->having('distance', '<', 1)
        ->get();
        
        return response()->json($datas);
    }
}
