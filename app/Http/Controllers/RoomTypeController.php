<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Kost; 
use App\Models\Rule; 
use App\Models\RuleDetail; 
use App\Models\RuleUpload; 
use App\Models\KostType; 
use App\Models\KostImage; 
use App\Models\KostFacilityDetail; 
use App\Models\RoomFacilityDetail; 
use App\Models\FacilityType; 
use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomImage;
use App\Models\PriceList;
use App\Models\OptionalPrice;
use App\Models\RentDuration;
use App\Http\Resources\KostList;
use App\Http\Resources\RoomList;
use App\Http\Resources\RoomTypeList;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use DB;


class RoomTypeController extends Controller
{
    public function roomTypeCreate($id)
    {
        try {   
            $kost = Kost::find($id);    
            $rent_durations = RentDuration::all();
            $facility_types = FacilityType::whereIn('id', [3, 4])->get();
            return view('backend.kostOwner.manageRoomType.create', compact('kost','rent_durations','facility_types'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function roomTypeStore(Request $request, $id)
    {
        try {  
            //Create Room Type
            if(!RoomType::join('rooms', 'room_types.id', '=', 'rooms.room_type_id')->where('rooms.kost_id', $id)->whereRaw("UPPER(room_types.name) = '".strtoupper($request->room_type)."'")->first()){
                $room_type = new RoomType;
                $room_type->name = $request->room_type;
                $room_type->lenght = $request->lenght;
                $room_type->wide = $request->wide;
                $room_type->kost_id = $id;
                $room_type->save();

                //Create Room
                $room_count = Room::where('kost_id', $id)->count();
                for($i = 0; $i < $request->room_total; $i++){
                    $room = new Room;
                    $room->name = $room_count + ($i+1);
                    $room->kost_id = $id;
                    $room->room_type_id = $room_type->id;
                    $room->save();
                }

                //Create Price List
                for ($i=1; $i <= count($request->duration_price); $i++) {
                    if($request->duration_price[$i]){
                        $price = preg_replace("/[^0-9]/", "", $request->duration_price[$i]);
                        $price = (int) $price;
                        $dp = 30 / 100 * $price;
                        $price_list = new PriceList;
                        $price_list->price = $price;
                        $price_list->dp = $dp;
                        $price_list->room_type_id = $room_type->id;
                        $price_list->rent_duration_id = $i;
                        $price_list->save();
                    }
                }
                
                //Create Optional Price
                if(count($request->price_name) > 0){
                    for ($i=0; $i < count($request->price_name); $i++) {
                        $price = preg_replace("/[^0-9]/", "", $request->price[$i]);
                        $price = (int) $price;
                        $optional_price = new OptionalPrice;
                        $optional_price->name = $request->price_name[$i];
                        $optional_price->price = $price;
                        $optional_price->price_list_id = $price_list->id;
                    }
                }

                $facilities = Facility::whereIn('facility_type_id', [3, 4])->get();
                foreach($facilities as $facility){
                    $roomFacilityDetail = new RoomFacilityDetail;
                    $roomFacilityDetail->room_type_id = $room_type->id;
                    $roomFacilityDetail->facility_id = $facility->id;
                    $roomFacilityDetail->save();
                }
                //Room facility
                if($request->room_facility){
                    for($i=0; $i < count($request->room_facility); $i++){
                        $roomFacilityDetail = RoomFacilityDetail::where('room_type_id', $room_type->id)
                        ->where('facility_id', $request->room_facility[$i])
                        ->first();
                        $roomFacilityDetail->status = 2;
                        $roomFacilityDetail->save();
                    }
                }

                //Foto bagian depan kamar
                $dir = storage_path().'/app/public/images/room';
                $image_room1 = $request->file('image_room1');
                if($image_room1){
                    foreach ($image_room1 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room1 = new RoomImage;
                        $image_room1->image = $fileName;
                        $image_room1->room_type_id = $room_type->id;
                        $image_room1->section_id = 4;
                        $image_room1->save();
                    }
                }

                //Foto bagian dalam kamar
                $dir = storage_path().'/app/public/images/room';
                $image_room2 = $request->file('image_room2');
                if($image_room2){
                    foreach ($image_room2 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room2 = new RoomImage;
                        $image_room2->image = $fileName;
                        $image_room2->room_type_id = $room_type->id;
                        $image_room2->section_id = 5;
                        $image_room2->save();
                    }
                }

                //Foto kamar mandi
                $dir = storage_path().'/app/public/images/room';
                $image_room3 = $request->file('image_room3');
                if($image_room3){
                    foreach ($image_room3 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room3 = new RoomImage;
                        $image_room3->image = $fileName;
                        $image_room3->room_type_id = $room_type->id;
                        $image_room3->section_id = 6;
                        $image_room3->save();
                    }
                }

                //Foto tambahan
                $dir = storage_path().'/app/public/images/room';
                $image_room4 = $request->file('image_room4');
                if($image_room4){
                    foreach ($image_room4 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room4 = new RoomImage;
                        $image_room4->image = $fileName;
                        $image_room4->room_type_id = $room_type->id;
                        $image_room4->section_id = 7;
                        $image_room4->save();
                    }
                }
            }else{
                return redirect()->back()->with('error', __('toast.create.unique.message'));
            }
            
            $kost = Kost::find($id);    
            $rooms = Room::groupBy('rooms.room_type_id')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'))
            ->where('rooms.kost_id', $id)
            ->get();
            $room_type = Room::groupBy('rooms.room_type_id')->groupBy('room_types.name')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'), 'room_types.name')
            ->where('rooms.kost_id', $id)
            ->pluck('room_types.name','rooms.room_type_id');

            return redirect()->route('owner.kost.show', compact('kost','rooms','room_type'))->with('success', __('toast.create.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    public function roomTypeEdit($id)
    {
        try {
            $room_type = RoomType::find($id);
            $room_images1 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 4)->get();
            $room_images2 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 5)->get();
            $room_images3 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 6)->get();
            $room_images4 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 7)->get();
            $kost_id = $room_type->room[0]->kost_id;
            $rent_durations = RentDuration::all();
            $price_lists = PriceList::where('room_type_id', $room_type->id)->get();
            
            return view('backend.kostOwner.manageRoomType.edit', compact('price_lists','rent_durations','room_type','kost_id','room_images1','room_images2','room_images3','room_images4'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function roomTypeUpdate(Request $request, $id)
    {
        try {  
            //Create Room Type
            $room_type = RoomType::find($id);
            if(!RoomType::whereNotIn('id', [$id])->whereRaw("UPPER(name) = '".strtoupper($request->room_type)."'")->first()){
                $room_type->name = $request->room_type;
                $room_type->lenght = $request->lenght;
                $room_type->wide = $request->wide;
                $room_type->save();

                //Create Price List
                for ($i=1; $i <= count($request->duration_price); $i++) {
                    $price = NULL;
                    //dd($request->duration_price);
                    if($request->duration_price[$i]){
                        $price_list = PriceList::where('room_type_id', $id)->where('rent_duration_id', $i)->first();
                        $price = preg_replace("/[^0-9]/", "", $request->duration_price[$i]);
                        //dd($price);
                        $price = (int) $price;
                        $dp = 30 / 100 * $price;
                        
                        if($price_list){
                            $price_list->price = $price;
                            $price_list->dp = $dp;
                            $price_list->save();
                            // /dd($price_list);
                        }else{
                            $price_list = new PriceList;
                            $price_list->price = $price;
                            $price_list->dp = $dp;
                            $price_list->room_type_id = $room_type->id;
                            $price_list->rent_duration_id = $i;
                            $price_list->save();
                        }
                    }else{
                        $price_list = PriceList::where('room_type_id', $id)->where('rent_duration_id', $i)->first();
                        if($price_list){
                            $price_list->delete();
                        }
                    }
                }
                
                //Create Optional Price
                $optional_prices = OptionalPrice::where('room_type_id', $room_type->id)->get();
                    foreach ($optional_prices as $optional_price) {
                        $optional_price->delete();
                    }

                    if(count($request->price_name) > 0){
                        for ($i=0; $i < count($request->price_name); $i++) {
                            if($request->price_name[$i] && $request->price[$i]){
                                $price = preg_replace("/[^0-9]/", "", $request->price[$i]);
                            $price = (int) $price;
                                $optional_price = new OptionalPrice;
                                $optional_price->name = $request->price_name[$i];
                                $optional_price->price = $price;
                                $optional_price->room_type_id = $room_type->id;
                                $optional_price->save();
                            }
                        }
                    }

                //Foto bagian depan kamar
                $dir = storage_path().'/app/public/images/room';
                $image_room1 = $request->file('image_room1');
                if($image_room1){
                    foreach ($image_room1 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room1 = new RoomImage;
                        $image_room1->image = $fileName;
                        $image_room1->room_type_id = $room_type->id;
                        $image_room1->section_id = 4;
                        $image_room1->save();
                    }
                }

                //Foto bagian dalam kamar
                $dir = storage_path().'/app/public/images/room';
                $image_room2 = $request->file('image_room2');
                if($image_room2){
                    foreach ($image_room2 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room2 = new RoomImage;
                        $image_room2->image = $fileName;
                        $image_room2->room_type_id = $room_type->id;
                        $image_room2->section_id = 5;
                        $image_room2->save();
                    }
                }

                //Foto kamar mandi
                $dir = storage_path().'/app/public/images/room';
                $image_room3 = $request->file('image_room3');
                if($image_room3){
                    foreach ($image_room3 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room3 = new RoomImage;
                        $image_room3->image = $fileName;
                        $image_room3->room_type_id = $room_type->id;
                        $image_room3->section_id = 6;
                        $image_room3->save();
                    }
                }

                //Foto tambahan
                $dir = storage_path().'/app/public/images/room';
                $image_room4 = $request->file('image_room4');
                if($image_room4){
                    foreach ($image_room4 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $image_room4 = new RoomImage;
                        $image_room4->image = $fileName;
                        $image_room4->room_type_id = $room_type->id;
                        $image_room4->section_id = 7;
                        $image_room4->save();
                    }
                }
            }else{
                return redirect()->back()->with('error', __('toast.create.unique.message'));
            }

            $kost_id = $room_type->room[0]->kost_id;
            $kost = Kost::find($kost_id);    
            $rooms = Room::groupBy('rooms.room_type_id')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'))
            ->where('rooms.kost_id', $kost_id)
            ->get();
            $room_type = Room::groupBy('rooms.room_type_id')->groupBy('room_types.name')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'), 'room_types.name')
            ->where('rooms.kost_id', $kost_id)
            ->pluck('room_types.name','rooms.room_type_id');

            return redirect()->route('owner.kost.show', compact('kost','rooms','room_type'))->with('success', __('toast.update.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    public function getDataRoomType(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Room::groupBy('rooms.room_type_id')
            ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
            ->select('rooms.room_type_id', \DB::raw('count(*) as total'))
            ->where('rooms.kost_id', $request->id)
            ->get();
        }

        if($data)return response()->json(RoomTypeList::collection($data));
        return $data;
    }

    
    public function destroyRoomTypeImage($id)
    {
        try {
            $file = RoomImage::find($id);
            if(Storage::exists('public/images/room/'.$file->image)){
                Storage::delete('public/images/room/'.$file->image);
            }
            $file->delete();
        
            return json_encode(array('statusCode'=>200));
            // return response()->json([
            //     'status' => 200,
            // ]);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }
}
