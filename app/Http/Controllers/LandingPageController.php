<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost; 
use App\Models\RoomType; 
use App\Models\PriceList; 
use App\Models\Booking; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function home(){
        try {
            $kosts = Kost::where('status', 1)->get();
            
            return view('backend.landingPage.home', compact('kosts'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function info(){
        try {
            $kosts = Kost::where('status', 1)->paginate(8);
            dd($kosts->links());
            return view('backend.landingPage.info', compact('kosts'));
        } catch (\Exception $e) {
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
            $today = Carbon::today();
            $today = $today->format('m/d/Y');
            return view('backend.landingPage.show', compact('roomType','others','duration','today'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back();
        }
    }
}
