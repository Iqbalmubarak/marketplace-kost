<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
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
use App\Models\RentDuration;
use App\Models\PriceList;
use App\Models\OptionalPrice;
use App\Http\Resources\KostList;
use App\Http\Resources\RoomList;
use App\Http\Resources\RoomTypeList;
use Illuminate\Support\Facades\Auth;
use File;
use Storage;
use DB;

class KostController extends Controller
{
    public function index()
    {
        try {       
            $kosts = Kost::where('kost_owner_id', Auth::user()->kostOwner->id)
            ->orderby('id','desc')
            ->get();

            return view('backend.kostOwner.manageKost.index', compact('kosts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function adminIndex()
    {
        try {       
            return view('backend.admin.manageKost.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function create()
    {
        try {       
            $kost_type = KostType::pluck('name','id');
            $rules = Rule::all();
            $facility_types1 = FacilityType::whereIn('id', [1, 2])->get();
            $facility_types2 = FacilityType::whereIn('id', [3, 4])->get();
            $rent_durations = RentDuration::all();

            return view('backend.kostOwner.manageKost.create', compact('kost_type','rules','facility_types1','facility_types2','rent_durations'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function store(Request $request)
    {
        try {
            $kost = new Kost;
            $kost->name = $request->name;
            $kost->address = $request->address;
            $kost->note = $request->note;
            $kost->exist = $request->exist;
            $kost->manager_name = $request->manager;
            $kost->manager_handphone = $request->handphone;
            $kost->latitude = $request->latitude;
            $kost->longitude = $request->longitude;
            $kost->kost_type_id = $request->kost_type;
            $kost->kost_owner_id = Auth::user()->kostOwner->id;
            $kost->save();

            if($kost->id){
                $rules = Rule::all();
                foreach($rules as $rule){
                    $ruleDetail = new RuleDetail;
                    $ruleDetail->kost_id = $kost->id;
                    $ruleDetail->rule_id = $rule->id;
                    $ruleDetail->save();
                }

                //Rule detail
                for($i=0; $i < count($request->rule); $i++){
                    $ruleDetail = RuleDetail::where('kost_id', $kost->id)
                    ->where('rule_id', $request->rule[$i])
                    ->first();
                    $ruleDetail->status = 2;
                    $ruleDetail->save();
                }

                //Rule upload
                $dir = storage_path().'/app/public/images/rule';
                $fileRuleUpload = $request->file('rule_upload');                

                $fileName = Time().".".$fileRuleUpload->getClientOriginalName();
                $fileRuleUpload->move($dir, $fileName);

                if($fileRuleUpload){
                    $ruleUplaod = new RuleUpload;
                    $ruleUplaod->image = $fileName;
                    $ruleUplaod->kost_id = $kost->id;
                    $ruleUplaod->save();
                }

                $facilities = Facility::whereIn('facility_type_id', [1, 2])->get();
                foreach($facilities as $facility){
                    $kostFacilityDetail = new KostFacilityDetail;
                    $kostFacilityDetail->kost_id = $kost->id;
                    $kostFacilityDetail->facility_id = $facility->id;
                    $kostFacilityDetail->save();
                }
                //Kost facility
                for($i=0; $i < count($request->facility); $i++){
                    $kostFacilityDetail = KostFacilityDetail::where('kost_id', $kost->id)
                    ->where('facility_id', $request->facility[$i])
                    ->first();
                    $kostFacilityDetail->status = 2;
                    $kostFacilityDetail->save();
                }

                //Foto bangunan dari depan
                $dir = storage_path().'/app/public/images/kost';
                $kostImage1 = $request->file('kost_image1');

                if($kostImage1){
                    foreach ($kostImage1 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $kostImage = new KostImage;
                        $kostImage->image = $fileName;
                        $kostImage->kost_id = $kost->id;
                        $kostImage->section_id = 1;
                        $kostImage->save();
                    }
                }

                //Foto bagian dalam bangunan
                $dir = storage_path().'/app/public/images/kost';
                $kostImage2 = $request->file('kost_image2');

                if($kostImage2){
                    foreach ($kostImage2 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $kostImage = new KostImage;
                        $kostImage->image = $fileName;
                        $kostImage->kost_id = $kost->id;
                        $kostImage->section_id = 2;
                        $kostImage->save();
                    }
                }

                //Foto bangunan dari jalan
                $dir = storage_path().'/app/public/images/kost';
                $kostImage3 = $request->file('kost_image3');

                if($kostImage3){
                    foreach ($kostImage3 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $kostImage = new KostImage;
                        $kostImage->image = $fileName;
                        $kostImage->kost_id = $kost->id;
                        $kostImage->section_id = 3;
                        $kostImage->save();
                    }
                }
                
                $room_type = new RoomType;
                $room_type->name = $request->room_type;
                $room_type->lenght = $request->lenght;
                $room_type->wide = $request->wide;
                $room_type->kost_id = $kost->id;
                $room_type->save();

                //Create Room
                $room_count = Room::where('kost_id', $kost->id)->count();
                for($i = 0; $i < $request->room_total; $i++){
                    $room = new Room;
                    $room->name = $room_count + ($i+1);
                    $room->kost_id = $kost->id;
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
                    $kostFacilityDetail = new KostFacilityDetail;
                    $kostFacilityDetail->kost_id = $kost->id;
                    $kostFacilityDetail->facility_id = $facility->id;
                    $kostFacilityDetail->save();
                }
                //Room facility
                for($i=0; $i < count($request->room_facility); $i++){
                    $kostFacilityDetail = KostFacilityDetail::where('kost_id', $kost->id)
                    ->where('facility_id', $request->room_facility[$i])
                    ->first();
                    $kostFacilityDetail->status = 2;
                    $kostFacilityDetail->save();
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
            }

            return redirect()->route('owner.kost.index')->with('success', __('toast.create.success.message'));     
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.create.failed.message'));
        }
    }

    public function show($id)
    {
        try {
            $kost = Kost::find($id);
            if($kost->status == 1){
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
                
                return view('backend.kostOwner.manageKost.show', compact('kost', 'rooms', 'room_type'));
            }else{
                return redirect()->back()->with('error', __('toast.access.failed.message'));
            }
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function showIndex($id)
    {
        try {
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

            $kost = Kost::find($id);
            return view('backend.admin.manageKost.show', compact('kost', 'rooms', 'room_type'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $kost = Kost::find($id);
            if($request->data){
                $data = 'request';
            }else{
                $data = 'none';
            }
            $kost_type = KostType::pluck('name','id');
            $rule_details = RuleDetail::where('kost_id', $kost->id)->get();
            $rule_upload = RuleUpload::where('kost_id', $kost->id)->first();            
            $kost_facility_details = KostFacilityDetail::where('kost_id', $kost->id)->get();
            $kost_images1 = KostImage::where('kost_id', $kost->id)->where('section_id', 1)->get();
            $kost_images2 = KostImage::where('kost_id', $kost->id)->where('section_id', 2)->get();
            $kost_images3 = KostImage::where('kost_id', $kost->id)->where('section_id', 3)->get();

            $rent_durations = RentDuration::all();
            $room_type = RoomType::where('kost_id',$id)->first();
            $room_total = Room::where('kost_id', $id)->count();
            $room_facility_details = RoomFacilityDetail::where('room_type_id', $room_type->id)->get();
            $price_lists = PriceList::where('room_type_id', $room_type->id)->get();
            $room_images1 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 4)->get();
            $room_images2 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 5)->get();
            $room_images3 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 6)->get();
            $room_images4 = RoomImage::where('room_type_id', $room_type->id)
            ->where('section_id', 7)->get();
            $kost_id = $room_type->room[0]->kost_id;

            return view('backend.kostOwner.manageKost.edit', compact('kost','kost_type','rule_details','kost_facility_details','rule_upload','kost_images1','kost_images2','kost_images3','data','room_type','kost_id','room_images1','room_images2','room_images3','room_images4','room_total','room_facility_details','price_lists','rent_durations'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
    }

    public function request($id)
    {
        try {
            $kost = Kost::find($id);
            $kost->status = 1;
            $kost->save();

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
            
            return redirect()->route('owner.kost.show', compact('kost','rooms','room_type'))->with('success', __('toast.update.success.message'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $kost = Kost::find($id);
            $kost->name = $request->name;
            $kost->address = $request->address;
            $kost->note = $request->note;
            $kost->exist = $request->exist;
            $kost->manager_name = $request->manager;
            $kost->manager_handphone = $request->handphone;
            $kost->latitude = $request->latitude;
            $kost->longitude = $request->longitude;
            $kost->kost_type_id = $request->kost_type;
            if($request->data == 'request'){
                $kost->status = 0;
            }
            $kost->save();

            if($kost->id){
                
                //Rule detail
                $ruleDetails = RuleDetail::where('kost_id', $kost->id)
                ->whereNotIn('rule_id', $request->rule_detail)->get();

                foreach($ruleDetails as $ruleDetail){
                    $ruleDetail->status = 1;
                    $ruleDetail->save();
                }

                for($i=0; $i < count($request->rule_detail); $i++){
                    $ruleDetail = RuleDetail::where('kost_id', $kost->id)
                    ->where('rule_id', $request->rule_detail[$i])
                    ->first();
                    $ruleDetail->status = 2;
                    $ruleDetail->save();
                }
                
                if($request->file('rule_upload')){
                    $file = RuleUpload::where('kost_id', $kost->id)->first();
                    //Rule upload
                    if($file){
                        if(File::exists(storage_path('images/rule/'.$file->image))){
                            File::delete(storage_path('images/rule/'.$file->image));
                        }

                        $dir = storage_path().'/app/public/images/rule';
                        $fileRuleUpload = $request->file('rule_upload');

                        $fileName = Time().".".$fileRuleUpload->getClientOriginalName();
                        $fileRuleUpload->move($dir, $fileName);

                        if($fileRuleUpload){
                            $ruleUplaod = RuleUpload::find($file->id);
                            $ruleUplaod->image = $fileName;
                            $ruleUplaod->save();
                        }
                    }else{
                        $dir = storage_path().'/app/public/images/rule';
                        $fileRuleUpload = $request->file('rule_upload');

                        $fileName = Time().".".$fileRuleUpload->getClientOriginalName();
                        $fileRuleUpload->move($dir, $fileName);

                        if($fileRuleUpload){
                            $ruleUplaod = new RuleUpload;
                            $ruleUplaod->image = $fileName;
                            $ruleUplaod->kost_id = $kost->id;
                            $ruleUplaod->save();
                        }
                    }
                }
                

                //Kost facility
                $kostFacilityDetails = KostFacilityDetail::where('kost_id', $kost->id)
                ->whereNotIn('facility_id', $request->detail)->get();

                foreach($kostFacilityDetails as $kostFacilityDetail){
                    $kostFacilityDetail->status = 1;
                    $kostFacilityDetail->save();
                }

                for($i=0; $i < count($request->detail); $i++){
                    $kostFacilityDetail = KostFacilityDetail::where('kost_id', $kost->id)
                    ->where('facility_id', $request->detail[$i])
                    ->first();
                    $kostFacilityDetail->status = 2;
                    $kostFacilityDetail->save();
                }

                //Foto bangunan dari depan
                $dir = storage_path().'/app/public/images/kost';
                $kostImage1 = $request->file('kost_image1');
                if($kostImage1){
                    foreach ($kostImage1 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $kostImage = new KostImage;
                        $kostImage->image = $fileName;
                        $kostImage->kost_id = $kost->id;
                        $kostImage->section_id = 1;
                        $kostImage->save();
                    }
                }
                

                //Foto bagian dalam bangunan
                $dir = storage_path().'/app/public/images/kost';
                $kostImage2 = $request->file('kost_image2');

                if($kostImage2){
                    foreach ($kostImage2 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $kostImage = new KostImage;
                        $kostImage->image = $fileName;
                        $kostImage->kost_id = $kost->id;
                        $kostImage->section_id = 2;
                        $kostImage->save();
                    }
                }
                

                //Foto bangunan dari jalan
                $dir = storage_path().'/app/public/images/kost';
                $kostImage3 = $request->file('kost_image3');

                if($kostImage3){
                    foreach ($kostImage3 as $file) {
                        $fileName = Time().".".$file->getClientOriginalName();
                        $file->move($dir, $fileName);

                        $kostImage = new KostImage;
                        $kostImage->image = $fileName;
                        $kostImage->kost_id = $kost->id;
                        $kostImage->section_id = 3;
                        $kostImage->save();
                    }
                }

                if($request->data == 'request'){
                    //Room
                    $room_type = RoomType::where('kost_id', $kost->id)->first();

                    $room_type->name = $request->room_type;
                    $room_type->lenght = $request->lenght;
                    $room_type->wide = $request->wide;
                    $room_type->save();

                    //Create Price List
                    for ($i=1; $i <= count($request->duration_price); $i++) {
                        if($request->duration_price[$i]){
                            $price_list = PriceList::where('room_type_id', $id)->where('rent_duration_id', $i)->first();
                            $price = preg_replace("/[^0-9]/", "", $request->duration_price[$i]);
                            $price = (int) $price;
                            $dp = 30 / 100 * $price;
                            if($price_list){
                                $price_list->price = $price;
                                $price_list->dp = $dp;
                                $price_list->save();
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
                    return redirect()->route('owner.kost.index')->with('success', __('toast.update.success.message'));  
                }
            }

            return redirect()->route('owner.kost.show', $id)->with('success', __('toast.update.success.message'));     
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.update.failed.message'));
        }
    }

    public function confirm($id)
    {
        try {
            $kost = Kost::find($id);
            $kost->status = 1;
            $kost->save();

            return redirect()->route('admin.kost.admin-index')->with('success', __('toast.confirm.success.message'));     
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.confirm.failed.message'));
        }
    }

    public function reject($id)
    {
        try {
            $kost = Kost::find($id);
            $kost->status = 2;
            $kost->save();

            return redirect()->route('admin.kost.admin-index')->with('success', __('toast.reject.success.message'));     
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.reject.failed.message'));
        }
    }

    public function destroy($id)
    {
        try {
            $kost = Kost::find($id);
            $kost->delete();
            return redirect()->back()->with('success', __('toast.delete.success.message'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('toast.delete.failed.message'));
        }
    }

    public function destroy_image($id)
    {
        try {
            $file = KostImage::find($id);
            if(Storage::exists('public/images/kost/'.$file->image)){
                Storage::delete('public/images/kost/'.$file->image);
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

    

    public function getLocation(Request $request)
    {
        $data = [];
        $data = Kost::select(['latitude', 'longitude'])
        ->where('id', $request->id)
        ->get();

        return response()->json($data);
    }

    public function getData(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Kost::where('status', $request->status)
            ->orderby('id','desc')
            ->get();
        }
        //?data=id&id=
        elseif($request->data=="id"){
            $data = Kost::find($request->id);
        }
        //data=select&id=
        elseif($request->data=="select"){
            $id = explode(',',$request->id);
            $data = Kost::wherenotin('id', $id)->get();
        }

        if($data)return response()->json(KostList::collection($data));
        return $data;
    }

    public function getDataRoom(Request $request)
    {
        $data = [];
        //?data=all
        if($request->data=="all"){
            $data = Room::where('kost_id', $request->id)
            ->orderby('id','desc')
            ->get();
        }

        if($data)return response()->json(RoomList::collection($data));
        return $data;
    }


}
