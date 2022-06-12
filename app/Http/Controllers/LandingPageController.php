<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost; 
use App\Models\RoomType; 
use App\Models\PriceList; 
use App\Models\Booking; 
use App\Models\Chat; 
use App\Models\PaymentMethodDetail; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    public function home(){
        try {
            $kosts = Kost::select('id')->where('status', 1)->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }   
            $newRoomTypes = RoomType::whereIn('kost_id', $kost_id)->take(8)->get();
            $newKosts = Kost::where('status', 1)->orderby('created_at', 'desc')->take(8)->get();
            
            return view('backend.landingPage.home', compact('newRoomTypes','newKosts'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function listKost(){
        try {
            $kosts = Kost::where('status', 1)->orderby('created_at', 'desc')->paginate(3);
            return view('backend.landingPage.listKost', compact('kosts'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function info(Request $request){
        try {
            $kosts = Kost::select('id')->where('status', 1)->get();
            $kost_id = collect([]);
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::inRandomOrder('2')->whereIn('kost_id', $kost_id)->orderby('created_at', 'desc')->paginate(8);
            //$kosts = Kost::inRandomOrder()->where('status', 1)->paginate(4);
            //dd($kosts);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function PriceAsc(){
        try {
            $kosts = Kost::select('id')->where('status', 1)->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);;
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $roomTypes = PriceList::whereIn('room_type_id', $room_type_id)->where('rent_duration_id', 1)->orderby('price', 'asc')->paginate(8);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function PriceDesc(){
        try {
            $kosts = Kost::select('id')->where('status', 1)->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);;
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $roomTypes = PriceList::whereIn('room_type_id', $room_type_id)->where('rent_duration_id', 1)->orderby('price', 'desc')->paginate(8);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function sortPrice(Request $request){
        try {
            $kosts = Kost::select('id')->where('status', 1)->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);;
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $roomTypes = PriceList::whereIn('room_type_id', $room_type_id)
                                    ->where('rent_duration_id', 1)
                                    ->where('price', '>=', $request->min)
                                    ->where('price', '<=', $request->max)
                                    ->orderby('price', 'asc')
                                    ->paginate(8);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function NameAsc(){
        try {
            $kosts = Kost::select('id')->where('status', 1)->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);;
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $roomTypes = RoomType::whereIn('id', $room_type_id)->orderby('name', 'asc')->paginate(8);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function sortType(Request $request){
        try {
            if($request->type == "putra")
            {
                $kosts = Kost::select('id')->where('status', 1)->where('kost_type_id', 1)->get();
            }elseif($request->type == "putri"){
                $kosts = Kost::select('id')->where('status', 1)->where('kost_type_id', 2)->get();
            }elseif($request->type == "campur"){
                $kosts = Kost::select('id')->where('status', 1)->where('kost_type_id', 3)->get();
            }
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);;
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $roomTypes = RoomType::whereIn('id', $room_type_id)->orderby('created_at', 'desc')->paginate(8);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function sortAround(Request $request){
        try {
            $kosts = Kost::select("kosts.id","kosts.status","kosts.kost_type_id", \DB::raw("6371 * acos(cos(radians(".$request->latitude."))
            * cos(radians(kosts.latitude)) 
            * cos(radians(kosts.longitude) - radians(".$request->longitude.")) 
            + sin(radians(".$request->latitude.")) 
            * sin(radians(kosts.latitude))) AS distance, kosts.name"), "kosts.address")
            ->where('status', 1)
            ->where('kost_type_id', 3)
            ->having('distance', '<', 5)
            ->get();
            //$kosts = Kost::select('id')->where('status', 1)->where('kost_type_id', 3)->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);;
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $roomTypes = RoomType::whereIn('id', $room_type_id)->orderby('created_at', 'desc')->paginate(8);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function Search(Request $request){
        try {
            $kosts = Kost::select('id')
                            ->where('status', 1)
                            ->where('name', 'like', '%' . $request->search . '%')
                            ->get();
            $kost_id = collect([]);;
            foreach($kosts as $kost){
                $kost_id->push($kost->id);
            }
            $roomTypes = RoomType::whereIn('kost_id', $kost_id)->get();
            $room_type_id = collect([]);;
            foreach($roomTypes as $roomType){
                $room_type_id->push($roomType->id);
            }
            $roomTypes = RoomType::whereIn('id', $room_type_id)->orderby('name', 'asc')->paginate(8);
            return view('backend.landingPage.info', compact('roomTypes'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function show($id){
        try {
            $roomType = RoomType::find($id);
            $room_type_id = collect([]);
            $room_type_id->push($roomType->id);
            $others = RoomType::where('kost_id', $roomType->kost_id)->whereNotIn('id', $room_type_id)->get();
            $duration = PriceList::select('price_lists.id as id', 'rent_durations.name as name')
            ->join('rent_durations', 'price_lists.rent_duration_id', '=', 'rent_durations.id')
            ->where('price_lists.room_type_id', $roomType->id)
            ->get()
            ->pluck('name', 'id');
            $paymentMethodDetails = PaymentMethodDetail::where('kost_id', $roomType->kost_id)->get();
            $today = Carbon::today();
            $today = $today->format('m/d/Y');
            
            $chat = [];
            if(Auth::user()){
            $chat = Chat::where('kost_seeker_id', Auth::user()->kostSeeker->id)
                            ->where('kost_owner_id', $roomType->kost->kostOwner->id)
                            ->where('kost_id', $roomType->kost->id)
                            ->first();
            }
            return view('backend.landingPage.show', compact('roomType','others','duration','today', 'chat', 'paymentMethodDetails'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }

    public function getAround1(Request $request){
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

        $data = Kost::select("kosts.id", \DB::raw("6371 * acos(cos(radians(" . $request->latitude . "))
        * cos(radians(kosts.latitude)) 
        * cos(radians(kosts.longitude) - radians(" . $request->longitude . ")) 
        + sin(radians(" .$request->latitude. ")) 
        * sin(radians(kosts.latitude))) AS distance, kosts.name"), "kosts.address")
        ->having('distance', '<', 100)
        ->get();

        //$data[0]['new'] = 0;
        for($i=0; $i<$data->count(); $i++){
            $data[$i]['room_type_name'] = $data[$i]->firstRoomType()->name;
            //dd($data[$i]->firstRoomType()->name);
        }

        return response()->json($data);
    }
}
